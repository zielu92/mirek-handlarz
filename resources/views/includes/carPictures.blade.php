

@if($pictures)
    <div class="gall">
        @foreach($pictures as $picture)
            <a href="{{$picture->path}}" target="_blank"><img src="{{$picture->path}}"></a>
        @endforeach
    </div>
@endif