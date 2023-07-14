<div
    class="flex flex-col px-4 py-6 md:p-6 xl:p-8 w-11/12 md:w-3/4 lg:w-2/4   border border-black dark:bg-gray-800 space-y-6 mx-auto">
    <h3 class="text-xl dark:text-white font-semibold leading-5 text-gray-800">Summary</h3>
    <div class="flex justify-center items-center w-full space-y-4 flex-col border-gray-200 border-b pb-4">
        @foreach($items as $productId => $item)
            <div class="flex justify-between w-full">
                <p class="text-base dark:text-white leading-4 text-gray-800">{{ $item -> offer -> product -> name }}
                    x {{$item->quantity}} {{$item->offer->product->count_type}}</p>
                <p class="text-base dark:text-gray-300 leading-4 text-gray-600">
                    @if (auth()->user())
                        @if (auth()->user()->currency == 'usd')
                            ${{$item->offer->price * $item->quantity}}
                        @endif @if(auth()->user()->currency == 'euro')
                            {{'€' . round(\App\Marketplace\Utility\FiatConverter::usd2Eur($item->offer->price * $item->quantity),2)}}
                        @endif @if(auth()->user()->currency == 'gbp')
                            {{'£' . round(\App\Marketplace\Utility\FiatConverter::usd2Gbp($item->offer->price * $item->quantity),2)}}
                        @endif @if(auth()->user()->currency == 'try')
                            {{'₺' . round(\App\Marketplace\Utility\FiatConverter::usd2Try($item->offer->price * $item->quantity),2)}}
                        @endif
                    @else
                        ${{$item->offer->price * $item->quantity}}
                    @endif
                    </p>
            </div>
            {{--            <div class="flex justify-between items-center w-full">--}}
            {{--                <p class="text-base dark:text-white leading-4 text-gray-800">Discount (50%)</p>--}}
            {{--                <p class="text-base dark:text-gray-300 leading-4 text-gray-600">-$1128.00 </p>--}}
            {{--            </div>--}}
            @if($item->offer->product->isPhysical())
                <div class="flex justify-between items-center w-full">
                    <p class="text-base dark:text-white leading-4 text-gray-800">
                        <svg class="h-8 w-8 text-black inline-block" width="24" height="24" viewBox="0 0 24 24"
                             stroke-width="2"
                             stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z"/>
                            <path d="M6 6v6a3 3 0 0 0 3 3h10l-5 -5m0 10l5 -5"/>
                        </svg>
                        Shipping: {{$item -> shipping -> name}}

                    </p>
                    <p class="text-base dark:text-gray-300 leading-4 text-gray-600">
                        @if (auth()->user())
                            @if (auth()->user()->currency == 'usd')
                                ${{$item -> shipping -> price}}
                            @endif @if(auth()->user()->currency == 'euro')
                                {{'€' . round(\App\Marketplace\Utility\FiatConverter::usd2Eur($item -> shipping -> price),2)}}
                            @endif @if(auth()->user()->currency == 'gbp')
                                {{'£' . round(\App\Marketplace\Utility\FiatConverter::usd2Gbp($item -> shipping -> price),2)}}
                            @endif @if(auth()->user()->currency == 'try')
                                {{'₺' . round(\App\Marketplace\Utility\FiatConverter::usd2Try($item -> shipping -> price),2)}}
                            @endif
                        @else
                            ${{$item -> shipping -> price}}
                        @endif
                    </p>
                </div>
            @endif
        @endforeach
    </div>

    <div class="flex justify-between items-center w-full">
        <p class="text-base dark:text-white font-semibold leading-4 text-gray-800">Total</p>
        <p class="text-base dark:text-gray-300 font-semibold leading-4 text-gray-600">
            @if (auth()->user())
                @if (auth()->user()->currency == 'usd')
                    ${{$totalSum}}
                @endif @if(auth()->user()->currency == 'euro')
                    {{'€' . round(\App\Marketplace\Utility\FiatConverter::usd2Eur($totalSum),2)}}
                @endif @if(auth()->user()->currency == 'gbp')
                    {{'£' . round(\App\Marketplace\Utility\FiatConverter::usd2Gbp($totalSum),2)}}
                @endif @if(auth()->user()->currency == 'try')
                    {{'₺' . round(\App\Marketplace\Utility\FiatConverter::usd2Try($totalSum),2)}}
                @endif
            @else
                ${{$totalSum}}
            @endif
            [{{round(\App\Marketplace\Utility\FiatConverter::usd2Xmr($totalSum) + 0.005 ,3)}} XMR]</p>
    </div>

    <a class="flex items-center justify-between px-5 py-3 text-indigo-600 transition-colors delay-100 border border-current rounded-lg hover:bg-indigo-600 group active:bg-indigo-500 focus:outline-none focus:ring"
       href="{{route('profile.cart.make.purchases')}}">
  <span class="font-medium transition-colors group-hover:text-white">
    Check Out
  </span>

        <span
            class="flex-shrink-0 p-2 ml-4 bg-white border border-indigo-600 rounded-full group-active:border-indigo-500">
    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
    </svg>
  </span>
    </a>
</div>
