<x-layout>
    <x-slot name="content">
        <x-adminCP.tabmenu/>

        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-6 gap-6 mt-12 mx-2">
                @unless((new \App\Marketplace\xmrEscrow())->isEscReady())
                    <div
                        class="p-2 border border-black rounded-md col-span-6 shadow-xl shadow-blue-100 flex justify-between">
                        <p class="text-lg p-2">{{Cache::tags(['MarketPlace'])->get('MPCACHE')->name}} does not have
                            Escrow and Commission Wallets.</p>
                        <form action="{{route('admin.createwallets.post')}}" method="POST">
                            @csrf
                            <button type="submit" class="p-2 rounded border border-black uppercase">Create</button>
                        </form>
                    </div>
                @else
                    <div
                        class="p-2 lg:col-span-3 border border-black col-span-6 shadow-xl shadow-blue-100 dark:border-blue-800 dark:border-opacity-50 rounded-lg dark:shadow-blue-800 space-y-2">
                        <p>Earned Coin From Commissions: <span class="p-1 dark:bg-green-700 dark:text-white rounded-lg">{{round($earnCommission,3)}} XMR</span>
                            @if (auth()->user()->currency == 'usd')
                                [${{round(\App\Marketplace\Utility\FiatConverter::xmr2Usd($earnCommission) ),3}}]
                            @endif @if(auth()->user()->currency == 'euro')
                                [{{'€' . round(\App\Marketplace\Utility\FiatConverter::xmr2Eur($earnCommission),2)}}]
                            @endif @if(auth()->user()->currency == 'gbp')
                                [{{'£' . round(\App\Marketplace\Utility\FiatConverter::xmr2Gbp($earnCommission),2)}}]
                            @endif @if(auth()->user()->currency == 'try')
                                [{{'₺' . round(\App\Marketplace\Utility\FiatConverter::xmr2Try($earnCommission),2)}}]
                            @endif
                        </p>
                        <p>Coin on Escrow Process: <span class="p-1 dark:bg-red-700 dark:text-white rounded-lg">{{round( ($balanceOnEscProcess),3)}} XMR</span>
                            @if (auth()->user()->currency == 'usd')
                                [${{round(\App\Marketplace\Utility\FiatConverter::xmr2Usd($balanceOnEscProcess) ),3}}]
                            @endif @if(auth()->user()->currency == 'euro')
                                [{{'€' . round(\App\Marketplace\Utility\FiatConverter::xmr2Eur($balanceOnEscProcess),2)}}
                                ]
                            @endif @if(auth()->user()->currency == 'gbp')
                                [{{'£' . round(\App\Marketplace\Utility\FiatConverter::xmr2Gbp($balanceOnEscProcess),2)}}
                                ]
                            @endif @if(auth()->user()->currency == 'try')
                                [{{'₺' . round(\App\Marketplace\Utility\FiatConverter::xmr2Try($balanceOnEscProcess),2)}}
                                ]
                            @endif
                        </p>
                        <p>Total coin on case: <span class="p-1 dark:bg-sky-700 dark:text-white rounded-lg">{{round( ($escBalance),3)}} XMR</span>
                            @if (auth()->user()->currency == 'usd')
                                [${{round(\App\Marketplace\Utility\FiatConverter::xmr2Usd($escBalance) ),3}}]
                            @endif @if(auth()->user()->currency == 'euro')
                                [{{'€' . round(\App\Marketplace\Utility\FiatConverter::xmr2Eur($escBalance),2)}}]
                            @endif @if(auth()->user()->currency == 'gbp')
                                [{{'£' . round(\App\Marketplace\Utility\FiatConverter::xmr2Gbp($escBalance),2)}}]
                            @endif @if(auth()->user()->currency == 'try')
                                [{{'₺' . round(\App\Marketplace\Utility\FiatConverter::xmr2Try($escBalance),2)}}]
                            @endif
                        </p>
                    </div>
                    <div
                        class="p-2 lg:col-span-3 border border-black col-span-6 shadow-xl shadow-blue-100 dark:border-blue-800 dark:border-opacity-50 rounded-lg dark:shadow-blue-800">
                        <p class="border-b w-fit mb-2 text-xl">Addresses for Send money to Escrow Wallet</p>
                        @foreach((new \App\Marketplace\xmrEscrow())->getEscWalletAddr('e') as $escrow)
                            <p class="break-all select-all mb-2">{{$escrow['address']}}</p>
                            @if ($loop->iteration == 3)
                                @break
                            @endif
                        @endforeach

                        {{--                        <p>Address for Send money to Commission Wallet</p>--}}
                        {{--                        @foreach((new \App\Marketplace\xmrEscrow())->getEscWalletAddr('c') as $commission)--}}
                        {{--                            <p class="break-all select-all">--}}
                        {{--                                {{$commission['address']}}--}}
                        {{--                            </p>--}}
                        {{--                            @if ($loop->iteration == 2)--}}
                        {{--                                @break--}}
                        {{--                            @endif--}}
                        {{--                        @endforeach--}}

                    </div>
                @endif

                <div
                    class="p-2 lg:col-span-6 border border-black rounded-md col-span-6 shadow-xl shadow-blue-100 dark:border-blue-800 dark:border-opacity-50 rounded-lg dark:shadow-blue-800">
                    <div
                        class="align-middle min-w-full  overflow-hidden sm:rounded-lg  p-3 justify-between">
                        <h1 class="font-bold border-b-2 border-r-2 max-w-fit border-black px-1">Withdraw</h1>

                        <form action="{{route('admin.withdrawxmr.post')}}" method="POST">
                            @csrf
                            <div class="mt-2">
                                <label for="sendAddr" class="uppercase font-bold text-xs text-gray-700">
                                    Address
                                </label>
                                <input class="border border-gray-400 dark:text-black p-1 w-full rounded"
                                       type="text"
                                       name="sendAddr"
                                       id="sendAddr"
                                       placeholder="Your XMR Address"
                                       required
                                >
                            </div>
                            <div class="mt-2">
                                <label for="amount" class="uppercase font-bold text-xs text-gray-700">
                                    Amount
                                </label>
                                <input class="border border-gray-400 dark:text-black p-1 w-full rounded"
                                       type="text"
                                       name="amount"
                                       id="amount"
                                       placeholder="Amount (example: 0.65)"
                                       required
                                >
                            </div>
                            
                            <div class="mt-2">
                                <label for="pin" class="uppercase font-bold text-xs text-gray-700">
                                    PIN
                                </label>
                                <input class="border border-gray-400 p-1 w-full rounded"
                                       type="text"
                                       name="pin"
                                       id="pin"
                                       placeholder="Enter Your PIN"
                                       required
                                >
                            </div>

                            <button type="submit"
                                    class="flex float-right items-center px-2 py-1 mt-4 text-green-600 transition-colors delay-100 border border-current rounded-lg hover:bg-green-600 group active:bg-indigo-500 focus:outline-none focus:ring">
  <span class="font-medium transition-colors group-hover:text-white">
    Check Out
  </span>
                                <span
                                    class="flex-shrink-0 p-1 ml-4 bg-white border border-green-600 rounded-full group-active:border-green-500">
    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
    </svg>
  </span>
                            </button>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </x-slot>
</x-layout>
