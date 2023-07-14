<x-layout>
    <x-slot name="content">

        {{--        <div class="mt-3">--}}
        {{--            <div class="form-group">--}}
        {{--                <p>Decrypt this message in order to get validation string:</p>--}}
        {{--                <textarea name="decrypt_message" class="form-control disabled" rows="8" style="resize: none;" disabled readonly>{{ session() -> get(\App\Marketplace\PGP::NEW_PGP_ENCRYPTED_MESSAGE) }}</textarea>--}}
        {{--            </div>--}}
        {{--        </div>--}}

        <div class="mx-4">
            <div class="max-w-3xl mx-auto border border-black dark:border-blue-200 rounded-md p-2 my-12 shadow-xl">
                <p class="text-2xl max-w-fit mx-auto border-b border-black mt-2">Sign In Verify!</p>
                <div class="text-center text-xl p-2">
                    <label for="decrypt_message" class="block p-2 mb-6 font-bold">Decrypt message and get code:</label>
                    <textarea name="decrypt_message" class="w-5/6 p-2 dark:bg-gray-700" rows="10" style="resize: none;"
                              readonly
                              disabled>{{ session() -> get(\App\Marketplace\PGP::NEW_PGP_ENCRYPTED_MESSAGE) }}</textarea>
                </div>
                <div class="max-w-2xl border border-black dark:border-blue-500 p-4 rounded-md my-6 mx-8">
                    <form method="POST" action="{{ route('auth.resetpgp')}}">
                        @csrf
                        <div class="grid grid-cols-6 gap-1">
                            <div class="col-span-3">
                                <x-form.input name="password" type="password" required="true" label="New Password"
                                              placeholder="new password"/>
                            </div>
                            <div class="col-span-3">
                                <x-form.input name="password_confirmation" type="password" required="true"
                                              label="Confirm Password" placeholder="confirm password"/>
                            </div>
                            <div class="col-span-4">
                                <x-form.input name="validation_string" required="true" label="Validation String"
                                              placeholder="enter validation code from pgp"
                                              class="appearance-none border rounded w-full py-2 px-3 text-grey-darker dark:text-black"
                                />
                            </div>
                            <div class="col-span-2 flex flex-col justify-center mt-3 ml-4">
                                <button class="border border-black dark:hover:border-blue-600 dark:hover:bg-blue-200 dark:hover:text-black dark:border-blue-900 rounded-md py-1.5" type="submit">Reset Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </x-slot>
</x-layout>
