<?php

namespace App\Models;

use App\Marketplace\PGP;
use App\Marketplace\Utility\CurrencyConverter;
use App\Marketplace\Utility\UUID;
use App\Traits\Purchasable;
use App\Traits\Uuids;
use Carbon\Carbon;
use Exception;
use Faker\Provider\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

// use App\Traits\DisplayablePurchase;

//use App\Marketplace\Payment\Payment;


class Purchase extends Model
{
    use Uuids;

//    use DisplayablePurchase;
    use Purchasable;

    const DEFAULT_STATE = 'purchased';
    /**
     * Types of purchases
     *
     * @var array
     */
    public static $types = [
        'fe' => 'Finalize Early',
        'normal' => 'Normal Escrow',
//      'multisig' => 'Multisignature',
    ];
    /**
     * State of the purchases
     *
     * @var array
     */
    public static $states = [
        'purchased' => 'Purchased',
        'sent' => 'Sent',
        'delivered' => 'Delivered',
        'disputed' => 'Disputed',
        'canceled' => 'Canceled'
    ];
    public $incrementing = false;
    protected $keyType = 'string';


    public function __construct()
    {
        parent::__construct();
    }

    public static function totalEarningPerCoin(): array
    {
        $total_spent = 0;
        $total_earnings_coin = [];
        foreach (Purchase::where('state', 'delivered')->get() as $deliveredPurchase) {
            $total_spent += $deliveredPurchase->getSumDollars();

            // sum up earning per coin
            if (!array_key_exists($deliveredPurchase->coin, $total_earnings_coin)) {
                $total_earnings_coin[$deliveredPurchase->coin_name] = $deliveredPurchase->to_pay;
            } // add up for the coin
            else {
                $total_earnings_coin[$deliveredPurchase->coin_name] += $deliveredPurchase->to_pay;
            }
        }

        return $total_earnings_coin;
    }

    public static function totalSpent(): float
    {
        $total_spent = 0;
        foreach (Purchase::where('state', 'delivered')->get() as $deliveredPurchase) {
            $total_spent += $deliveredPurchase->getSumDollars();

        }
        return $total_spent;
    }

    /**
     * Return short id of the purchase
     *
     * @return string
     */
    public function getShortIdAttribute()
    {
        return UUID::encode($this->id);
    }

    /**
     * Set offer for the purchase
     *
     * @param Offer $offer
     */
    public function setOffer(Offer $offer)
    {
        $this->offer_id = $offer->id;
    }

    /**
     * Set shipping of the purchase
     *
     * @param Shipping|null $shipping
     */
    public function setShipping(?Shipping $shipping)
    {
        if (!is_null($shipping))
            $this->shipping_id = $shipping->id;
    }

    /**
     * Set buyer of the purchase
     *
     * @param User $user
     */
    public function setBuyer(User $user)
    {
        $this->buyer_id = $user->id;
    }

    /**
     * Display name of the purchase coin
     *
     * @param $coin
     * @return string
     */
    public function getCoinAttribute($coin)
    {
        return self::coinDisplayName($coin);
    }

    /**
     * Transfors coin display names
     *
     * @param $coinName
     * @return string
     */
    public static function coinDisplayName($coinName)
    {
        if ($coinName == 'btcm')
            return 'btc multisig';
        return $coinName;
    }

    /**
     * Set vendor of the purchase
     *
     * @param Vendor $vendor
     */
    public function setVendor(Vendor $vendor)
    {
        $this->vendor_id = $vendor->id;
    }

    /**
     * Get offer of the purchase
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function offer()
    {
        return $this->hasOne(Offer::class, 'id', 'offer_id');
    }

    /**
     * Get Shipping of the purchase can be null
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function shipping()
    {
        return $this->hasOne(Shipping::class, 'id', 'shipping_id');
    }

    /**
     * Get buyer of the purchase
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function buyer()
    {
        return $this->hasOne(User::class, 'id', 'buyer_id');
    }

    /**
     * Get vendor of the purchase
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function vendor()
    {
        return $this->hasOne(Vendor::class, 'id', 'vendor_id');
    }

    /**
     * Returns sum that needs to be paid in local currency
     *
     */
    public function getSumLocalCurrency()
    {

        return CurrencyConverter::convertToLocal($this->getSumDollars());
    }

    /**
     * Returns sum of dollars that needs to be paid for this purchase
     *
     * @return float
     */
    public function getSumDollars()
    {
        $shipingPrice = 0;
        if ($this->shipping)
            $shipingPrice += $this->shipping->price;
        return $this->offer->price * $this->quantity + $shipingPrice;
    }

    public function getLocalSymbol()
    {
        return CurrencyConverter::getSymbol(CurrencyConverter::getLocalCurrency());
    }

    /**
     * Sum of the purchase
     *
     * @return float|int
     */
    public function getValueSumAttribute()
    {
        return $this->getSumDollars();
    }

    /**
     * Formated Coin sum needed to be paid
     *
     * @return string
     */
    public function getCoinSumAttribute()
    {
        return number_format($this->getSum(), 8);
    }

    /**
     * Sum of Coin needed to be paid
     *
     * @return float
     */
    public function getSum()
    {
        return $this->to_pay;
    }

    /**
     * Time difference from purchased time to now
     *
     * @return string
     */
    public function timeDiff()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public function setCoin($coinName)
    {
        $this->coin_name = $coinName;
    }

