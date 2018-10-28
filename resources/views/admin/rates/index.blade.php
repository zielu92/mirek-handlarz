@extends('admin.layout.admin')

@section('content')
    <div class="col-lg-12">
        <h1> {{ Lang::get('admin/options.ratesOnlineManual')}}</h1>
        @if($rates)
        {!! Form::open(['method'=>'POST', 'action'=>'AdminRatesController@store', 'class'=>'form-row']) !!}

        @foreach($rates as $rate)
        <div class="form-group col-md-1">
            {!! Form::label('CurrencyRates', $rate['pair']) !!}
            {!! Form::text('rate['.$rate['pair'].']', null, ['class'=>'form-control rate', 'id'=>$rate['pair']]) !!}
        </div>
        <div class="form-group col-md-2"> {{ Lang::get('admin/options.lastRate')}}
            @if($rate['lastRate'])
               <br> <a href="#{{$rate['lastRate']}}" class="btn btn-info lastRate form-control" id="Value_{{$rate['pair']}}">{{$rate['lastRate']}}</a>
            @endif
        </div>
        @endforeach
        <div class="col-md-12">
            <p>{{ Lang::get('admin/options.tryToGetRatesInfo')}}</p>
        </div>
        <div class="form-group col-md-12">
            <a href="#" class="btn btn-info" id="downloadRates">{!!Lang::get('admin/options.tryToGetRates')!!}</a>
            {!! Form::submit(Lang::get('admin/options.save'), ['class'=>'btn btn-primary pull-right']) !!}
        </div>
        @else
            <div class="col-md-12">
                <a href="{{route('admin.options.index')}}">{{ Lang::get('admin/options.noRatesInfo')}}</a>
            </div>
        @endif
    </div>

    @include('includes.formError')

@endsection


@section('scripts')
<script>
    $('.lastRate').on('click', function() {
        var pairValue = $(this).attr('href').replace('#', '');
        var pairName = $(this).attr('id').replace('Value_', '');
        $("input[id$='"+pairName+"']").val(pairValue);
    });
    var downloadError = 0;
    $('#downloadRates').on('click', function() {
        $(".rate").each(function() {
            var rate = $(this).attr("id");
            var fixForUrl = rate.replace("/", "_");


            $.ajax({

                url: '/admin/rates/getRate/' + fixForUrl,
                data: {
                    _method: 'GET',
                },
                type: "POST",
                success: function (data) {

                    if (!data.error) {
                         $("input[id$='"+rate+"']").val(data);
                         if(data == null) {
                             downloadError+=1;
                         }
                    }
                }

            });

         });
    });

</script>
@endsection