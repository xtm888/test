<x-layout>
    <x-slot name="content">
        <x-vendorCP.tabmenu/>

        @if(!count($sales) > 0)
            <div class="flex w-full h-96">
                <div class="m-auto">
                    <p class="uppercase text-xl font-bold border-2 border-black p-4 shadow-xl dark:border-indigo-900 dark:shadow-indigo-900">
                        You did not receive any orders..
                    </p>
                </div>
            </div>
        @else
            <div class="flex flex-col justify-center ">
                <div
                    class="overflow-x-auto max-h-[500px] mx-4 border dark:border-blue-600 shadow-lg shadow-blue-600 rounded-sm ">
                    <table class="table w-full">
                        <!-- head -->
                        <thead>
                        <tr>
                            <td>ORDER ID</td>
                            <th>ITEM</th>
                            <th>SHIPPING</th>
                            <th>BUYER</th>
                            <th>DATE</th>
                            <th>AMOUNT</th>
                            <th>PAID</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- row 1 -->
                        @foreach($sales as $purchase)
                            <tr>
                                <td>
                                    <!-- The button to open modal -->
                                    <label for="view{{$purchase->short_id}}" class="btn modal-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="36px"
                                             viewBox="0 0 24 24" width="36px" class="text-blue-100" fill="currentColor">
                                            <g>
                                                <rect fill="none" height="24" width="24"/>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M18.19,12.44l-3.24-1.62c1.29-1,2.12-2.56,2.12-4.32c0-3.03-2.47-5.5-5.5-5.5s-5.5,2.47-5.5,5.5c0,2.13,1.22,3.98,3,4.89 v3.26c-2.15-0.46-2.02-0.44-2.26-0.44c-0.53,0-1.03,0.21-1.41,0.59L4,16.22l5.09,5.09C9.52,21.75,10.12,22,10.74,22h6.3 c0.98,0,1.81-0.7,1.97-1.67l0.8-4.71C20.03,14.32,19.38,13.04,18.19,12.44z M17.84,15.29L17.04,20h-6.3 c-0.09,0-0.17-0.04-0.24-0.1l-3.68-3.68l4.25,0.89V6.5c0-0.28,0.22-0.5,0.5-0.5c0.28,0,0.5,0.22,0.5,0.5v6h1.76l3.46,1.73 C17.69,14.43,17.91,14.86,17.84,15.29z M8.07,6.5c0-1.93,1.57-3.5,3.5-3.5s3.5,1.57,3.5,3.5c0,0.95-0.38,1.81-1,2.44V6.5 c0-1.38-1.12-2.5-2.5-2.5c-1.38,0-2.5,1.12-2.5,2.5v2.44C8.45,8.31,8.07,7.45,8.07,6.5z"/>
                                                </g>
                                            </g>
                                        </svg>
                                    </label>

                                    <!-- Put this part before </body> tag -->
                                    <input type="checkbox" id="view{{$purchase->short_id}}" class="modal-toggle">
                                    <div class="modal">
                                        <div class="modal-box">
                                            <h3 class="font-bold text-lg">Product List ID</h3>
                                            <p class="py-4 select-all">{{$purchase->short_id}}</p>
                                            <div class="modal-action">
                                                <label for="view{{$purchase->short_id}}" class="btn">OK!</label>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{$purchase->offer->product->name}}</td>
                                <td>
                                    @if($purchase->offer->product->isPhysical())
                                        {{$purchase->shipping->name}}
                                    @else
                                        <span class="dark:bg-purple-300 rounded dark:text-black p-1">Digital</span>
                                    @endif
                                </td>
                                <td>{{$purchase->buyer->username}}</td>
                                <td>{{$purchase->created_at->format('d.m.Y')}}</td>
                                <td>{{$purchase->quantity . ' ' . $purchase->offer->product->count_type}}</td>
                                <td>{{$purchase->to_pay + 0}} XMR</td>
                                <td>
                                <span
                                    class="p-1 inline-flex text-sm  leading-5 font-semibold rounded-full bg-violet-900 text-gray-300">{{ ucfirst($purchase -> state) }}</span>
                                </td>
                                <td>

                                @if($purchase->type == 'normal' && $purchase -> isPurchased() && $purchase -> isVendor())
                                        <label for="sent{{$purchase -> id}}"
                                               class="p-2 dark:bg-amber-400 dark:text-slate-900 rounded-md modal-button cursor-pointer">Sent</label>

                                        <!-- Put this part before </body> tag -->
                                        <input type="checkbox" id="sent{{$purchase -> id}}" class="modal-toggle">
                                        <div class="modal">
                                            <div class="modal-box">
                                                <h3 class="font-bold text-lg mb-4">Are you sure?!</h3>
                                                <p class="py-2">Purchase will be marked as sent.</p>
                                                <p class="py-2">This can not be reverted!</p>
                                                <p class="py-2">Confirm that you have sent -></p>
                                                <p class="py-2">{{$purchase->quantity . ' ' . $purchase->offer->product->count_type}}</p>
                                                <p class="py-2">{{$purchase->offer->product->name}} </p>

                                                <div class="modal-action">
                                                    <a class="btn"
                                                       href="{{route('profile.sales.sent',$purchase->id)}}">YES,
                                                        Item has been sent</a>
                                                    <label for="sent{{$purchase -> id}}" class="btn">CANCEL</label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if($purchase->isPurchased() && $purchase -> isVendor())
                                        <label for="cancel{{$purchase -> id}}"
                                               class="p-2 dark:bg-cyan-800 dark:text-slate-300 rounded-md modal-button cursor-pointer">Cancel</label>

                                        <!-- Put this part before </body> tag -->
                                        <input type="checkbox" id="cancel{{$purchase -> id}}" class="modal-toggle">
                                        <div class="modal">
                                            <div class="modal-box">
                                                <h3 class="font-bold text-lg">Are you sure?!</h3>
                                                <p class="py-4">Purchase will be cancelled.</p>
                                                <p>This can not be reverted!</p>
                                                <p>Money will be refunded!</p>

                                                <div class="modal-action">
                                                    <a class="btn"
                                                       href="{{route('profile.purchases.canceled',$purchase->id)}}">YES,
                                                        Cancel the purchase</a>
                                                    <label for="cancel{{$purchase -> id}}" class="btn">EXIT</label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if($purchase->isDisputed())
                                        <a class="p-2 dark:bg-red-900 dark:text-slate-300 rounded-md"
                                           href="{{route('profile.purchases.disputes.message.view',$purchase->id)}}">Check
                                            Dispute Process</a>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </x-slot>
</x-layout>
