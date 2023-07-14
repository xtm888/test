<x-layout>
    <x-slot name="content">

        <div class="mx-4">
            <div class="max-w-3xl mx-auto border border-black dark:border-yellow-900 rounded-md p-2 my-12 shadow-xl">
                <p class="text-2xl max-w-fit mx-auto border-b border-black dark:border-yellow-900">Set your PGP Key!</p>
                <div class="text-center text-xl p-2">
                    <label for="decrypt_message" class="block p-2 mb-6 font-bold">Decrypt message and get code:</label>
                    <textarea name="decrypt_message" class="w-5/6 p-2 dark:bg-sky-900" rows="10" style="resize: none;"
                              readonly>{{{ session() -> get(\App\Marketplace\PGP::NEW_PGP_ENCRYPTED_MESSAGE) }}}</textarea>
                </div>
                <div class="max-w-2xl border border-black dark:border-yellow-900 p-4 rounded-md my-6 mx-8">
                    <form method="POST" action="{{ route('profile.pgp.store') }}">
                        @csrf
                        <div class="inline-block justify-between flex flex-shrink-0 gap-1">
                            <div class="">
                                <label for="validation_number">Validation code:</label>
                                <input type="text" class="border border-gray-400 dark:text-black rounded-md px-2" required
                                       name="validation_number"
                                       id="validation_number"/>
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
