<x-layout>
    <x-slot name="content">

        <div class="font-sans antialiased ">
            <div class="w-full pt-8">
                <div class="container mx-auto py-8">
                    <div class="w-5/6 lg:w-1/2 mx-auto bg-white dark:bg-sky-700 rounded shadow-xl">
                        <div class="py-4 px-8 text-black text-xl border-b ">Sign In
                        </div>
                        <form action="{{route('auth.signin.post')}}" method="POST">
                            @csrf
                            <div class="py-4 px-8 dark:text-black">
                                <x-form.input name="username" required="true"/>
                                <x-form.input name="password" type="password" required="true"/>
                                <x-form.captcha :captcha="$captcha"/>
                                <div class="flex items-center justify-end mt-8">
                                    <x-form.submitbutton>Sign In</x-form.submitbutton>
                                </div>
                            </div>
                        </form>
                    </div>
                    <p class="text-center my-4">
                        <a href="{{route('auth.forgotpassword')}}" class="text-grey-dark text-sm no-underline hover:text-grey-darker">I forget my
                            Password</a>
                    </p>
                </div>
            </div>
        </div>

    </x-slot>
</x-layout>
