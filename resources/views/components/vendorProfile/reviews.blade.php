@props(['vendor'])
<div class="py-8 max-w-5xl min-w-full mx-auto flex flex-row justify-center">
    <div
        class="bg-yellow-50 dark:bg-stone-800 rounded-lg p-4 mb-6 sm:inline-block border-2 dark:border-yellow-800 text-center shadow w-full">

        <div class="">
            <p class="p-1 font-medium text-lg ">Reviews</p>
        </div>

        @if(count($vendor->feedback))
            <div class="px-4 ">

                @foreach($vendor->feedback->sortByDesc('created_at') as $review)
                    <div class="mb-2 mt-4 shadow-lg  rounded-b-5xl overflow-hidden">
                        <div class="pt-2 md:pb-1 px-4 bg-white bg-opacity-40 dark:bg-black">
                            <div class="flex flex-wrap items-center">
                                <h4 class="w-full md:w-auto text-xl font-heading font-medium ">{{Str::mask($review->buyer->username,'*',2,5)}}</h4>
                                <div class="w-full md:w-px h-2 md:h-8 mx-8 bg-transparent md:bg-gray-200"></div>
                                <span>{{$review->product->name}}</span>
                                <div class="w-full md:w-px h-2 md:h-8 mx-8 bg-transparent md:bg-gray-200"></div>
                                <div class="flex flex-row p-1">
                                    <div>
                                        <div class="flex flex-shrink-0 justify-between">Quality:
                                            <p class="flex flex-shrink-0">@include('components.svg.feedback-stars', ['stars' => $review->quality_rate])
                                                ({{ $review -> quality_rate }})
                                                {{--                                            {{$product->user->vendor->countFeedbackByType('positive')}}--}}
                                                {{--                                            {{$product->user->vendor->countFeedbackByType('neutral')}}--}}
                                                {{--                                            {{$product->user->vendor->countFeedbackByType('negative')}}--}}
                                            </p>
                                        </div>
                                        <div class="flex flex-shrink-0 justify-between">Communication:
                                            <p class="flex flex-shrink-0">@include('components.svg.feedback-stars', ['stars' => $review -> communication_rate])
                                                ({{ $review -> communication_rate}})</p>
                                        </div>
                                        <div class="flex flex-shrink-0 justify-between">Shipping:
                                            <p class="flex flex-shrink-0">@include('components.svg.feedback-stars', ['stars' => $review -> shipping_rate])
                                                ({{ $review-> shipping_rate }})</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 overflow-hidden  pt-4 pb-4 bg-white dark:bg-slate-700 dark:text-gray-300">
                            <div class="flex flex-wrap">
                                <div class="w-full md:w-2/3 mb-4 md:mb-0 text-left">
                                    <p class="border max-w-fit px-2 dark:border-opacity-30 mb-2
                                     @if($review->type === 'positive')
                                        dark:bg-green-900
                                        @elseif($review->type === 'negative')
                                        dark:bg-red-900
                                        @elseif($review->type === 'neutral')
                                        dark:bg-yellow-900
                                        @endif
                                        ">
                                        Opinion: {{ucwords($review->type)}}
                                    </p>
                                    <p class="max-w-2xl leading-normal">{{$review->comment}}</p>
                                </div>
                                <div class="w-full md:w-1/3 text-right">
                                    <p class="mb-2 text-sm text-gray-300">{{$review->created_at->diffForHumans()}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>

        @else
            <div class="my-4 ">
                <p class="bg-cyan-900 px-2 w-fit mx-auto">No Review is Exists..</p>
            </div>
        @endif
    </div>
</div>
