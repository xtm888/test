<?php

namespace App\Marketplace;

use App\Marketplace\Utility\FeeCalculator;
use App\Marketplace\Utility\MoneroRPC\walletRPC;
use App\Models\User;

class xmrEscrow
{
    public function __construct()
    {
        $this->monero = new walletRPC(
            config('coins.monero.host'),
            config('coins.monero.port'),
            config('coins.monero.ssl'),
            config('coins.monero.username'),
            config('coins.monero.password')
        );

        //$this->escWalletSecName = config('marketplace.esc_wallet_name');
        //$this->escWalletSecKey = config('marketplace.esc_wallet_key');
    }

    public function makeEscReady()
    {
        self::createWallet('c');
        self::createWallet('e');
    }

    private function createWallet($type)
    {
        $walletRPC = $this->monero;
        $this->escWalletLabel = config('marketplace.esc_wallet_label');
        $wallet = $walletRPC->create_account($this->escWalletLabel . $type);
        $this->monero->tag_accounts(array($wallet['account_index']), $this->escWalletLabel . $type);

        for ($i = 0; $i < 30; $i++) {
            $walletRPC->create_address($wallet['account_index'], 'SubWallet:' . $this->escWalletLabel . $type);
        }
    }

    /**
     * We're checking existing wallets.
     * Returns boolean value.
     */

    public function isEscReady(): bool
    {
        $this->escWalletLabel = config('marketplace.esc_wallet_label');
        try {
            $this->monero->get_accounts($this->escWalletLabel . 'e');
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function transferToEsc(float $amount, $buyerUser, $type)
    {
        $splitCount = 2;
        $toAddress = $this->get1Addr($type);
        $fromAccountIndex = $this->getUserAccountIndexFromTag($buyerUser);
        $splittedAmount = round($amount / $splitCount);
        $destinations = [];
        $pushArray = array('amount' => $splittedAmount, 'address' => $toAddress);
        for ($i = 0; $i < $splitCount; $i++) {
            $destinations[] = $pushArray;
        }
        $tx = $this->monero->transfer($destinations, $fromAccountIndex);
        return $tx;
    }

    public function get1Addr($type)
    {
        for ($i = 0; $i < 1; $i++) {
            foreach ($this->getEscWalletAddr($type) as $wallet) {
                return $wallet['address'];
            }
        }
    }

    public function getEscWalletAddr($type)
    {
        $this->escWalletLabel = config('marketplace.esc_wallet_label');
        $major = $this->monero->get_accounts($this->escWalletLabel . $type)['subaddress_accounts'][0]['account_index'];
        $addresses = $this->monero->get_address($major)['addresses'];
        $addressesFiltered = array_filter($addresses, function ($item) {
            return $item['address_index'] != 0 && $item['used'] == false;
        });

        if (count($addressesFiltered) < 30) {
            for ($i = count($addressesFiltered); $i < 30; $i++) {
                $this->monero->create_address($major, 'SubWallet:' . $this->escWalletLabel . $type);
            }
        }

        return $addressesFiltered;
    }

    public function getUserAccountIndexFromTag(User $user): int
    {
        $tag = 'agora' . $user->identifier;
        $account = $this->monero->get_accounts($tag);
        return $account['subaddress_accounts'][0]['account_index'];
    }

    public function purchaseStateChange($toState, float $amount, $vendorUser, $buyerUser)
    {
        $destinations = [];

        if ($toState == "delivered") {
            $hasReferral = $buyerUser->hasReferredBy();

            $feeCalculation = new FeeCalculator($amount);

            $vendorAddress = $this->getUserAddress($vendorUser)['address'];
            $vendorDeserve = $feeCalculation->getBase();
            $vendorDeservePICO = round($vendorDeserve * 1000000000000);

            if ($hasReferral && $amount > 0.2) {
                //$escCommissionAddr = $this->get1Addr('c');
                $referredByUserAddress = $this->getUserAddress($buyerUser->referredBy)['address'];
                $splittedFee = $feeCalculation->getFee($hasReferral);
                $splittedFeePICO = round($splittedFee * 1000000000000);
                $destinations[] = $toReferrer = array('amount' => $splittedFeePICO, 'address' => $referredByUserAddress);
                // $destinations[] = $toEscCommission = array('amount' => $splittedFeePICO, 'address' => $escCommissionAddr);

                //ADD COMMISSION DB
                $addCommission = new \App\Models\Commission;
                $addCommission->earned_user = $buyerUser->referredBy->id;
                $addCommission->market_commission = false;
                $addCommission->amount = $splittedFee;
                $addCommission->save();

                $addCommission = new \App\Models\Commission;
                $addCommission->market_commission = true;
                $addCommission->amount = $splittedFee;
                $addCommission->save();
            } else {
                //ADD COMMISSION DB
                $addCommission = new \App\Models\Commission;
                $addCommission->market_commission = true;
                $addCommission->amount = $feeCalculation->getFee();
                $addCommission->save();
            }

            $destinations[] = $toVendor = array('amount' => $vendorDeservePICO, 'address' => $vendorAddress);

            $tx = $this->monero->transfer($destinations, $this->getEscAccountIndex('e'));
        }

        if ($toState == "canceled") {
            $buyerAddress = $this->getUserAddress($buyerUser)['address'];
            $buyerDeservePICO_2xSplitted = round(($amount * 1000000000000) / 2);
            $destinations[] = $toBuyer1split = array('amount' => $buyerDeservePICO_2xSplitted, 'address' => $buyerAddress);
            $destinations[] = $toBuyer2split = array('amount' => $buyerDeservePICO_2xSplitted, 'address' => $buyerAddress);

            $tx = $this->monero->transfer($destinations, $this->getEscAccountIndex('e'));
        }

        return $tx;
    }

    public function getUserAddress(User $user)
    {
        return $this->monero->get_address($this->getUserAccountIndexFromTag($user));
    }

    public function getEscAccountIndex($type): int
    {
        $this->escWalletLabel = config('marketplace.esc_wallet_label');
        $tag = $this->escWalletLabel . $type;
        $account = $this->monero->get_accounts($tag);
        return $account['subaddress_accounts'][0]['account_index'];
    }

    public function checkEscBalance()
    {
        $walletIndex = $this->getEscAccountIndex('e');

        $this->monero->refresh();
        return $this->monero->get_balance($walletIndex)['balance'] / 1000000000000;
    }

    public function checkEscReadyBalance()
    {
        $walletIndex = $this->getEscAccountIndex('e');

        $this->monero->refresh();
        return $this->monero->get_balance($walletIndex)['unlocked_balance'] / 1000000000000;
    }

}
