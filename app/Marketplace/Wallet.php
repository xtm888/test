<?php


namespace App\Marketplace;

use App\Marketplace\Payment\MoneroPayment;

class Wallet
{
    public static function createUserWallet($user)
    {
        $tag = $user->identifier;
        $newWallet = new MoneroPayment();
        $newWallet->createAccountOnWallet('pylon' . $tag, 3);
        $newWallet->createAccountOnWallet('agora' . $tag, 1);
    }
}
