@props(['name' , 'labelhidden' => false , 'labelclass'])
@if($labelhidden)
    <label for="{{$name}}" class="hidden">
        {{ucfirst($name)}}
    </label>
@else
    <label for="{{$name}}" class="{{$labelclass}}">
        {{ucfirst($name)}}
    </label>
@endif

