@props(['captcha'])
<div class="mt-3 grid grid-cols-11 gap-2">
    <div class="text-center md:col-span-4 col-span-11 mx-auto">
        <img src="{{$captcha}}" alt="">
    </div>
    <div class="col-span-11 md:col-span-7 mt-1">
    <x-form.input name="captcha" required="true" placeholder="Enter Captcha" labelhidden="true" noDiv="true"/>
    </div>
</div>


