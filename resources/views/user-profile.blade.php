<x-layout>

    <x-slot name="title">
        {{$username}}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-2xl mx-auto border shadow-2xl dark:border-green-300 dark:border-opacity-30 rounded-xl dark:shadow-green-300 m-14 p-4">
            <div class="flex flex-col items-center">
                <p class="font-bold text-2xl p-2 mb-2">User: {{$username}}</p>
                @if($userPGP)
                <div class="max-w-xl">
                    <textarea class="w-full dark:bg-indigo-900 rounded-md" name="userpgp" id="userpgp" cols="130" rows="25">{{$userPGP}}</textarea>
                </div>
                @else
                    <p class="bg-red-900 text-white px-2">No PGP Exists!</p>
                @endif
            </div>
        </div>
    </x-slot>
</x-layout>
