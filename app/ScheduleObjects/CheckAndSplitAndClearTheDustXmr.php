<?php

namespace App\ScheduleObjects;

use App\Events\Payment\IncomingDustAmount;
use App\Events\Payment\IncomingTransfer;
use App\Marketplace\Payment\MoneroPayment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

//7599525370000
//1000000000000
//  0.05xmr
//  50000000000

class CheckAndSplitAndClearTheDustXmr
{
    public function __invoke()
    {

        $monero = new MoneroPayment();
        $accounts = $monero->getAccounts();
        $output = [];
        foreach ($accounts['subaddress_accounts'] as $account) {
            if (mb_substr($account['tag'], 0, 5) === 'pylon' && $account['balance'] > 0) {
                $transfers = $monero->listIncomingTransfers('available', $account['account_index']);
                if (!empty($transfers)) {
                    foreach ($transfers as $transfer) {
                        $userWithdrawAddresses = array_filter($transfer, function ($item) {
                            return (($item['subaddr_index']['minor'] != 0) && ($item["unlocked"] != false));
                        });

                        $userWithdrawDustAddresses = array_filter($transfer, function ($item) {
                            return ($item['subaddr_index']['minor'] == 0);
                        });

                        foreach ($userWithdrawDustAddresses as $dust) {
                            $majorId = $dust["subaddr_index"]["major"];
                            $walletLabelWithPylon = $monero->getAddress($majorId)["addresses"][0]["label"];
                            $walletLabelPure = mb_substr($walletLabelWithPylon, 5);
                            $walletLabelWithAgora = 'agora' . $walletLabelPure;
                            $sendAddress = $monero->getAccounts($walletLabelWithAgora)["subaddress_accounts"][0]["base_address"];
                            $keyimage = $dust["key_image"];
                            if ($dust["unlocked"] == true) {
                                //$monero->sweepAll($sendAddress, $majorId, 0);
                                $sweep = $monero->sweepWithKeyImage($majorId, $keyimage, $sendAddress);

                                $amount = $sweep['amount'] - $sweep['fee'];

                                $username =
                                    DB::table('users')
                                        ->where('identifier', ($walletLabelPure))
                                        ->value('username');

                                event(new IncomingDustAmount('xmr', $amount, $username));

                                Log::info("dusting cash triggered" . ' SendedTo: ' . $sendAddress . ' FromMajor: ' . $majorId . ' keyimage: ' . $keyimage);
                            } else {
                                Log::info("dusting cash NOT triggered" . ' SendedTo: ' . $sendAddress . ' FromMajor: ' . $majorId . ' keyimage: ' . $keyimage);
                            }
                        }

                        foreach ($userWithdrawAddresses as $y) {
                            //dd(var_dump($y));
                            $key = $y['subaddr_index']['major'] . '-' . $y['subaddr_index']['minor'];
                            if (!array_key_exists($key, $output)) {
                                $output[$key] = [
                                    'amount' => 0,
                                    'hits' => 0,
                                ];
                            }

                            $output[$key]['amount'] += $y['amount'];
                            $output[$key]['hits'] += 1;
                        }

                        foreach ($output as $key => $o) {
                            $walletId = explode("-", $key);
                            // majorId: $walletId[0]
                            // minorId: $walletId[1]

                            //label will return with pylon.
                            $walletLabelWithPylon = $monero->getAddress((int)$walletId[0])["addresses"][0]["label"];
                            $walletLabelPure = mb_substr($walletLabelWithPylon, 5);

                            $username =
                                DB::table('users')
                                    ->where('identifier', ($walletLabelPure))
                                    ->value('username');

                            if ($username !== null) {
                                $walletLabelWithAgora = 'agora' . $walletLabelPure;

                                event(new IncomingTransfer('xmr', $o['amount'], $username));

                                //get address to split wallet
                                $splitSendAddress = $monero->getAccounts($walletLabelWithAgora)["subaddress_accounts"][0]["base_address"];
                                //split money
                                $monero->splittedTransfer($splitSendAddress, $o['amount'], $walletId[0], 5);

                                Log::info("splitting cash triggered" . ' SplitAddress: ' . $splitSendAddress . ' WalletID: ' . $walletId[0] . ' Amount: ' . $o['amount']);

                            }
                        }
                    }
                }
            }
        }


//        $monero = new MoneroPayment();
//        $accounts = $monero->getAccounts();
//        $output = [];
//        foreach ($accounts['subaddress_accounts'] as $account) {
//            if (mb_substr($account['tag'], 0, 5) === 'pylon' && $account['balance'] > 0) {
//                $transfers = $monero->listIncomingTransfers('available', $account['account_index']);
//                if (!empty($transfers)) {
//                    foreach ($transfers as $transfer) {
//                        $userWithdrawAddresses = array_filter($transfer, function ($item) {
//                            return ($item['subaddr_index']['minor'] != 0);
//                        });
//
//                        $userWithdrawDustAddresses = array_filter($transfer, function ($item) {
//                            return ($item['subaddr_index']['minor'] == 0);
//                        });
//
//                        foreach ($userWithdrawDustAddresses as $dust) {
//                            $majorId = $dust["subaddr_index"]["major"];
//                            $walletLabelWithPylon = $monero->getAddress($majorId)["addresses"][0]["label"];
//                            $walletLabelPure = mb_substr($walletLabelWithPylon, 5);
//                            $walletLabelWithAgora = 'agora' . $walletLabelPure;
//                            $sendAddress = $monero->getAccounts($walletLabelWithAgora)["subaddress_accounts"][0]["base_address"];
//                            $keyimage = $dust["key_image"];
//                            if ($dust["unlocked"] == true) {
//                                //$monero->sweepAll($sendAddress, $majorId, 0);
//                                $monero->sweepWithKeyImage($majorId, $keyimage, $sendAddress);
//
//                                Log::info("dusting cash triggered" . ' SendedTo: ' . $sendAddress . ' FromMajor: ' . $majorId . ' keyimage: ' . $keyimage);
//                            } else {
//                                Log::info("dusting cash NOT triggered" . ' SendedTo: ' . $sendAddress . ' FromMajor: ' . $majorId . ' keyimage: ' . $keyimage);
//                            }
//                        }
//
//                        foreach ($userWithdrawAddresses as $y) {
//                            $key = $y['subaddr_index']['major'] . '-' . $y['subaddr_index']['minor'];
//                            if (!array_key_exists($key, $output)) {
//                                $output[$key] = [
//                                    'amount' => 0,
//                                    'hits' => 0,
//                                ];
//                            }
//
//                            $output[$key]['amount'] += $y['amount'];
//                            $output[$key]['hits'] += 1;
//                        }
//
//                        foreach ($output as $key => $o) {
//                            $walletId = explode("-", $key);
//                            // majorId: $walletId[0]
//                            // minorId: $walletId[1]
//
//                            //label will return with pylon.
//                            $walletLabelWithPylon = $monero->getAddress((int)$walletId[0])["addresses"][0]["label"];
//                            $walletLabelPure = mb_substr($walletLabelWithPylon, 5);
//
//                            $username =
//                                DB::table('users')
//                                    ->where('identifier', ($walletLabelPure))
//                                    ->value('username');
//
//                            if ($username !== null) {
//                                $walletLabelWithAgora = 'agora' . $walletLabelPure;
//
//                                event(new IncomingTransfer('xmr', $o['amount'], $username));
//
//                                //get address to split wallet
//                                $splitSendAddress = $monero->getAccounts($walletLabelWithAgora)["subaddress_accounts"][0]["base_address"];
//                                //split money
//                                $monero->splittedTransfer($splitSendAddress, $o['amount'], $walletId[0], 5);
//
//                                Log::info("splitting cash triggered" . ' SplitAddress: ' . $splitSendAddress . ' WalletID: ' . $walletId[0] . ' Amount: ' . $o['amount']);
//
//                            }
//                        }
//                    }
//                }
//            }
//        }
    }

}
