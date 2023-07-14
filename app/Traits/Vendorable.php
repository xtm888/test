<?php

namespace App\Traits;

use App\Exceptions\RequestException;
use App\Marketplace\Payment\MoneroPayment;
use App\Marketplace\xmrEscrow;
use App\Models\Vendor as VendorModel;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait Vendorable
{
    /**
     * Returns true if the user is vendor
     *
     * @return bool
     */
    public function isVendor()
    {
        return VendorModel::where('id', $this->getId())->exists();
    }

    /**
     * Return Vendor instance of the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function vendor()
    {
        return $this->hasOne(VendorModel::class, 'id', 'id');
    }

    /**
     * Creates instance of the Vendor from user
     *
     * @throws RequestException
     * @throws \Throwable
     */
    public function becomeVendor()
    {
        if (!$this->hasPGP())
            throw new RequestException('You can\'t become vendor if you don\'t have PGP key!');

//        throw_unless($this->depositedEngouh(), new RequestException("You must deposit enough funds to the one address!"));

        $monero = new MoneroPayment();
        $userBalance = round($monero->checkReadyBalance(), 3);
        $vendorFee = round(\App\Marketplace\Utility\FiatConverter::usd2Xmr(config('marketplace.vendor_fee')) + 0.005, 3);

        if ($userBalance < $vendorFee)
            throw new RequestException("You dont have enough (unlocked) balance for become vendor!");

        try {
            DB::beginTransaction();

            // update balances of the vendor purchases
//            foreach ($this->vendorPurchases as $depositAddress) {
//                $depositAddress->amount = $depositAddress->getBalance();
//
//                // Unload funds to market address
//                if ($depositAddress->getBalance() > 0)
//                    $depositAddress->unloadFunds();
//
//                $depositAddress->save();
//            }
            $escrow = new xmrEscrow();

            if (!$escrow->isEscReady()) {
                $escrow->makeEscReady();
            }

            $amount = $vendorFee;
            $amount = $amount * 1000000000000;

            $escrow->transferToEsc(floor($amount), auth()->user(), 'c');

            VendorModel::insert([
                'id' => $this->getId(),
                'vendor_level' => 0,
                'about' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw new RequestException("Error happened! Try again later!");
        }
    }

    /**
     * Methods required to display vendor statistics on profile
     */

    public function vendorSince()
    {
        return date_format($this->created_at, "M/Y");
    }

    public function completedOrders()
    {
        return $this->sales()->where('state', 'delivered')->count();
    }

    public function disputesLastYear($won = true, $months = 12)
    {
        $vendorID = $this->getId();
        return $this->sales()->whereHas('dispute', function ($query) use ($vendorID, $won, $months) {
            $operator = '=';
            if (!$won) {
                $operator = '!=';
            }
            $query->where('winner_id', $operator, $vendorID)->where("created_at", ">", Carbon::now()->subMonths($months));
        })->count();
    }

    /**
     * Returns true if the user paid to the one of the deposit addresses
     *
     * @return bool
     */
    private function depositedEngouh()
    {
        foreach ($this->vendorPurchases as $depositAddress) {
            if ($depositAddress->isEnough()) {
                return true;
            }
        }
        return false;
    }



}
