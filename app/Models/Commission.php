<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use Uuids;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';

    public function purchase()
    {
        return $this->hasOne(Purchase::class, 'id', 'purchase_id');
    }

    public function earnBy()
    {
        return $this->hasOne(User::class, 'id', 'earned_user');
    }

    public static function earnedMarketCommission()
    {
        $totalCommission = 0;
        foreach (Commission::where('market_commission',1)->get() as $com) {
            $totalCommission += $com->amount;
        }
        return $totalCommission;
    }
}
