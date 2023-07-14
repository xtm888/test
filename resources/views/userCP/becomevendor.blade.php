<x-layout>
    <x-slot name="content">
        <x-userCP.tabmenu/>


        <div class="max-w-3xl mx-auto min-h-[240px]">

            <div class="flex justify-between pt-8">
                <x-svg.becomevendor-man/>
                <div class="flex-row text-center">
                    <p class="text-gray-500 text-xl">
                        Vendor Fee is {{config('marketplace.vendor_fee')}}$
                        [{{round(\App\Marketplace\Utility\FiatConverter::usd2Xmr(config('marketplace.vendor_fee')) + 0.005 ,3)}}
                        XMR]
                    </p>
                    <form action="{{ route('profile.vendor.become') }}" class="mt-4">
                        <button type="submit" class="btn btn-lg btn-success">
                            Become a Vendor
                        </button>
                    </form>
                </div>
            </div>

            {{--                <div--}}
            {{--                    class="border-2 border-yellow-600 rounded-lg px-3 py-2 text-yellow-400 cursor-pointer hover:bg-yellow-600 hover:text-yellow-200">--}}
            {{--                    <p class="text-slate-800">Vendor Fee is {{config('marketplace.vendor_fee')}}$--}}
            {{--                        [{{round(\App\Marketplace\Utility\FiatConverter::usd2Xmr(config('marketplace.vendor_fee')) + 0.005 ,3)}}--}}
            {{--                        XMR]</p>--}}
            {{--                </div>--}}

            {{--            <div>--}}
            {{--                <form action="{{ route('profile.vendor.become') }}" class="form-inline">--}}
            {{--                    <button type="submit" class="btn btn-lg btn-success">--}}
            {{--                        Become a Vendor--}}
            {{--                    </button>--}}
            {{--                </form>--}}
            {{--            </div>--}}

            {{--                        <h1 class="text-lg sm:text-xl font-semibold  text-gray-600">--}}
            {{--                            Become a vendor on {{Cache::tags(['MarketPlace'])->get('MPCACHE')->name}}--}}
            {{--                        </h1>--}}
            {{--                        <p class="text-gray-500 text-xl text-center">--}}
            {{--                            Vendor Fee is {{config('marketplace.vendor_fee')}}$--}}
            {{--                            [{{round(\App\Marketplace\Utility\FiatConverter::usd2Xmr(config('marketplace.vendor_fee')) + 0.005 ,3)}}--}}
            {{--                            XMR]--}}
            {{--                        </p>--}}

        </div>
    </x-slot>
</x-layout>
