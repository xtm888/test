<x-layout>
    <x-slot name="content">

        <div class="mx-4">
            <div class="max-w-3xl mx-auto border border-black dark:border-yellow-900 rounded-md p-2 my-12 shadow-xl">
                <p class="text-2xl max-w-fit mx-auto border-b border-black dark:border-yellow-900">Save Your Mnemonic!</p>
                <p class="text-center text-xl p-2">
                    Your mnemonic key consisting of {{config('marketplace.products_per_page')}} words is located below.
                    It is required for recover forgotten passwords. Shown for a one-time.
                </p>
                <div class="max-w-2xl mx-auto border border-black dark:border-yellow-900 p-4 rounded-md my-6 mx-8 text-center">
                    {{$mnemonic}}
                </div>
                <div>
                    <p class="text-center my-4">
                        <a href="{{route('auth.signin')}}" class="btn">Done, i saved!</a>
                    </p>
                </div>
            </div>
        </div>

    </x-slot>
</x-layout>
