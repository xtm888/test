<x-layout>
    <x-slot name="content">
        <x-vendorCP.tabmenu/>

        <section class="text-gray-600 body-font">
            <div class="container px-5 py-24 mx-auto">
                <div class="flex flex-wrap -m-4">

                    <div class="xl:w-1/2 md:w-1/1 p-4 w-full flex flex-col gap-6">

                        <div class="border border-gray-200 p-6 rounded-lg">
                            <div
                                class="w-10 h-10 inline-flex items-center  justify-center rounded-full bg-blue-100 text-blue-500 mb-4">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                     stroke-width="2" class="w-8 h-8" viewBox="0 0 24 24">
                                    <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z" />  <circle cx="12" cy="13" r="4" />
                                </svg>
                            </div>
                            <div class="inline-block align-text-bottom pl-6">
                                <p class="text-lg text-gray-900 dark:text-indigo-500 font-medium title-font">Market Avatar
                                    <span class="inline-flex text-gray-600 text-sm"></span>
                                </p>
                            </div>

                            <form action="{{route('vendor.avatar.post')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mt-2 w-4/6 inline-block">
                                    <x-form.input name="avatar" type="file" labelhidden="true"/>
                                </div>
                                <div class="inline-block ml-4 lg:ml-12">
                                    <x-form.submitbutton>Submit</x-form.submitbutton>
                                </div>
                            </form>
                        </div>

                        <div class="border border-gray-200 p-6 rounded-lg">
                            <div
                                class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-blue-100 text-blue-500 mb-4">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                     stroke-width="2" class="w-8 h-8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="inline-block align-text-bottom pl-6">
                                <p class="text-lg text-gray-900 dark:text-indigo-500 font-medium title-font">
                                    Market Background
                                </p>
                            </div>
                            <form action="{{route('vendor.background.post')}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="mt-2 w-4/6 inline-block">
                                    <x-form.input name="profilebg" type="file" labelhidden="true"/>
                                </div>
                                <div class="inline-block ml-4 lg:ml-12">
                                    <x-form.submitbutton>Submit</x-form.submitbutton>
                                </div>
                            </form>
                        </div>

                    </div>

                    <div class="xl:w-1/2 md:w-1/1 p-4 w-full">

                        <div class="border border-gray-200 p-6 rounded-lg min-h-[371px]">
                            <div
                                class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-blue-100 text-blue-500 mb-4">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                     stroke-width="2" class="w-8 h-8" viewBox="0 0 24 24">
                                    <polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6" />  <line x1="8" y1="2" x2="8" y2="18" />  <line x1="16" y1="6" x2="16" y2="22" />
                                </svg>
                            </div>
                            <div class="inline-block align-text-bottom pl-6">
                                <p class="text-lg text-gray-900 dark:text-indigo-500 font-medium title-font">Market Info</p>
                            </div>

                            <form action="{{route('profile.vendor.update.post')}}" method="POST">
                                @csrf
                                <x-form.textarea
                                    name="about" rows="5">{{old('about',auth()->user()->vendor->about)}}</x-form.textarea>
                                <div class="py-2 mt-2 text-right">
                                    <x-form.submitbutton>Submit</x-form.submitbutton>
                                </div>
                            </form>
                        </div>

                    </div>




                    <div class="xl:w-1/2 md:w-1/1 p-4 w-full">
                        <div class="border border-gray-200 p-6 rounded-lg">
                            <div
                                class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-blue-100 text-blue-500 mb-4">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                     stroke-width="2" class="w-8 h-8" viewBox="0 0 24 24">
                                    <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M15 12h5a2 2 0 0 1 0 4h-15l-3 -6h3l2 2h3l-2 -7h3z" transform="rotate(-15 12 12) translate(0 -1)" />  <line x1="3" y1="21" x2="21" y2="21" />
                                </svg>
                            </div>
                            <div class="inline-block align-text-bottom pl-6">
                                <p class="text-lg text-gray-900 dark:text-indigo-500 font-medium title-font">Vacation Mode</p>
                            </div>
                            <p class="text-gray-300">Switch to vacation mode.</p>
                            <form action="{{route('vendor.editvacation.post')}}" method="POST"
                                  class="flex flex-shrink-0 justify-between mt-4">
                                @csrf
                                @method('PATCH')
                                @if(!auth()->user()->vendor->onVacation)
                                    <p class="mt-2 text-gray-300">Your account is set to active mode.</p>
                                    <button type="submit" class="bg-red-500 text-white rounded-md p-1">Start Vacation
                                    </button>
                                @else
                                    <p class="mt-2 text-gray-300">Your account is set to vacation mode.</p>
                                    <button type="submit" class="bg-green-500 text-white rounded-md p-1">Come Back
                                    </button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </section>

    </x-slot>
</x-layout>
