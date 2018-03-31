@section('styles')
    <style>
        .gal {
            -webkit-column-count: 3; /* Chrome, Safari, Opera */
            -moz-column-count: 3; /* Firefox */
            column-count: 3;
        }
        .gal img{
            width: 100%;
            padding: 7px 0;
        }
        @media (max-width: 400px) {
            .gal {
                -webkit-column-count: 1; /* Chrome, Safari, Opera */
                -moz-column-count: 1; /* Firefox */
                column-count: 1;
            }
        }
    </style>
@endsection

@if($pictures)
    <div class="gal">
        @foreach($pictures as $picture)
            <a href="{{$picture->path}}" target="_blank"><img src="{{$picture->path}}"></a>
        @endforeach
    </div>
@endif