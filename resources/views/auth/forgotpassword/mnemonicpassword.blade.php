<x-layout>
    <x-slot name="content">
        <div class="max-w-3xl mx-auto my-24 text-center space-y-4 border rounded-md dark:border-blue-300 p-6">
            <h1 class="text-2xl">Reset Password <sup class="text-lg p-0.5 text-white bg-blue-400 rounded-md">MNEMONIC</sup>
            </h1>
            <h2 class="text-xl pt-6">Please enter your username, mnemonic and your new password</h2>

            <div class="w-11/12 mx-auto">
                <form method="POST" action="/forgotpassword/mnemonic">
                    @csrf
                    <x-form.input name="username" required="true" labelhidden="true" placeholder="Username" class="appearance-none border rounded w-full py-2 px-3 text-grey-darker dark:text-black"/>
                    <x-form.input name="mnemonic" required="true" labelhidden="true" placeholder="Mnemonic" class="appearance-none border rounded w-full py-2 px-3 text-grey-darker dark:text-black"/>
                    <div class="grid grid-cols-6 gap-2">
                        <div class="col-span-3">
                            <x-form.input name="password" type="password" required="true" labelhidden="true" placeholder="Password" class="appearance-none border rounded w-full py-2 px-3 text-grey-darker dark:text-black"/>
                        </div>
                        <div class="col-span-3">
                            <x-form.input name="password_confirmation" type="password" required="true" labelhidden="true" placeholder="Confirm Password" class="appearance-none border rounded w-full py-2 px-3 text-grey-darker dark:text-black"/>
                        </div>
                    </div>
                    <x-form.submitbutton>Send</x-form.submitbutton>
                </form>
            </div>

        </div>
    </x-slot>
</x-layout>
