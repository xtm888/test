<x-layout>
    <x-slot name="content">
        <x-userCP.tabmenu/>


                <div class="max-w-3xl mx-auto my-24 text-center space-y-4">
                    <h1 class="text-2xl">Decrypt Messages
                    </h1>
                    <h2 class="text-xl pt-6">All your messages are encrypted. Please enter your password to unlock your decryption key and make messages viewable.</h2>

                    <div class="w-11/12 mx-auto">
                        <form method="POST" action="{{route('profile.messages.decrypt.post')}}">
                            @csrf
                            <x-form.input name="password" type="password" required="true" labelhidden="true" placeholder="Password"/>
                            <x-form.submitbutton>Decrypt messages</x-form.submitbutton>
                        </form>
                    </div>

                </div>



    </x-slot>
</x-layout>
