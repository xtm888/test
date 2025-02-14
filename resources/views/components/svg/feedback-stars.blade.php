@for($i = 1; $i<= $stars; $i++)
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
         width="24px" class="text-blue-600" fill="currentColor">
        <g>
            <path d="M0,0h24v24H0V0z" fill="none"/>
            <path d="M0,0h24v24H0V0z" fill="none"/>
        </g>
        <g>
            <path
                d="M12,17.27L18.18,21l-1.64-7.03L22,9.24l-7.19-0.61L12,2L9.19,8.63L2,9.24l5.46,4.73L5.82,21L12,17.27z"/>
        </g>
    </svg>
@endfor
{{-- half star --}}
@if(($stars - round($stars, 0)) != 0)
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" class="text-blue-600" fill="currentColor">
        <path d="M0 0h24v24H0z" fill="none"/>
        <path
            d="M22 9.24l-7.19-.62L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27 18.18 21l-1.63-7.03L22 9.24zM12 15.4V6.1l1.71 4.04 4.38.38-3.32 2.88 1 4.28L12 15.4z"/>
    </svg>
@endif
@for($i = 1; $i<= 5 -$stars; $i++)
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" class="text-blue-600" fill="currentColor">
        <path d="M0 0h24v24H0V0z" fill="none"/>
        <path
            d="M22 9.24l-7.19-.62L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27 18.18 21l-1.63-7.03L22 9.24zM12 15.4l-3.76 2.27 1-4.28-3.32-2.88 4.38-.38L12 6.1l1.71 4.04 4.38.38-3.32 2.88 1 4.28L12 15.4z"/>
    </svg>
@endfor
