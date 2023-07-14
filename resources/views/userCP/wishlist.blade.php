<x-layout>
    <x-slot name="title">
        Wishlist
    </x-slot>
    <x-slot name="content">
        <x-userCP.tabmenu/>

        <div class="container px-5 pt-24 mx-auto">
            <div class="mx-auto w-4/12 md:w-2/12 -mt-24 -mb-12">
                <x-svg.usercp-wishlist/>
            </div>
        </div>

        @if(count(auth() -> user() -> whishes ) > 0)
            <div class="max-w-6xl mx-auto">

                <div class="flex flex-wrap justify-center gap-6 py-8 ">
                    @foreach(auth() -> user() -> whishes() ->orderByDesc('created_at') -> get() as $whish)
                        <div class="  p-4  w-full xl:w-1/3 2xl:w-1/3">


                            <div class="flex justify-between m-6 ">
                                <div class="flex flex-col h-full max-w-lg mx-auto bg-gray-800 rounded-lg">
                                    <img
                                        class="rounded-lg rounded-b-none h-64"
                                        src="{{ asset('storage/'  . $whish -> product -> frontImage() -> image) }}"
                                        alt="thumbnail"
                                        loading="lazy"
                                    />

                                    <div class="h-40">
                                        <div class="flex justify-end mt-2 px-4">
                                            <p> {{ $whish -> product -> type }} &gt; <span
                                                    class="badge badge-info">{{ $whish -> product -> category -> name }}</span>
                                            </p>
                                        </div>
                                        <div class="py-2 px-4">
                                            <h1
                                                class="text-xl font-medium leading-6 tracking-wide text-gray-300 hover:text-blue-500 cursor-pointer"
                                            >
                                                <a href="{{ route('product.show', $whish -> product) }}">{{ $whish -> product -> name }}</a>
                                            </h1>
                                            <div class="">
                                                <p>
                                                    Posted by <a
                                                        href="{{ route('vendor.show', $whish -> product -> user) }}"
                                                        class="badge badge-info">{{ $whish -> product -> user -> username }}</a>,
                                                    <strong>{{ $whish -> product -> quantity . ' ' . $whish -> product -> count_type }}</strong>
                                                    left
                                                </p>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="flex flex-row items-end h-full w-full px-4 mt-4">
                                        <div class="flex border-t border-gray-700 w-full py-4">
                                            <div
                                                class="flex items-center space-x-3 border-r border-gray-700 w-full"
                                            >

                                                <a href="{{ route('product.show', $whish -> product) }}"
                                                   class="btn btn-primary d-block">Buy now</a>

                                            </div>
                                            <div class="flex items-center flex-shrink-0 px-2">
                                                <div class="flex items-center space-x-1 text-gray-400">
                                                    <a href="{{ route('profile.wishlist.add', $whish -> product) }}"
                                                       class="btn btn-primary d-block">Remove wishlist</a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach

                </div>

            </div>

        @else
            <div class="flex w-full h-96">
                <div class="m-auto">
                    <p class="uppercase text-xl font-bold border-2 border-black p-4 shadow-xl dark:border-indigo-900 dark:shadow-indigo-900">
                        YOUR WISHLIST is EMPTY!
                    </p>
                </div>
            </div>
        @endif


    </x-slot>
</x-layout>
