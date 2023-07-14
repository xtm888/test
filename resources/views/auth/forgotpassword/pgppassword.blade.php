<x-layout>
    <x-slot name="content">
        <div class="max-w-3xl mx-auto my-24 text-center space-y-4 border p-6 rounded-md">
            <h1 class="text-2xl">Reset Password <sup class="text-lg p-0.5 text-white bg-blue-400 rounded-md">PGP</sup>
            </h1>
            <h2 class="text-xl pt-6">Please enter your username</h2>

            <div>
                <form method="post" action="/forgotpassword/pgp">
                    @csrf
                    <x-form.input name="username" required="true" labelhidden="true" placeholder="Username"
                                  class="appearance-none border rounded w-4/6 py-2 px-3 text-grey-darker dark:text-black "
                    />
                    <x-form.submitbutton>Send</x-form.submitbutton>
                </form>
            </div>

        </div>
    </x-slot>
</x-layout>
