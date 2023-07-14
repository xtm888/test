<x-layout>
    <x-slot name="title">
        Messages
    </x-slot>
    <x-slot name="content">
        <x-userCP.tabmenu/>

        <div class="container px-5 pt-24 mx-auto">
            <div class="mx-auto w-4/12 md:w-2/12 -mt-24 -mb-16">
                <x-svg.usercp-messages/>
            </div>
        </div>

        <div class="p-6">
            <section class="shadow-xl rounded-md  lg:w-11/12 lg:mx-auto flex grid md:grid-cols-3 grid-cols-2 border">
                <x-userCP.messages.sidelist/>
                @if(!$conversation->exists)
                    <x-userCP.messages.mainsection_withNoConversation/>
                @else
                    <x-userCP.messages.mainsection_withconversation :conversation="$conversation"/>
                @endif
            </section>
        </div>

    </x-slot>
</x-layout>
