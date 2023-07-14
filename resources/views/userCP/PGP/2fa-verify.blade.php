<x-layout>
    <x-slot name="content">
{{--        <div class="flex flex-row mt-5 justify-content-center">--}}
{{--            <div class="col-md-6 text-center">--}}
{{--                <h2>Sign In Verify</h2>--}}
{{--                <div class="form-group ">--}}
{{--                    <label for="decrypt_message">Decrypt this message:</label>--}}
{{--                    <textarea name="decrypt_message" class="form-control" rows="10" style="resize: none;"--}}
{{--                              readonly>{{{ session() -> get('login_encrypted_message') }}}</textarea>--}}
{{--                    <p class="text-muted">Decrypt this message and get validation string.</p>--}}
{{--                </div>--}}
{{--                <form method="POST" action="{{ route('auth.verify.post') }}" class="form-inline">--}}
{{--                    @csrf--}}
{{--                    <label for="validation_string">Validation string:</label>--}}
{{--                    <input type="text" class="form-control mx-2" required name="validation_string"--}}
{{--                           id="validation_string"/>--}}
{{--                    <button class="btn btn-outline-success">CONFIRM</button>--}}

{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="mx-4">
            <div class="max-w-3xl mx-auto border border-black dark:border-yellow-900 rounded-md p-2 my-12 shadow-xl">
                <p class="text-2xl max-w-fit mx-auto border-b border-black dark:border-yellow-900">Sign In Verify!</p>
                <div class="text-center text-xl p-2">
                    <label for="decrypt_message" class="block p-2 mb-6 font-bold">Decrypt message and get code:</label>
                    <textarea name="decrypt_message" class="w-5/6 p-2 dark:bg-sky-900" rows="10" style="resize: none;"
                              readonly>{{{ session() -> get('login_encrypted_message') }}}</textarea>
                </div>
                <div class="max-w-2xl border border-black dark:border-yellow-900 p-4 rounded-md my-6 mx-8">
                    <form method="POST" action="{{ route('auth.verify.post') }}">
                        @csrf
                        <div class="inline-block justify-between flex flex-shrink-0 gap-1">
                            <div class="">
                                <label for="validation_string">Validation code:</label>
                                <input type="text" class="border border-gray-400 dark:text-black rounded-md px-2" required
                                       name="validation_string"
                                       id="validation_string"/>
                            </div>
                            <div class="border border-black dark:border-green-300 dark:bg-green-700 rounded-md px-2 flex flex-shrink-0">
                                <button type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-slot>
</x-layout>
