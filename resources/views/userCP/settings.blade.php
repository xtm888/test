<x-layout>
    <x-slot name="title">
        Settings
    </x-slot>
    <x-slot name="content">
        <x-userCP.tabmenu/>

        <section class="text-gray-600 body-font">
            <div class="container px-5 py-24 mx-auto">

                <div class="mx-auto w-3/12 h-72 -mt-24">
                    <x-svg.usercp-repairman/>
                </div>

                <div class="flex flex-wrap -m-4">
                    <div class="xl:w-1/2 md:w-1/1 p-4 w-full space-y-4">
                        <div class="border border-gray-200 p-7 rounded-lg">
                            <div
                                class="w-10 h-10 inline-flex items-center  justify-center rounded-full bg-blue-100 text-blue-500 mb-4">
                                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                                </svg>

                            </div>
                            <div class="inline-block align-text-bottom pl-6">
                                <p class="text-lg text-gray-900 font-medium title-font dark:text-indigo-500">PGP Key</p>
                            </div>

                            @if(auth()->user()->hasPGP())
                                <div class="border-b-2">
                                <textarea class="w-full" style="resize: none" rows="10"
                                          disabled>{{{auth()->user()->pgp_key}}}</textarea>
                                </div>
                                <p class="mt-4 text-center text-lg border border-gray-400 p-0.5 dark:text-gray-400">
                                    Change Your PGP Key</p>
                            @else
                                <div
                                    class="text-red-700 font-semibold text-lg text-center my-3 flex-center flex-shrink-0">
                                    <svg viewBox="0 0 24 24" width="24" height="24" class="h-8 w-8 inline-block"
                                         xmlns="http://www.w3.org/2000/svg"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"/>
                                        <line x1="8" y1="15" x2="16" y2="15"/>
                                        <line x1="9" y1="9" x2="9.01" y2="9"/>
                                        <line x1="15" y1="9" x2="15.01" y2="9"/>
                                    </svg>
                                    <p>You did not set up your PGP Key.</p>
                                </div>
                                <p class="mt-4 text-center text-lg border border-gray-400 p-0.5">Add Your PGP Key</p>
                            @endif
                            <div class="mt-4">
                                <form action="{{route('profile.pgp.post')}}" method="POST">
                                    @csrf
                                    <div class="">
                                        <x-form.textarea name="newpgp" labelhidden required="true" rows="7"
                                                         placeholder="Copy and paste your PGP key to box. Then you will be redirect for confirmation."/>
                                        <p></p>
                                    </div>
                                    <div class="text-right">
                                        <x-form.submitbutton>Submit PGP</x-form.submitbutton>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="border border-gray-200 p-6 rounded-lg">
                            <div
                                class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-blue-100 text-blue-500 mb-4">
                                <svg class="h-8 w-8" width="24" height="24" viewBox="0 0 24 24"
                                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z"/>
                                    <path
                                        d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3"/>
                                </svg>
                            </div>
                            <div class="inline-block align-text-bottom pl-6">
                                <p class="text-lg text-gray-900 font-medium title-font dark:text-indigo-500">
                                    Two-factor authentication
                                    (2FA)</p>
                            </div>

                            <div class="flex justify-between">
                                @if(auth()->user()->login_2fa)
                                    <p>2FA Activated on your account.</p>
                                    <a href="{{ route('profile.2fa.change', 0) }}"
                                       class="bg-red-500 text-white rounded-md p-1">Disable
                                    </a>
                                @else
                                    <p>2FA Disabled on your account.</p>
                                    <a href="{{ route('profile.2fa.change', true) }}"
                                       class="bg-green-500 text-white rounded-md p-1">Enable
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="border border-gray-200 p-6 rounded-lg">
                            <div
                                class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-blue-100 text-blue-500 mb-4">
                                <svg class="h-8 w-8" width="24" height="24" viewBox="0 0 24 24"
                                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z"/>
                                    <path
                                        d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3"/>
                                </svg>
                            </div>
                            <div class="inline-block align-text-bottom pl-6">
                                <p class="text-lg text-gray-900 font-medium title-font dark:text-indigo-500">
                                    Set your preferred currency</p>
                            </div>

                            <div>
                                <form action="{{route('profile.currency.change')}}" method="POST"
                                      class="flex justify-between">
                                    @csrf
                                    <select
                                        class="select select-bordered dark:border-white min-w-[200px] dark:text-gray-400"
                                        aria-label="currency" name="currency" id="currency">
                                        <option value="usd" {{(auth()->user()->currency == 'usd') ? 'selected' : ''}}>USD</option>
                                        <option value="euro" {{(auth()->user()->currency == 'euro') ? 'selected' : ''}}>EURO</option>
                                        <option value="gbp" {{(auth()->user()->currency == 'gbp') ? 'selected' : ''}}>GBP</option>
                                        <option value="try" {{(auth()->user()->currency == 'try') ? 'selected' : ''}}>TRY</option>
                                    </select>
                                    <div class="py-2 mt-2">
                                        <button class="bg-green-500 text-white rounded-md p-1 float-right"
                                                type="submit">Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                    <div class="xl:w-1/2 md:w-1/1 p-4 w-full space-y-4">

                        <div class="border border-gray-200 p-6 rounded-lg">
                            <div
                                class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-blue-100 text-blue-500 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" height="36px"
                                     viewBox="0 0 20 20" width="36px" fill="currentColor">
                                    <rect fill="none" height="20" width="20" x="0"/>
                                    <path
                                        d="M17,10c0,3.87-3.13,7-7,7c-2.22,0-4.2-1.04-5.48-2.65l1.07-1.07c1,1.35,2.6,2.22,4.41,2.22c3.03,0,5.5-2.47,5.5-5.5 S13.03,4.5,10,4.5c-3.04,0-5.56,2.49-5.49,5.62l1.18-1.18L6.75,10l-3,3l-3-3l1.06-1.06l1.2,1.2C2.93,6.11,6.18,3,10,3 C13.87,3,17,6.13,17,10z M12.25,10v2.25c0,0.41-0.34,0.75-0.75,0.75h-3c-0.41,0-0.75-0.34-0.75-0.75V10c0-0.41,0.34-0.75,0.75-0.75 V8.5C8.5,7.67,9.17,7,10,7s1.5,0.67,1.5,1.5v0.75C11.91,9.25,12.25,9.59,12.25,10z M10.75,8.5c0-0.41-0.34-0.75-0.75-0.75 S9.25,8.09,9.25,8.5v0.75h1.5V8.5z"/>
                                </svg>
                            </div>
                            <div class="inline-block align-text-bottom pl-6">
                                <p class="text-lg text-gray-900 font-medium title-font dark:text-indigo-500">Change
                                    Password</p>
                            </div>

                            <form method="POST" action="{{route('profile.password.change')}}">
                                @csrf
                                <x-form.input name="old_password" type="password" label="Current Password"
                                              placeholder="Your current password" required="true"/>
                                <x-form.input name="new_password" type="password" label="New Password"
                                              placeholder="Enter new password" required="true"/>
                                <x-form.input name="new_password_confirmation" type="password"
                                              label="New Password Again"
                                              placeholder="Confirm new password" required="true"/>
                                <div class="mb-4">
                                    <div class="py-2 mt-2">
                                        <button class="bg-green-500 text-white rounded-md p-1 float-right"
                                                type="submit">Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="border border-gray-200 p-6 rounded-lg">
                            <div
                                class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-blue-100 text-blue-500 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"
                                     fill="currentColor">
                                    <path
                                        d="M280 816q-100 0-170-70T40 576q0-100 70-170t170-70q66 0 121 33t87 87h432v240h-80v120H600V696H488q-32 54-87 87t-121 33Zm0-80q66 0 106-40.5t48-79.5h246v120h80V616h80v-80H434q-8-39-48-79.5T280 416q-66 0-113 47t-47 113q0 66 47 113t113 47Zm0-80q33 0 56.5-23.5T360 576q0-33-23.5-56.5T280 496q-33 0-56.5 23.5T200 576q0 33 23.5 56.5T280 656Zm0-80Z"/>
                                </svg>
                            </div>
                            <div class="inline-block align-text-bottom pl-6">
                                <p class="text-lg text-gray-900 font-medium title-font dark:text-indigo-500">Change
                                    PIN Code</p>
                            </div>

                            <form method="POST" action="{{route('profile.pin.change')}}">
                                @csrf
                                <x-form.input name="old_pin" label="Current PIN"
                                              placeholder="Your current pin" required="true"/>
                                <x-form.input name="new_pin" label="New PIN"
                                              placeholder="Enter new pin" required="true"/>
                                <x-form.input name="new_pin_confirmation"
                                              label="New PIN Again"
                                              placeholder="Confirm new pin code" required="true"/>
                                <div class="mb-4">
                                    <div class="py-2 mt-2">
                                        <button class="bg-green-500 text-white rounded-md p-1 float-right"
                                                type="submit">Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>


                        <div class="border border-gray-200 p-6 rounded-lg">
                            <div
                                class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-blue-100 text-red-800 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 0 24 24" width="36px"
                                     fill="currentColor">
                                    <path d="M0 0h24v24H0V0z" fill="none"/>
                                    <path
                                        d="M15 16h4v2h-4zm0-8h7v2h-7zm0 4h6v2h-6zM3 18c0 1.1.9 2 2 2h6c1.1 0 2-.9 2-2V8H3v10zm2-8h6v8H5v-8zm5-6H6L5 5H2v2h12V5h-3z"/>
                                </svg>
                            </div>
                            <div class="inline-block align-text-bottom pl-6">
                                <p class="text-lg text-gray-900 font-medium title-font dark:text-indigo-500">Delete
                                    Account</p>
                            </div>
                            <p class="">Clear all my data and account in the database.
                                <button class="bg-red-500 text-white rounded-md p-1 float-right">Delete</button>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </section>

    </x-slot>
</x-layout>
