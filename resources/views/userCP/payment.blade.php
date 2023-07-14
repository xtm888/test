<x-layout>
    <x-slot name="title">
        Deposit/Withdraw
    </x-slot>
    <x-slot name="content">
        <x-userCP.tabmenu/>

        <div class="container mx-auto max-w-fit p-3">

            <div class="animate-pulse overflow-hidden leading-normal rounded-sm max-w-fit mx-auto mt-6 border"
                 role="alert">
                <p class="px-4 py-3 font-bold text-white bg-black dark:bg-red-900">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px"
                         viewBox="0 0 24 24" width="24px" fill="currentColor" class="inline-block">
                        <g>
                            <rect fill="none" height="24" width="24"/>
                        </g>
                        <g>
                            <g>
                                <path
                                    d="M12,2C6.48,2,2,6.48,2,12s4.48,10,10,10s10-4.48,10-10S17.52,2,12,2z M12,20c-4.41,0-8-3.59-8-8s3.59-8,8-8s8,3.59,8,8 S16.41,20,12,20z"/>
                                <path d="M12,19c0.83,0,1.5-0.67,1.5-1.5h-3C10.5,18.33,11.17,19,12,19z"/>
                                <rect height="1.5" width="6" x="9" y="15"/>
                                <path
                                    d="M12,5c-2.76,0-5,2.24-5,5c0,1.64,0.8,3.09,2.03,4h5.95C16.2,13.09,17,11.64,17,10C17,7.24,14.76,5,12,5z M14.43,12.5H9.57 C8.89,11.84,8.5,10.95,8.5,10c0-1.93,1.57-3.5,3.5-3.5s3.5,1.57,3.5,3.5C15.5,10.95,15.11,11.84,14.43,12.5z"/>
                            </g>
                        </g>
                    </svg>
                    Dont send XMR to same address twice!
                </p>
                <p class="px-4 py-3 text-black bg-white dark:bg-indigo-300">Used wallet address changes automatically
                    when the transaction
                    is complete. </p>
            </div>

            <div class="mx-auto px-4 grid md:grid-cols-2 grid-cols-1 gap-3 justify-between mt-2">
                <div class="p-4 bg-gray-100 dark:bg-slate-800 border rounded mt-4 space-y-4">
                    <div class="grid grid-cols-11 text-center">
                        <p class="col-span-5">

                            1 XMR</p>
                        <p>
                            <svg class="w-8 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path d="M9 10L15 10" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M9 14L15 14" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path
                                    d="M3 12C3 4.5885 4.5885 3 12 3C19.4115 3 21 4.5885 21 12C21 19.4115 19.4115 21 12 21C4.5885 21 3 19.4115 3 12Z"
                                    stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </p>
                        <p class="col-span-5">
                            {{\App\Marketplace\Utility\FiatConverter::xmr2Eur(1)}} EURO
                        </p>
                    </div>
                </div>

                <div class="p-4 bg-gray-100 dark:bg-slate-800 border rounded mt-4 space-y-4">
                    <div class="grid grid-cols-11 text-center">
                        <p class="col-span-5">

                            1 XMR</p>
                        <p>
                            <svg class="w-8 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path d="M9 10L15 10" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M9 14L15 14" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path
                                    d="M3 12C3 4.5885 4.5885 3 12 3C19.4115 3 21 4.5885 21 12C21 19.4115 19.4115 21 12 21C4.5885 21 3 19.4115 3 12Z"
                                    stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </p>
                        <p class="col-span-5">
                            {{\App\Marketplace\Utility\FiatConverter::xmr2Gbp(1)}} GBP

                        </p>
                    </div>
                </div>

                <div class="p-4 bg-gray-100 dark:bg-slate-800 border rounded mt-4 space-y-4">
                    <div class="grid grid-cols-11 text-center">
                        <p class="col-span-5">

                            1 XMR</p>
                        <p>
                            <svg class="w-8 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path d="M9 10L15 10" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M9 14L15 14" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path
                                    d="M3 12C3 4.5885 4.5885 3 12 3C19.4115 3 21 4.5885 21 12C21 19.4115 19.4115 21 12 21C4.5885 21 3 19.4115 3 12Z"
                                    stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </p>
                        <p class="col-span-5">
                            {{\App\Marketplace\Utility\FiatConverter::xmr2Usd(1)}} USD

                        </p>
                    </div>
                </div>

                <div class="p-4 bg-gray-100 dark:bg-slate-800 border rounded mt-4 space-y-4">
                    <div class="grid grid-cols-11 text-center">
                        <p class="col-span-5">

                            1 XMR</p>
                        <p>
                            <svg class="w-8 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path d="M9 10L15 10" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M9 14L15 14" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path
                                    d="M3 12C3 4.5885 4.5885 3 12 3C19.4115 3 21 4.5885 21 12C21 19.4115 19.4115 21 12 21C4.5885 21 3 19.4115 3 12Z"
                                    stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </p>
                        <p class="col-span-5">
                            {{\App\Marketplace\Utility\FiatConverter::xmr2Try(1)}} TRY

                        </p>
                    </div>
                </div>
            </div>


            <div class="flex mt-8 mx-4  p-4 border border-double ring-4 dark:border-yellow-800 rounded-md">
                <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 space-y-4">
                    <div
                        class="align-middle min-w-full shadow overflow-hidden sm:rounded-sm border-b border-gray-200 dark:border-none p-3 flex flex-shrink-0 justify-between">
                        <h1 class="font-bold max-w-fit px-1">
                            Your Balance</h1>
                        <div class="flex flex-col">


                            <p>Balance: {{round( ($balance),3)}} XMR >>
                                @if (auth()->user())
                                    @if (auth()->user()->currency == 'usd')
                                        ${{round(\App\Marketplace\Utility\FiatConverter::xmr2Usd($balance)),3}}
                                    @endif
                                    @if(auth()->user()->currency == 'euro')
                                        €{{round(\App\Marketplace\Utility\FiatConverter::xmr2Eur($balance),2)}}
                                    @endif
                                    @if(auth()->user()->currency == 'gbp')
                                        £{{round(\App\Marketplace\Utility\FiatConverter::xmr2Gbp($balance),2)}}
                                    @endif
                                    @if(auth()->user()->currency == 'try')
                                        ₺{{round(\App\Marketplace\Utility\FiatConverter::xmr2Try($balance),2)}}
                                    @endif
                                @else
                                    {{round(\App\Marketplace\Utility\FiatConverter::xmr2Usd($balance) ),3}} $
                            @endif

                            <p>Ready to pay: {{round( ($readyBalance),3)}} XMR >>
                                @if (auth()->user())
                                    @if (auth()->user()->currency == 'usd')
                                        ${{round(\App\Marketplace\Utility\FiatConverter::xmr2Usd($readyBalance)),3}}
                                    @endif @if(auth()->user()->currency == 'euro')
                                        €{{round(\App\Marketplace\Utility\FiatConverter::xmr2Eur($readyBalance),2)}}
                                    @endif @if(auth()->user()->currency == 'gbp')
                                        £{{round(\App\Marketplace\Utility\FiatConverter::xmr2Gbp($readyBalance),2)}}
                                    @endif @if(auth()->user()->currency == 'try')
                                        ₺{{round(\App\Marketplace\Utility\FiatConverter::xmr2Try($readyBalance),2)}}
                                    @endif
                                @else
                                    {{round(\App\Marketplace\Utility\FiatConverter::xmr2Usd($readyBalance) ),3}} $
                                @endif
                            </p>
                        </div>

                    </div>
                    <div
                        class="align-middle shadow overflow-hidden sm:rounded-sm border-b border-gray-200 dark:border-none p-3">
                        <h1 class="font-bold border-b-2 border-r-2 max-w-fit border-black px-1 dark:border-gray-400">
                            Deposit Addresses</h1>
                        <div class="p-4 break-all w-full mx-auto">
                            @foreach($walletAddresses as $walletAddress)
                                <p class="select-all p-3 w-fit mx-auto @if(!$loop->last) border-b border-dotted @endif">
                                    {{$walletAddress['address']}}</p>
                            @endforeach
                        </div>

                    </div>


                    <div
                        class="align-middle shadow sm:rounded-sm border-b border-gray-200 dark:border-none p-3">
                        <h1 class="font-bold border-b-2 border-r-2 max-w-fit border-black px-1 dark:border-gray-400">
                            Payment History</h1>

                        @if(!count($histories))
                            <div class="m-auto p-4">
                                <p class="text-center text-lg font-bold border-2 border-black p-4 shadow-xl dark:shadow-lg dark:border-indigo-900 dark:shadow-indigo-900">
                                    No history exists yet!
                                </p>
                            </div>
                        @else

                            <div class="p-4 divide-y break-all">
                                <div class="flex flex-col">
                                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8 xl:-mx-12">
                                        <div
                                            class="inline-block py-2 max-w-7xl sm:mx-6 lg:mx-8 max-h-[400px] overflow-y-auto ">
                                            <div class=" shadow-md sm:rounded-lg">
                                                <table class="min-w-full">
                                                    <thead class="bg-gray-100 dark:bg-gray-700 ">
                                                    <tr>
                                                        <th scope="col"
                                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                            TXID
                                                        </th>
                                                        <th scope="col"
                                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                            TIME
                                                        </th>
                                                        <th scope="col"
                                                            class="truncate py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                            AMOUNT
                                                        </th>
                                                        <th scope="col"
                                                            class="truncate py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                            STATE
                                                        </th>
                                                        {{--                                                        <th scope="col" class="relative py-3 px-6">--}}
                                                        {{--                                                            <span class="sr-only">Edit</span>--}}
                                                        {{--                                                        </th>--}}
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($histories as $history)
                                                        <tr class="border-b odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700 dark:border-gray-600 ">

                                                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                {{$history['txid']}}
                                                            </td>
                                                            <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                                {{\Carbon\Carbon::parse($history['timestamp'])}}
                                                            </td>
                                                            <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                                {{round( ($history['amount'] / 1000000000000),3)}} XMR
                                                            </td>
                                                            <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                                {{$history['type']}}
                                                            </td>

                                                            {{--                                                        <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">--}}
                                                            {{--                                                            <a href="#"--}}
                                                            {{--                                                               class="text-blue-600 dark:text-blue-500 hover:underline">Edit</a>--}}
                                                            {{--                                                        </td>--}}
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div
                        class="align-middle min-w-full shadow overflow-hidden sm:rounded-sm dark:border-none border-b border-gray-200 p-3 justify-between">
                        <h1 class="font-bold border-b-2 border-r-2 max-w-fit border-black px-1 dark:border-gray-400">
                            Withdraw</h1>

                        <form action="{{route('user.withdrawxmr.post')}}" method="POST">
                            @csrf
                            <div class="mt-2">
                                <label for="sendAddr" class="uppercase font-bold text-xs text-gray-700">
                                    Address
                                </label>
                                <input class="border border-gray-400 p-1 w-full rounded"
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
                                <input class="border border-gray-400 p-1 w-full rounded"
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
    Withdraw
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
