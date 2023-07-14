@props([
'name' ,
'type' => 'text' ,
'required' => false ,
'label' => $name ,
'multipleFiles' => false ,
'placeholder' => false ,
'labelhidden' => false ,
'noDiv' => false ,
'class' => 'appearance-none border rounded w-full py-2 px-3 dark:text-gray-200' ,
'labelclass' => 'block text-grey-darker text-sm font-bold mb-2'
])
@if($noDiv)
    @if($labelhidden)
        <x-form.label name="{{$label}}" labelhidden="true"/>
    @else
        <x-form.label name="{{$label}}" labelclass="{{$labelclass}}"/>
    @endif
    <input class="{{$class}}"
           type="{{$type}}"
           name="{{$name}}"
           id="{{$name}}"
           @if($required)
           required
           @endif
           @if($multipleFiles)
           multiple
           @endif
           @if($placeholder)
           placeholder="{{$placeholder}}"
        @endif
        {{ $attributes(['value' => old($name)]) }}
    >
    <x-form.error name="{{$name}}"/>
@else
    <x-form.div>
        @if($labelhidden)
            <x-form.label name="{{$label}}" labelhidden="true"/>
        @else
            <x-form.label name="{{$label}}" labelclass="{{$labelclass}}"/>
        @endif
        <input class="{{$class}}"
               type="{{$type}}"
               name="{{$name}}"
               id="{{$name}}"
               @if($required)
               required
               @endif
               @if($multipleFiles)
               multiple
               @endif
               @if($placeholder)
               placeholder="{{$placeholder}}"
            @endif
            {{ $attributes(['value' => old($name)]) }}
        >
        <x-form.error name="{{$name}}"/>
    </x-form.div>
@endif
