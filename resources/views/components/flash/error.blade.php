@if(session()->has('errormessage'))
    <style>
        #flash_container {
            overflow: hidden;
            position: relative;
        }

        #flash {
            -webkit-animation: cssAnimation 5s forwards;
            animation: cssAnimation 5s forwards;
        }

        @keyframes cssAnimation {
            0% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }

        @-webkit-keyframes cssAnimation {
            0% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }
    </style>
    <div id="flash_container">
        <div
            class="flex p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800 fixed right-3 bottom-3"
            role="alert" id="flash">
            <svg class="inline flex-shrink-0 mr-3 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                      clip-rule="evenodd"></path>
            </svg>
            <div>
                <span class="font-medium">Error!</span> {{ session()->get('errormessage') }}
            </div>
        </div>
    </div>
@endif
