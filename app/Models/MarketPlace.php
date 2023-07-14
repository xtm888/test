<?php

namespace App\Models;

use App\Events\ModelDataChanged;
use Illuminate\Database\Eloquent\Model;

class MarketPlace extends Model
{
    protected $dispatchesEvents = [
        'saved' => ModelDataChanged::class,
    ];
}
