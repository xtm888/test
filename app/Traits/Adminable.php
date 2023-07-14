<?php

namespace App\Traits;

use App\Models\Admin;

trait Adminable
{
    /**
     * Returns true if this user is admin
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return Admin::where('id', $this->id)->exists();
    }


    public function admin()
    {
        return $this->hasOne(Admin::class, 'id', 'id');
    }
}
