<x-layout>
    <x-slot name="content">
        <x-adminCP.tabmenu/>

        @if(count($allDisputes))
            <div class="max-w-screen-xl mx-auto">
                <table class="table w-full">
                    <thead>
                    <tr>
                        <th>Purchase SID</th>
                        <th>Buyer</th>
                        <th>Vendor</th>
                        <th>Winner</th>
                        <th>Total</th>
                        <th>Time</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($allDisputes as $dispute)
                        <tr>
                            <td>
                                <p class="btn btn-sm btn-mblue mt-1">{{ $dispute -> purchase -> short_id }}</p>
                            </td>
                            <td>
                                {{ $dispute -> purchase -> buyer -> username }}
                            </td>
                            <td>
                                <a href="{{ route('vendor.show', $dispute -> purchase -> vendor -> user -> username) }}">{{ $dispute -> purchase -> vendor -> user -> username }}</a>
                            </td>
                            <td>
                                @if($dispute -> isResolved())
                                    <span class="badge badge-primary">{{ $dispute -> winner -> username }}</span>
                                @else
                                    <span class="badge badge-warning">Unresolved</span>
                                @endif
                            </td>
                            <td>
                                {{--                        {{$dispute->purchase->getSumLocalCurrency()}} {{$dispute -> purchase->getLocalSymbol()}}--}}
                                {{$dispute->purchase->to_pay + 0}} XMR
                                {{--{{ $dispute -> purchase -> value_sum }} $--}}
                            </td>
                            <td>
                                {{ $dispute -> timeDiff() }}
                            </td>
                            <td>
                                <a class="btn"
                                   href="{{route('buyeradmin.profile.purchases.disputes.message.view',$dispute -> purchase)}}">Details</a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{--            <div class="row">--}}
                {{--                <div class="col-md-6 offset-md-3">--}}
                {{--                    <div class="text-center">--}}
                {{--                        PAGINATE WILL BE HERE!--}}
                {{--                        --}}{{--                    {{ $allDisputes->links('includes.paginate') }}--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--            </div>--}}
            </div>
        @else
            <div class="flex w-full h-96">
                <div class="m-auto">
                    <p class="uppercase text-xl font-bold border-2 border-black p-4 shadow-xl dark:border-indigo-900 dark:shadow-indigo-900">
                        No Disputes Opened!
                    </p>
                </div>
            </div>
        @endif
    </x-slot>
</x-layout>
