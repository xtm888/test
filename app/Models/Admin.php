<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use Uuids;

    protected $keyType = 'string';
    protected $primaryKey = 'id';

    /**
     */
    public static function allUsers()
    {
        // select all admins ids
        $adminsIDs = Admin::all()->pluck('id');

        return User::whereIn('id', $adminsIDs)->get();
    }

    /**
     * Return user instance of the admin
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id');
    }
}
