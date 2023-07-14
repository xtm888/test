<x-layout>
    <x-slot name="content">
        <x-userCP.tabmenu/>
        @if($purchase -> isDelivered() && $purchase -> isBuyer() && !$purchase -> hasFeedback())

            <div class="max-w-4xl mx-auto">
                <div class="p-4 border rounded-lg border-purple-500 shadow-lg shadow-purple-500 flex flex-col">
                    <h1 class="text-xl dark:bg-stone-900 p-2 rounded-xl w-fit mx-auto mb-2">Feedback for your purchase</h1>

                    <div class="mt-2">
                        <p>
                            <span>Product: {{$purchase->offer->product->name}} - {{$purchase->quantity . ' ' . $purchase->offer->product->count_type }} </span>
                        </p>
                        <p><span>Vendor: {{$purchase->vendor->user->username}}</span></p>
                    </div>

                    <div class="mt-3">
                        <form action="{{ route('profile.purchases.feedback.new', $purchase)}}" method="POST">
                            @csrf
                            <div class="">

                                <div class="flex flex-col md:flex-row justify-between gap-2">

                                    <div class="flex-shrink-0">
                                        <label for="quality_rate">Quality:</label>
                                        <select name="quality_rate" id="quality_rate"
                                                class="select select-bordered max-w-xs">
                                            @for($i=1; $i<=5; $i++)
                                                <option value="{{ $i }}">
                                                    {{ $i }} {{ Str::plural('star', $i) }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <div class="flex-shrink-0 ">
                                        <label for="communication_rate">Communication:</label>
                                        <select name="communication_rate" id="communication_rate"
                                                class="select select-bordered max-w-xs">
                                            @for($i=1; $i<=5; $i++)
                                                <option value="{{ $i }}">
                                                    {{ $i }} {{ Str::plural('star', $i) }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="flex flex-col md:flex-row justify-between">
                                    <div class="flex-shrink-0 mt-2 ">
                                        <label for="shipping_rate">Shipping:</label>
                                        <select name="shipping_rate" id="shipping_rate"
                                                class="select select-bordered max-w-xs">
                                            @for($i=1; $i<=5; $i++)
                                                <option value="{{ $i }}">
                                                    {{ $i }} {{ Str::plural('star', $i) }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <div class="flex-shrink-0 mt-2">
                                        <label for="type">Satisfaction:</label>
                                        <select name="type" id="type" class="select select-bordered max-w-xs">
                                            <option value="positive">Positive</option>
                                            <option value="neutral" selected>Neutral</option>
                                            <option value="negative">Negative</option>
                                        </select>
                                    </div>

                                </div>


                                <div class="">
                                    <label class="hidden" for="comment">Comment:</label>
                                    <textarea name="comment" id="comment" rows="4" class="textarea textarea-bordered w-full mt-3"
                                              placeholder="Place your review here"></textarea>

                                </div>
                                <button type="submit" class="btn btn-block mt-4">Leave
                                    feedback
                                </button>

                            </div>
                        </form>
                    </div>

                </div>
            </div>

        @elseif($purchase -> isDelivered() && $purchase -> hasFeedback())
            <tr>
                <td colspan="2">
                    <h4>Feedback by buyer</h4>
                    <ul class="list-group">
                        <li class="list-group-item">
                            Qualtiy:
                            @include('components.svg.feedback-stars', ['stars' => $purchase -> feedback -> quality_rate])
                        </li>
                        <li class="list-group-item">
                            Shipping:
                            @include('components.svg.feedback-stars', ['stars' => $purchase -> feedback -> shipping_rate])
                        </li>
                        <li class="list-group-item">
                            Communication:
                            @include('components.svg.feedback-stars', ['stars' => $purchase -> feedback -> communication_rate])
                        </li>
                        <li class="list-group-item">
                            Type:
                            {{ $purchase->feedback->getType() }}
                        </li>
                        <li class="list-group-item text-center">
                            {{ $purchase -> feedback -> comment }}
                        </li>
                    </ul>
                </td>
            </tr>
        @endif
    </x-slot>
</x-layout>
