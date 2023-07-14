<x-layout>
    <x-slot name="content">
        @if(request()->is('profile/purchase/*'))
            <x-userCP.tabmenu/> @elseif(request()->is('profile/vendor/*'))
            <x-vendorCP.tabmenu/>@endif


        {{-- Disputes --}}
        <div class="mx-4">
            <div class="flex flex-row max-w-5xl mx-auto">
                <div class="mt-5 py-2 min-w-full" id="dispute">
                    @if($purchase -> isDisputed())
                        <h3 class="mb-1">Dispute</h3>
                        <hr>
                        @if(!$purchase -> dispute -> isResolved() && auth() -> user() -> isAdmin())
                            <h5 class="mb-1">Resolve dispute</h5>
                            <form action="{{ route('profile.purchases.disputes.resolve', $purchase) }}" class=""
                                  method="POST">
                                @csrf
                                <label for="winner" class="mr-2">Dispute winner:</label>
                                <select name="winner" id="winner" class="select select-bordered w-full max-w-xs">
                                    <option disabled selected>Choose Winner</option>
                                    <option value="{{ $purchase -> buyer -> id }}">{{ $purchase -> buyer -> username }}
                                        - buyer
                                    </option>
                                    <option
                                        value="{{ $purchase -> vendor -> id }}">{{ $purchase -> vendor -> user -> username }}
                                        - vendor
                                    </option>
                                </select>
{{--                                <select name="winner" id="winner" class=" mr-2">--}}
{{--                                    <option value="{{ $purchase -> buyer -> id }}">{{ $purchase -> buyer -> username }}--}}
{{--                                        ---}}
{{--                                        buyer--}}
{{--                                    </option>--}}
{{--                                    <option--}}
{{--                                        value="{{ $purchase -> vendor -> id }}">{{ $purchase -> vendor -> user -> username }}--}}
{{--                                        - vendor--}}
{{--                                    </option>--}}
{{--                                </select>--}}
                                <button type="submit" class="btn btn-outline-primary">Resolve dispute</button>
                            </form>
                        @elseif($purchase -> dispute -> isResolved())
                            <h5 class="mb-1">Dispute resolved</h5>
                            <p class="alert alert-success">Winner:
                                <strong>{{ $purchase -> dispute -> winner -> username }}</strong></p>
                        @endif


                        @foreach($purchase -> dispute -> messages as $message)
                            <div class="my-2 flex flex-col">
                                <div class="">
                                    {{ $message -> message }}
                                </div>
                                <div class="text-muted">
                                    {{ $message -> time_ago }} by <a
                                        href="{{ route('vendor.show', $message -> author) }}">{{ $message -> author -> username }} {{ $purchase -> userRole($message -> author) }}</a>
                                </div>
                            </div>
                        @endforeach

                        @if(!$purchase -> dispute -> isResolved())
                            <form action="{{ route('profile.purchases.disputes.message', $purchase -> dispute) }}"
                                  method="POST">
                                @csrf
                                <div class="mt-4">
                                    <div class="my-2  min-w-full">
                                        <div class="hidden">
                                            <h5><label for="newmessage">New message:</label></h5>
                                        </div>
                                        <div class="">
                                <textarea name="message" id="newmessage" class=" min-w-full" id="message"
                                          placeholder="Answer the dispute"
                                          rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <button type="submit" class="btn btn-block btn-primary">Send message
                                    </button>
                                </div>
                            </form>
                        @endif

                    @else
                        <h3 class="mb-1 w-fit mx-auto text-xl border-b">Open Dispute</h3>
                        <p class="mt-4 text-lg">
                            Purchased Item: {{$purchase->offer->product->name}}
                        </p>
                        <p class="text-lg">
                            Purchased Time: {{$purchase->created_at}}
                        </p>
                        <p class="text-lg">
                            Amount: {{$purchase->quantity . ' ' . $purchase->offer->product->count_type}}
                        </p>
                        <p class="text-lg">
                            Seller: {{$purchase->vendor->user->username}} || Buyer: {{$purchase->buyer->username}}
                        </p>

                        <p class="my-3 py-4 alert alert-success">If the item was not delivered to you as agreed or if there is any other problem, open dispute. Dispute will be concluded in favor of the buyer or the seller.</p>

                        <form method="POST" action="{{ route('profile.purchases.dispute', $purchase) }}">
                            @csrf
                            <div class="flex flex-col">
                                <label for="message">Dispute message:</label>
                                <textarea name="message" id="message" class="rounded-md p-2" rows="5"
                                          placeholder="Type the message for the dispute"></textarea>
                            </div>
                            <button type="submit" class="btn btn-block mt-4  btn-danger">Submit dispute</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </x-slot>
</x-layout>
