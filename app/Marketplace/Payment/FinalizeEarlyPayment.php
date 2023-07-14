<?php

namespace App\Marketplace\Payment;

use App\Marketplace\ModuleManager;

class FinalizeEarlyPayment
{
    public static $moduleName = 'FinalizeEarly';
    public static $shortName = 'fe';

    /* WARN1 */
    public static function getProcedure()
    {
        if (!self::isEnabled())
            return null;
        return resolve('FinalizeEarlyModule\Procedure');
    }

    public static function isEnabled(): bool
    {

        return ModuleManager::isEnabled(self::$moduleName);
    }
}
