<?php


namespace App\Marketplace\Payment;

use App\Marketplace\Utility\MoneroConvert;
use App\Marketplace\Utility\MoneroRPC\walletRPC;
use App\Models\User;

class MoneroPayment implements Coin
{
    /**
     * Instance of Monero RPC
     * @var
     */
    protected $monero;

    public function __construct()
    {
        $this->monero = new walletRPC([
            'host' => config('coins.monero.host'),
            'port' => config('coins.monero.port'),
            'ssl' => config('coins.monero.ssl'),
            'user' => config('coins.monero.username'),
            'password' => config('coins.monero.password')
        ]);

    }

    public function generateAddress(array $parameters = []): string
    {
        if (array_key_exists('payment_id', $parameters)) {
            $response = $this->monero->make_integrated_address($parameters['payment_id']);
        } else {
            $response = $this->monero->make_integrated_address();
        }
        return $response['integrated_address'];
    }


    /**
     * Get received balance by PaymentID in piconero
     *
     * @param array $parameters
     * @return float
     * @throws \Exception
     */
    public function getBalance(array $parameters = []): float
    {
        return 0.123;
//        if (!array_key_exists('address', $parameters))
//            throw new \Exception('Parameter address is required');
//
//        $paymentId = $this->getPaymentId($parameters['address']);
//
//        $payments = $this->monero->get_payments($paymentId);
//        if (empty($payments))
//            return 0;
//        $total_received = 0.0;
//        foreach ($payments['payments'] as $payment) {
//            $total_received += $payment['amount'];
//        }
//        return $total_received / 1000000000000;
    }

    /**
     * Returns paymentID from integrated address
     *
     * @param string $address
     * @return string
     * @throws \Exception
     */
    public function getPaymentId(string $address): string
    {
        if ($address == '' || $address == null)
            throw new \Exception('Address is required');
        $res = $this->monero->split_integrated_address($address);
        return $res['payment_id'];
    }

//    /**
//     *
//     *
//     * @param string $toAddress
//     * @param float $amount Monero amount
//     * @return object|string
//     * @throws \Exception
//     */
//    public function sendToAddress(string $toAddress, float $amount)
//    {
//        $tx = $this->monero->transfer(['address' => $toAddress, 'amount' => $amount, 'priority' => 1]);
//        return $tx;
//    }

    /**
     * Send transaction to many addresses
     *
     * $addressesAmounts is in format ['address' => amount]
     * EXAMPLE:
     * ['amount' => 1, 'address' => '9sZABNdyWspcpsCPma1eUD5yM3efTHfsiCx3qB8RDYH9UFST4aj34s5Yg', 'amount' => 2, 'address' => 'BhASuWq4HcBL1KAwt4wMBDhkpwsqgz9EBY66g5UBrueRFLCESojoaHaTPsjh']
     *
     *
     * @param array $addressesAmounts
     * @return array|string
     * @throws \Exception
     */
    function sendToMany(array $addressesAmounts)
    {
        $destinations = [
            'amount' => [],
            'address' => []
        ];
        $firstTx = null;
        foreach ($addressesAmounts as $address => $amount) {
//            array_push($destinations['amount'], $amount);
//            array_push($destinations['address'], $address);
//            $destinations['amount'] = $amount;
//            $destinations['address'] = $address;
            $tx = $this->monero->transfer($amount, $address); // Multiple payments in one transaction

            // remember only firs
            if (is_null($firstTx)) {
                $firstTx = $tx;
            }
        }
        return $firstTx;
    }

    function usdToCoin($usd): float
    {
        return round(MoneroConvert::usdToXmr($usd), 12, PHP_ROUND_HALF_DOWN);
    }

    /**
     * Return the label of the monero
     *
     * @return string
     */
    function coinLabel(): string
    {
        return 'xmr';
    }

    public function checkValidXmrAddress($address)
    {
        $checkResult = $this->monero->validate_address($address, true, true);
        return $checkResult['valid'];
    }


