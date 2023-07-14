<x-layout>
    <x-slot name="content">
        <x-adminCP.tabmenu/>

        @if(count($reviews))
            <div class="max-w-6xl mx-auto">
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <!-- head -->
                        <thead>
                        <tr>
                            <th></th>
                            <th>Vendor</th>
                            <th>Buyer</th>
                            <th>Product</th>
                            <th>Review</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        @foreach($reviews as $review)
                        <tbody>
                        <!-- row 1 -->
                        <tr>
                            <th>{{$loop->iteration}}</th>
                            <td><a href="{{route('vendor.show',$review->vendor->user->username)}}">{{$review->vendor->user->username}}</a></td>
                            <td>{{$review->buyer->username}}</td>
                            <td>{{$review->product->name}}</td>
                            <td>
                                <label for="readreview{{$review -> id}}"
                                       class="btn modal-button">READ</label>

                                <!-- Put this part before </body> tag -->
                                <input type="checkbox" id="readreview{{$review -> id}}" class="modal-toggle">
                                <div class="modal">
                                    <div class="modal-box">
                                        <h3 class="font-bold text-lg">Read Review</h3>
                                        <p class="py-4 flex w-11/12">{{$review->comment}}</p>
                                        <div class="modal-action justify-start">
                                            <label for="readreview{{$review -> id}}" class="btn">DONE</label>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>Delete - Edit</td>
                        </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        @else
            <div class="flex w-full h-96">
                <div class="m-auto">
                    <p class="uppercase text-xl font-bold border-2 border-black p-4 shadow-xl dark:border-indigo-900 dark:shadow-indigo-900">
                        No Reviews Yet!
                    </p>
                </div>
            </div>
        @endif

    </x-slot>
</x-layout>
