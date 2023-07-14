<?php

namespace App\Marketplace\Utility;

use Illuminate\Support\Facades\Cache;

class FiatConverter
{

    const API_URL = "https://min-api.cryptocompare.com/data/price?fsym=XMR&tsyms=USD,EUR,TRY,GBP,CAD,AUD,JPY,CNY,ZAR,RUB,INR";
    const PARITE_API_URL = "https://min-api.cryptocompare.com/data/price?fsym=USD&tsyms=EUR,TRY,GBP,CAD,AUD,JPY,CNY,ZAR,RUB,INR";

    private static function getConversionRatesXmr()
    {
        return Cache::remember('conversion_rates_xmr', 3 * 60, function () {
            return json_decode(file_get_contents(self::API_URL), true);
        });
    }

    private static function getConversionRatesUsd()
    {
        return Cache::remember('conversion_rates_usd', 3 * 60, function () {
            return json_decode(file_get_contents(self::PARITE_API_URL), true);
        });
    }


    public static function xmr2Usd(float $amount)
    {
        $usd = self::getConversionRatesXmr()['USD'];
        return $amount * $usd;
    }

    public static function xmr2Eur(float $amount)
    {
        $euro = self::getConversionRatesXmr()['EUR'];
        return $amount * $euro;
    }

    public static function xmr2Try(float $amount)
    {
        $try = self::getConversionRatesXmr()['TRY'];
        return $amount * $try;
    }

    public static function xmr2Gbp(float $amount)
    {
        $gbp = self::getConversionRatesXmr()['GBP'];
        return $amount * $gbp;
    }

    public static function xmr2Cad(float $amount)
    {
        $cad = self::getConversionRatesXmr()['CAD'];
        return $amount * $cad;
    }

    public static function xmr2Aud(float $amount)
    {
        $aud = self::getConversionRatesXmr()['AUD'];
        return $amount * $aud;
    }

    public static function xmr2Jpy(float $amount)
    {
        $jpy = self::getConversionRatesXmr()['JPY'];
        return $amount * $jpy;
    }

    public static function xmr2Cny(float $amount)
    {
        $cny = self::getConversionRatesXmr()['CNY'];
        return $amount * $cny;
    }

    public static function xmr2Zar(float $amount)
    {
        $zar = self::getConversionRatesXmr()['ZAR'];
        return $amount * $zar;
    }

    public static function xmr2Rub(float $amount)
    {
        $rub = self::getConversionRatesXmr()['RUB'];
        return $amount * $rub;
    }

    public static function xmr2Inr(float $amount)
    {
        $inr = self::getConversionRatesXmr()['INR'];
        return $amount * $inr;
    }

    // USD PARITES
    //main
    public static function usd2Xmr(float $amount)
    {
        $usd = self::getConversionRatesXmr()['USD'];
        return $amount / $usd ;
    }
    //end-of-main

    public static function usd2Eur(float $amount)
    {
        $usd2Eur = self::getConversionRatesUsd()['EUR'];
        return $amount * $usd2Eur ;
    }

    public static function usd2Gbp(float $amount)
    {
        $usd2Gbp = self::getConversionRatesUsd()['GBP'];
        return $amount * $usd2Gbp ;
    }

    public static function usd2Try(float $amount)
    {
        $usd2Try = self::getConversionRatesUsd()['TRY'];
        return $amount * $usd2Try ;
    }

    public static function usd2Cad(float $amount)
    {
        $usd2Cad = self::getConversionRatesUsd()['CAD'];
        return $amount * $usd2Cad ;
    }

    public static function usd2Aud(float $amount)
    {
        $usd2Aud = self::getConversionRatesUsd()['AUD'];
        return $amount * $usd2Aud ;
    }

    public static function usd2Jpy(float $amount)
    {
        $usd2Jpy = self::getConversionRatesUsd()['JPY'];
        return $amount * $usd2Jpy ;
    }

    public static function usd2Cny(float $amount)
    {
        $usd2Cny = self::getConversionRatesUsd()['CNY'];
        return $amount * $usd2Cny ;
    }

    public static function usd2Zar(float $amount)
    {
        $usd2Zar = self::getConversionRatesUsd()['ZAR'];
        return $amount * $usd2Zar ;
    }

    public static function usd2Rub(float $amount)
    {
        $usd2Rub = self::getConversionRatesUsd()['RUB'];
        return $amount * $usd2Rub ;
    }

    public static function usd2Inr(float $amount)
    {
        $usd2Inr = self::getConversionRatesUsd()['INR'];
        return $amount * $usd2Inr ;
    }
}
