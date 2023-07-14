<x-layout>
    <x-slot name="content">
        <div class="max-w-3xl mx-auto my-28">
            <div class="text-center border dark:border-blue-200 dark:shadow-blue-200 rounded-lg shadow-xl">
                <div
                    class="mx-auto p-4 m-8 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800 w-11/12"
                    role="alert">
                    <span class="text-2xl">Forgot your password?</span>
                </div>
                <div class="mt-8">
                    <p class="text-lg p-4">Please choose how to recover it</p>

                    <div class="m-14 grid grid-flow-col gap-5">
                        <div class="col-span-6 border-2 border-black my-1">
                            <form method="GET" action="{{route('auth.forgotpassword.pgp')}}">
                                <button type="submit" class="uppercase font-bold hover:bg-sky-700 min-w-full py-1 dark:bg-violet-900 dark:hover:bg-violet-800">PGP</button>
                            </form>
                        </div>

                        <div class="col-span-6 border-2 border-black my-1">
                            <form method="GET" action="{{route('auth.forgotpassword.mnemonic')}}">
                                <button type="submit" class="uppercase font-bold hover:bg-sky-700 min-w-full py-1 dark:bg-violet-900 dark:hover:bg-violet-800">Mnemonic</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </x-slot>
</x-layout>
