@props(['vendor'])
<div class="p-0.5 bg-gray-300 dark:bg-yellow-900 rounded-lg  w-full mx-auto">
    <div class="block p-4 bg-white sm:p-5 rounded-2xl mx-2 dark:bg-stone-800">
        <details class="w-full ">
            <summary
                class="cursor-pointer w-full flex justify-between  after:content-['>']">
                Vendor PGP Address
            </summary>
            {{--            <p class="whitespace-pre-line border p-6 mt-2 mx-auto max-w-2xl text-xs sm:text-sm select-all">--}}
            <textarea name="decrypt_message" class="w-full p-2 mt-4 dark:bg-gray-900" rows="10" style="resize: none;"
                      readonly>{{ $vendor->user->pgp_key }}</textarea>
        </details>
    </div>
</div>
