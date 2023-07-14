<x-layout>
    <x-slot name="content">

        <div class="font-sans antialiased bg-grey-lightest">
            <div class="w-full bg-grey-lightest" style="padding-top: 4rem;">
                <div class="container mx-auto py-8 ">
                    <div class="w-5/6 lg:w-1/2 mx-auto bg-white dark:bg-sky-700 rounded shadow-xl">
                        <div class="py-4 px-8 text-black text-xl border-b border-grey-lighter">Register for a create
                            account
                        </div>
                        <form action="{{route('auth.signup.post')}}" method="POST">
                            @csrf
                            <div class="py-4 px-8 dark:text-black">
                                <x-form.input name="username" required="true"/>
                                <x-form.input name="password" type="password" required="true"/>
                                <x-form.input name="password_confirmation" type="password" required="true" label="Confirm Password"/>
                                <x-form.input name="pin" required="true"/>
                                <x-form.input name="refid" label="Reference ID (optional)" value="{{old('refid', $refid)}}"/>
                                <x-form.captcha :captcha="$captcha"/>
                                <div class="flex items-center justify-end mt-8">
                                    <x-form.submitbutton>Sign Up</x-form.submitbutton>
                                </div>
                            </div>
                        </form>
                    </div>
                    <p class="text-center my-4">
                        <a href="{{route('auth.signin')}}" class="text-grey-dark text-sm no-underline hover:text-grey-darker">I already have an
                            account</a>
                    </p>
                </div>
            </div>
        </div>

    </x-slot>
</x-layout>
