<div
    class="w-full  flex flex-col justify-start items-stretch  bg-opacity-80 rounded-md lg:rounded-none lg:rounded-l-md p-3 md:col-span-1 col-span-2 overflow-y-auto min-h-[240px] max-h-[550px] ">
    <div class="flex-auto flex flex-col">
        <div class="flex-auto flex flex-row">
            <div class="w-full p-1 ">
                <ul class="overflow-y-auto">
                    @foreach(auth()->user()->conversations->sortByDesc('updated_at')  as $conversation)
                        <li>
                            <a class="my-2 p-2 flex flex-row cursor-pointer rounded-lg hover:bg-gray-50 hover:bg-opacity-50"
                               href="{{ route('profile.messages', $conversation->id) }}">


                                <img class="w-12 h-12 mr-4 rounded-full"
                                     src="
                                 @if($conversation->IsSystem())
                                         /img/default_system_avatar.jpg
@else
                                     @if($conversation->lastmessage->user->isVendor() && isset($conversation->lastmessage->user->vendor->avatar))

                                         /storage/{{$conversation->lastmessage->user->vendor->avatar}}
                                     @else
                                         /img/default_avatar.jpg
@endif
                                     @endif
                                         " alt=""/>


                                <div class="w-full flex flex-col justify-center">
                                    <div class="flex flex-row justify-between">
                                        <h2 class="text-md font-bold">{{ Str::of($conversation->subject)->limit(40) }}</h2>
                                        <div class="text-md flex flex-row">
{{--                                            <svg class="w-4 h-4 text-blue-600 fill-current mr-1"--}}
{{--                                                 viewBox="0 0 19 14">--}}
{{--                                                <path fill-rule="nonzero"--}}
{{--                                                      d="M4.96833846,10.0490996 L11.5108251,2.571972 C11.7472185,2.30180819 12.1578642,2.27443181 12.428028,2.51082515 C12.6711754,2.72357915 12.717665,3.07747757 12.5522007,3.34307913 L12.4891749,3.428028 L5.48917485,11.428028 C5.2663359,11.6827011 4.89144111,11.7199091 4.62486888,11.5309823 L4.54038059,11.4596194 L1.54038059,8.45961941 C1.2865398,8.20577862 1.2865398,7.79422138 1.54038059,7.54038059 C1.7688373,7.31192388 2.12504434,7.28907821 2.37905111,7.47184358 L2.45961941,7.54038059 L4.96833846,10.0490996 L11.5108251,2.571972 L4.96833846,10.0490996 Z M9.96833846,10.0490996 L16.5108251,2.571972 C16.7472185,2.30180819 17.1578642,2.27443181 17.428028,2.51082515 C17.6711754,2.72357915 17.717665,3.07747757 17.5522007,3.34307913 L17.4891749,3.428028 L10.4891749,11.428028 C10.2663359,11.6827011 9.89144111,11.7199091 9.62486888,11.5309823 L9.54038059,11.4596194 L8.54038059,10.4596194 C8.2865398,10.2057786 8.2865398,9.79422138 8.54038059,9.54038059 C8.7688373,9.31192388 9.12504434,9.28907821 9.37905111,9.47184358 L9.45961941,9.54038059 L9.96833846,10.0490996 L16.5108251,2.571972 L9.96833846,10.0490996 Z"></path>--}}
{{--                                            </svg>--}}
                                            <span class="text-gray-400">
                            {{$conversation->lastmessage->created_at->diffForHumans()}}
                          </span>
                                        </div>
                                    </div>
                                    <div class="flex flex-row justify-between items-center">
                                        <p class="text-md text-gray-500">{{ Str::of($conversation->lastMessage?->body)->limit(80) }}</p>
                                        @if($conversation->pivot->unRead == 1)
                                            <div class="bg-blue-800 rounded-full">
                                    <span
                                        class="text-sm font-bold max-w-fit h-5 text-center text-white mx-2 inline-block">NEW</span>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            </a>
                        </li>
                        @if($loop->count < 2)
                            <p class="bg-black  mx-auto p-3 w-fit mt-8">NO MORE MESSAGE ...</p>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
