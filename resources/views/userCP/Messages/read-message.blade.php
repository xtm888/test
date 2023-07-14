<x-layout>
    <x-slot name="content">
        <x-userCP.tabmenu/>

        <div class="p-6">
            <section class="shadow-xl rounded-md  lg:w-11/12 lg:mx-auto flex grid md:grid-cols-3 grid-cols-2 border">
                <x-userCP.messages.sidelist/>
                <x-userCP.messages.mainsection_withconversation :conversation="$conversation"/>
            </section>
        </div>

    </x-slot>
</x-layout>
