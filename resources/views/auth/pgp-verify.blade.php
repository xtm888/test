<x-layout>
    <x-slot name="content">

        <div class="mx-4">
            <div class="max-w-3xl mx-auto border border-black rounded-md p-2 my-12 shadow-xl">
                <p class="text-2xl max-w-fit mx-auto border-b border-black">Sign In Verify!</p>
                <div class="text-center text-xl p-2">
                    <label for="decrypt_message" class="block p-2 mb-6 font-bold">Decrypt message and get code:</label>
                    <textarea name="decrypt_message" class="w-5/6 p-2" rows="10" style="resize: none;"
                              readonly>{{ session() -> get('login_encrypted_message') }}</textarea>
                </div>
                <div class="max-w-2xl border border-black p-4 rounded-md my-6 mx-8">
                    <form method="POST" action="{{ route('auth.pgp-verify.post') }}">
                        @csrf
                        <div class="inline-block justify-between flex flex-shrink-0 gap-1">
                            <div class="">
                                <label for="validation_code">Validation code:</label>
                                <input type="text" class="border border-gray-400 rounded-md px-2" required
                                       name="validation_code"
                                       id="validation_code"/>
                            </div>
                            <div class="border border-black rounded-md px-2 flex flex-shrink-0">
                                <button>Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </x-slot>
</x-layout>
