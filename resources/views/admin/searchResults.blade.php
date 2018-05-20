@extends('admin.layout.admin')


@section('content')
    <div class="col-md-12">
        <h1>{{Lang::get('search.results')}}</h1>
    </div>
    <div class="col-md-12">
        @if (count($articles) === 0)
            <h3>{{Lang::get('search.noResults')}}</h3>
        @elseif (count($articles) >= 1)
            @foreach($articles as $article)
                <div class="pull-left results">
                    <a href="{{$article['link']}}" class="btn btn-dark">{{$article['value']}}</a>
                </div>
            @endforeach
        @endif
    </div>

@endsection