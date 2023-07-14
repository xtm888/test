@props(['conversation'])
<div
    class="w-full lg:flex flex-col h-full justify-start items-stretch border-r-2 border-l-2 border-gray-100 lg:rounded-r-md xl:rounded-none col-span-2">
    <!-- Header with name -->
    <div
        class="flex flex-row items-center justify-between px-3 py-2 bg-gray-50 bg-opacity-40 border-b-2 border-gray-400">
        <p class="inline-block px-2">Subject: {{ $conversation->subject }}</p>
        <p class="inline-block">
            @if($conversation->isSystem)
                system message
            @else
                @foreach($conversation->users as $user)
                    {{$user->username}}
                    @if(!$loop->last)
                        ,
                    @endif
                @endforeach
            @endif
        </p>

    </div>
    <!-- Messages -->

    <div class="flex-auto flex flex-col-reverse  max-h-[550px] justify-between overflow-y-auto  ">

        @foreach($conversation->messages->sortBy('created_at') as $message)
            <div class="w-full flex flex-col ">


                <div class="flex  justify-end ">

                    @if($conversation->isSystem())
                        <div class="w-1/12 py-2 flex justify-center">
                            <img
                                src="/img/default_system_avatar.jpg"
                                class="h-12 w-12 rounded-full " alt="">
                        </div>
                        {{--                        extras--}}
                        <div class="p-1 w-full lg:mr-80 mx-6 mt-1">
                            <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-xl mb-2 relative">
                                <h2 class="text-sm font-semibold mb-2">Liony ({{Cache::tags(['MarketPlace'])->get('MPCACHE')->name}} Bot)</h2>
                                <p class="text-sm">{{$message->body}}</p>
                                <span
                                    class="text-xs text-gray-500 absolute right-2 bottom-2">{{$message->created_at->diffForHumans()}}</span>
                            </div>
                        </div>
                        {{--                        extras end--}}
                    @endif




                    @if( (!$conversation->isSystem()) && ($message->user->username == auth()->user()->username) )
                        <div class="p-1 w-9/12 flex justify-end">
                            <div
                                class="px-4 py-3 rounded-xl my-2 bg-blue-500 text-white flex flex-col xl:flex-row items-center">
                                <p class="text-sm flex">
                                    {{$message->body}}
                                </p>
                                <div class="ml-2 flex flex-row flex-shrink-0 text-xs text-gray-300 ">
                                                  <span class="mr-1">
                                                    {{$message->created_at->diffForHumans()}}
                                                  </span>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 19 14">
                                        <path fill-rule="nonzero"
                                              d="M4.96833846,10.0490996 L11.5108251,2.571972 C11.7472185,2.30180819 12.1578642,2.27443181 12.428028,2.51082515 C12.6711754,2.72357915 12.717665,3.07747757 12.5522007,3.34307913 L12.4891749,3.428028 L5.48917485,11.428028 C5.2663359,11.6827011 4.89144111,11.7199091 4.62486888,11.5309823 L4.54038059,11.4596194 L1.54038059,8.45961941 C1.2865398,8.20577862 1.2865398,7.79422138 1.54038059,7.54038059 C1.7688373,7.31192388 2.12504434,7.28907821 2.37905111,7.47184358 L2.45961941,7.54038059 L4.96833846,10.0490996 L11.5108251,2.571972 L4.96833846,10.0490996 Z M9.96833846,10.0490996 L16.5108251,2.571972 C16.7472185,2.30180819 17.1578642,2.27443181 17.428028,2.51082515 C17.6711754,2.72357915 17.717665,3.07747757 17.5522007,3.34307913 L17.4891749,3.428028 L10.4891749,11.428028 C10.2663359,11.6827011 9.89144111,11.7199091 9.62486888,11.5309823 L9.54038059,11.4596194 L8.54038059,10.4596194 C8.2865398,10.2057786 8.2865398,9.79422138 8.54038059,9.54038059 C8.7688373,9.31192388 9.12504434,9.28907821 9.37905111,9.47184358 L9.45961941,9.54038059 L9.96833846,10.0490996 L16.5108251,2.571972 L9.96833846,10.0490996 Z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        @if($message->user->isVendor() && (!$conversation->isSystem()))
                            <div class="w-2/12 md:w-1/12 py-2 flex-shrink-0 ml-3">
                                <img
                                    src="@if(isset($message->user->vendor->avatar)) /storage/{{$message->user->vendor->avatar}} @else /img/default_avatar.jpg @endif "
                                    class="h-12 w-12 rounded-full  " alt="">
                            </div>
                        @endif
                </div>

                @else

                    @if(!$conversation->isSystem() && $message->user->isVendor() )
                        <div class="w-3/12 sm:w-2/12 md:w-3/12 lg:w-4/12 xl:w-2/12 2xl:w-1/12 py-2 flex justify-end ">
                            <img
                                src="@if(isset($message->user->vendor->avatar)) /storage/{{$message->user->vendor->avatar}} @else /img/default_avatar.jpg @endif "
                                class="h-12 w-12 rounded-full " alt="">
                        </div>
                    @endif

                    @if(!$conversation->isSystem())
                        <div class="p-1 w-full lg:mr-80 mx-6 mt-1">
                            <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-xl mb-2 relative">
                                <h2 class="text-sm font-semibold mb-2">{{$message->user->username}}</h2>
                                <p class="text-sm">{{$message->body}}</p>
                                <span
                                    class="text-xs text-gray-500 absolute right-2 bottom-2">{{$message->created_at->diffForHumans()}}</span>
                            </div>
                        </div>
                    @endif
            </div>

            @endif



        @endforeach

    <!-- Input for writing a messages -->
        @if(!$conversation->isSystem)
            <div class="">
                <form action="{{ route('profile.messages.message.new', $conversation) }}" method="POST">
                    @csrf
                    <div class="flex flex-row justify-between items-center p-3">
                        <div class="">
                            <button type="button"
                                    class="p-2 text-gray-400 rounded-full hover:text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring"
                                    aria-label="Upload a files">
                                <svg class="fill-current h-6 w-6" viewBox="0 0 20 20">
                                    <path
                                        d="M4.317,16.411c-1.423-1.423-1.423-3.737,0-5.16l8.075-7.984c0.994-0.996,2.613-0.996,3.611,0.001C17,4.264,17,5.884,16.004,6.88l-8.075,7.984c-0.568,0.568-1.493,0.569-2.063-0.001c-0.569-0.569-0.569-1.495,0-2.064L9.93,8.828c0.145-0.141,0.376-0.139,0.517,0.005c0.141,0.144,0.139,0.375-0.006,0.516l-4.062,3.968c-0.282,0.282-0.282,0.745,0.003,1.03c0.285,0.284,0.747,0.284,1.032,0l8.074-7.985c0.711-0.71,0.711-1.868-0.002-2.579c-0.711-0.712-1.867-0.712-2.58,0l-8.074,7.984c-1.137,1.137-1.137,2.988,0.001,4.127c1.14,1.14,2.989,1.14,4.129,0l6.989-6.896c0.143-0.142,0.375-0.14,0.516,0.003c0.143,0.143,0.141,0.374-0.002,0.516l-6.988,6.895C8.054,17.836,5.743,17.836,4.317,16.411"></path>
                                </svg>
                            </button>
                        </div>

                        <div class="flex-1 px-3">
                            <input type="text" name="message" id="message"
                                   class="w-full border-2 border-gray-100 rounded-full px-4 py-1 outline-none text-gray-500 focus:outline-none focus:ring"
                                   placeholder="Write your message">
                        </div>

                        <div class="flex flex-row">
                            <button type="submit"
                                    class="p-2 ml-2 text-blue-400 rounded-xl hover:text-blue-600 hover:bg-blue-100 font-bold focus:outline-none focus:ring"
                                    aria-label="Send">
                                <svg class="h-8 w-8 text-blue-400" viewBox="0 0 24 24"
                                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z"/>
                                    <line x1="10" y1="14" x2="21" y2="3"/>
                                    <path d="M21 3L14.5 21a.55 .55 0 0 1 -1 0L10 14L3 10.5a.55 .55 0 0 1 0 -1L21 3"/>
                                </svg>
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        @endif

    </div>

</div>