    public function checkBalance()
    {
        $walletIndex = $this->getAccountIndexFromTag();
        $this->monero->refresh();
        return $this->monero->get_balance($walletIndex)['balance'] / 1000000000000;
    }

    public function checkReadyBalance()
    {
        $walletIndex = $this->getAccountIndexFromTag();
        $this->monero->refresh();
        return $this->monero->get_balance($walletIndex)['unlocked_balance'] / 1000000000000;
    }

    public function getAccountIndexFromTag(): int
    {
        $user = auth()->user();
        $tag = 'agora' . $user->identifier;
        $account = $this->monero->get_accounts($tag);
        return $account['subaddress_accounts'][0]['account_index'];
    }

    public function createAccountOnWallet($label, $subwalletCount = 3)
    {
        $newWallet = $this->monero->create_account($label);
        $this->monero->tag_accounts(array($newWallet['account_index']), $label);

        //create subwallet
        for ($i = 0; $i < $subwalletCount; $i++) {
            $this->monero->create_address($newWallet['account_index'], $label);
        }

    }

    public function listWallets()
    {
        $user = auth()->user();
        $tag = 'pylon' . $user->identifier;

        $accountIndex = $this->getAccountIndexFromTagPylon();
        $addresses = $this->monero->get_address($accountIndex)['addresses'];
        $addressesFiltered = array_filter($addresses, function ($item) {
            return $item['address_index'] != 0 && $item['used'] == false;
        });

        if (count($addressesFiltered) < 3) {
            for ($i = count($addressesFiltered); $i < 3; $i++) {
                $this->monero->create_address($accountIndex, $tag);
            }
        }
        return $addressesFiltered;
    }

    public function getAccountIndexFromTagPylon(?User $user = null): int
    {
        $user ??= auth()->user();

        $tag = 'pylon' . $user->identifier;
        $account = $this->monero->get_accounts($tag);
        return $account['subaddress_accounts'][0]['account_index'];
    }

    public function getAccounts($tag = '')
    {
        return $this->monero->get_accounts($tag);
    }

    public function listIncomingTransfers($type, $accountIndex)
    {
        return $this->monero->incoming_transfers($type, $accountIndex);
    }

    public function sendPayment(string $toAddress, float|int $amount, ?int $fromAccountIndex = null)
    {
        if ($fromAccountIndex == null) {
            $fromAccountIndex = $this->getAccountIndexFromTag();
        }
        $destinations = array(array('amount' => $amount, 'address' => $toAddress));
        $tx = $this->monero->transfer($destinations, $fromAccountIndex);
        return $tx;
    }

    public function splittedTransfer(string $toAddress, float $amount, int $fromAccountIndex, int $splitCount)
    {
        $splittedAmount = ($amount * 90 / 100) / $splitCount;
        $destinations = [];
        $splittedAmount = (int)$splittedAmount;
        $pushArray = array('amount' => $splittedAmount, 'address' => $toAddress);
        for ($i = 0; $i < $splitCount; $i++) {
            $destinations[] = $pushArray;
        }
        $tx = $this->monero->transfer($destinations, $fromAccountIndex);
        return $tx;
    }


    public function getAddress($major, $minor = 0)
    {
        return $this->monero->get_address($major, $minor);
    }

    public function sweepAll($sendAddress, $senderMajorId, $senderMinorId = '')
    {
        return $this->monero->sweep_all($sendAddress, $senderMinorId, $senderMajorId);
    }

    public function sweepWithKeyImage($senderAccountIndex, $keyimage, $sendAddress)
    {
        $subAddressIndicates = [0];
        return $this->monero->sweep_single($sendAddress, $keyimage, $senderAccountIndex, $subAddressIndicates);
    }

    public function paymentHistory()
    {
        $accountIndex = $this->getAccountIndexFromTag();
        $getTransfers = $this->monero->get_transfers(['all'], $accountIndex);
        return collect(array_merge(...array_values((array)$getTransfers)))->sortByDesc('timestamp');
    }

}
