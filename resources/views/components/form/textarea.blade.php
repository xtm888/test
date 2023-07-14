@props(['name',
'label' => $name ,
'required' => false,
'rows' => 4 ,
'placeholder' => false ,
'labelhidden' => false,
'noDiv' => false ,
'class' => 'border border-gray-200 p-2 w-full rounded dark:text-gray-200' ,
'labelclass' => 'block text-grey-darker text-sm font-bold mb-2'
])
@if($noDiv)
    @if($labelhidden)
        <x-form.label name="{{$label}}" labelhidden="true"/>
    @else
        <x-form.label name="{{$label}}" labelclass="{{$labelclass}}"/>
    @endif

    <textarea class="{{$class}}"
              name="{{$name}}"
              id="{{$name}}"
              @if($required == true)
              required
              @endif
              rows="{{$rows}}"
              @if($placeholder)
              placeholder="{{$placeholder}}"
              @endif
    >{{ $slot ?? old($name) }}</textarea>
    <x-form.error name="{{$name}}"/>
@else
    <x-form.div>
        @if($labelhidden)
            <x-form.label name="{{$label}}" labelhidden="true"/>
        @else
            <x-form.label name="{{$label}}" labelclass="{{$labelclass}}"/>
        @endif

        <textarea class="{{$class}}"
                  name="{{$name}}"
                  id="{{$name}}"
                  @if($required == true)
                  required
                  @endif
                  rows="{{$rows}}"
                  @if($placeholder)
                  placeholder="{{$placeholder}}"
              @endif
    >{{ $slot ?? old($name) }}</textarea>
        <x-form.error name="{{$name}}"/>
    </x-form.div>
@endif