    /**
     * Returns if the logged user is allowed to see
     *
     * @return bool
     */
    public function isAllowed(): bool
    {
        // return true for user and buyer
        return auth()->check() && // must be logged in
            (auth()->user() == $this->vendor->user // user is vendor of the sale
                || auth()->user() == $this->buyer // user is buyer of the sale
                || auth()->user()->isAdmin()); // user is admin
    }

    /**
     * Returns true if the purchase is purchased
     *
     * @return bool
     */
    public function isPurchased()
    {
        return $this->state == 'purchased';
    }

    /**
     * Returns true if the purchase is sent state
     *
     * @return bool
     */
    public function isSent()
    {
        return $this->state == 'sent';
    }

    /**
     * Returns true if the purchase is delivered state
     *
     * @return bool
     */
    public function isDelivered()
    {
        return $this->state == 'delivered';
    }

    /**
     * Returns true if the purchase is disputed state
     *
     * @return bool
     */
    public function isDisputed()
    {
        return $this->state == 'disputed' && Dispute::where('id', $this->dispute_id)->exists();
    }

    /**
     * Returns true if the state of the purchase is canceled
     *
     *
     * @return bool
     */
    public function isCanceled()
    {
        return $this->state == 'canceled';
    }

    /**
     * Set Dispute of the purchase
     *
     * @param Dispute $dispute
     * @return mixed
     */
    public function setDispute(Dispute $dispute)
    {
        return $this->dispute_id = $dispute->id;
    }

    /**
     * Return \App\Dispute
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function dispute()
    {
        return $this->hasOne(Dispute::class, 'id', 'dispute_id');
    }

    /**
     * Defines if user can make dispute on this purchase
     *
     * @return bool
     */
    public function canMakeDispute(): bool
    {
        if (!auth()->check()) return false;
        if ($this->isBuyer() || $this->isVendor()) return true;

        return false;
    }

    /**
     * Returns true if user is buyer
     *
     * @return bool
     */
    public function isBuyer(User $user = null): bool
    {
        // if user is set than check if given user is buyer
        if (!is_null($user))
            return $this->buyer == $user;
        // otherwise check if logged user
        return auth()->check() && auth()->user()->id == $this->buyer->id;
    }

    /**
     * Returns true if logged user is vendor for this purchase
     *
     * @param User|null $user
     * @return bool
     */
    public function isVendor(User $user = null): bool
    {
        // Compare id if the user is given
        if (!is_null($user))
            return $this->vendor_id == $user->id;
        // otherwise check logged user
        return auth()->check() && auth()->user()->id == $this->vendor_id;
    }

    /**
     * Return the name of the user role in this purchase
     *
     * @param User $user
     * @return string
     */
    public function userRole(User $user): string
    {
        if ($user->id == $this->vendor_id) return '(vendor)';
        if ($user->id == $this->buyer_id) return '(buyer)';

        return '';
    }

    /**
     * Returns feedback of the purchase
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function feedback()
    {
        return $this->hasOne(Feedback::class, 'id', 'feedback_id');
    }

    /**
     * Returns if this purchase has feedback
     *
     * @return bool
     */
    public function hasFeedback()
    {
        return $this->feedback_id != null;
    }

    /**
     * Setter for feedback
     *
     * @param Feedback $feedback
     */
    public function setFeedback(Feedback $feedback)
    {
        $this->feedback_id = $feedback->id;
    }

    /**
     * Returns if there is enough balance on the address
     *
     * @return bool
     */
    public function enoughBalance(): bool
    {
        // returns true if the balance on the deposit address greater or equal than enough btc sum
        return $this->getBalance() >= $this->getSum();
    }

    /**
     * Returns the balance of the addresses
     *
     * @return float
     */
    public function getBalance(): float
    {
        // Catch errors
        try {
            $addressBalance = $this->getPayment()->balance();
        } catch (Exception $e) {
            // Inform logger
            Log::error($e);
            $addressBalance = -1;
        }

        return $addressBalance;
    }

    /**
     * Lazy loading of payment
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getPayment()
    {
        if ($this->payment == null)
            $this->payment = app()->makeWith(Payment::class, ['purchase' => $this]);
        return $this->payment;
    }

    /**
     * Getter for Coin balance, formated string with 8 decimals
     *
     * @return string
     */
    public function getCoinBalanceAttribute()
    {
        $balance = $this->getBalance();
        if ($balance == -1)
            return 'unavailable';
        return number_format($balance, 8);
    }

    /**
     * Get coin label
     *
     * @return string
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getCoinLabelAttribute()
    {
        return strtoupper(self::coinDisplayName($this->getPayment()->coinLabel()));
    }

    public static function xmrValueOnEscrow()
    {
        $purchases = Purchase::whereIn('state', ['delivered', 'purchased', 'sent'])->get();
        $totalSum = 0;
        foreach ($purchases as $purchase) {
            $totalSum += $purchase->to_pay;
        }
        return $totalSum;
    }

    /**
     * Encrypt message with the vendors PGP key
     * @throws Exception
     */
    private function encryptMessage()
    {
        // If the message is not already encrypted
        if ($this->message && !Message::messageEncrypted($this->message)) {
            $this->message = PGP::EncryptMessage($this->message, $this->vendor->user->pgp_key);
        }
    }
}
