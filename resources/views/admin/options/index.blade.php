@extends('admin.layout.admin')


@section('content')
    <div class="col-lg-12">
        <h1>{{Lang::get('admin/options.options')}}</h1>
        @if($lastSettings)
            {!! Form::model($lastSettings,['method'=>'PATCH', 'action'=>['AdminOptionsController@update',
            $lastSettings->id], 'class'=>'form-row']) !!}
        @else
            {!! Form::open(['method'=>'POST', 'action'=>'AdminOptionsController@store', 'class'=>'form-row']) !!}
        @endif
        <div class="form-group col-md-4">
            {!! Form::label('defaultCurrency', Lang::get('admin/options.defaultCurrrency')) !!}
            {!! Form::select('defaultCurrency', ['' => Lang::get('admin/options.choice')] + $currencies, null, ['class'=>'form-control']) !!}
        </div>


        <div class="form-group col-md-4">
            {!! Form::label('otherCurrency', Lang::get('admin/options.otherCurrency')) !!}
            {!! Form::select('otherCurrency[]', ['' => Lang::get('admin/options.none')] + $currencies,
            isset($lastSettings->otherCurrency) ? $lastSettings->otherCurrency : null,
            ['class'=>'form-control otherCurrency', 'multiple']) !!}
        </div>

        <div class="form-group col-md-4">
            {!! Form::label('ratesOnline', Lang::get('admin/options.ratesOnline')) !!}
            <br>
            <div class="col-lg-1">
                {!! Form::radio('ratesOnline', 0, 0, ['id' => 'ratesOnlineNo', 'class'=>'form-check-input']) !!}
                <label class="form-check-label" for="ratesOnlineNo">
                    {{ Lang::get('admin/options.ratesOnlineNo')}}
                </label>
            </div>
            <div class="col-lg-1">
                {!! Form::radio('ratesOnline', 1, 1, ['id' => 'ratesOnlineYes', 'class'=>'form-check-input',
                'disabled'])  !!}
                <label class="form-check-label" for="ratesOnlineYes">
                    {{ Lang::get('admin/options.ratesOnlineYes')}}
                </label>
            </div>
        </div>
        <div class="form-grop col-md-12">
            {!! Form::submit(Lang::get('admin/options.save'), ['class'=>'btn btn-primary pull-right']) !!}
        </div>

        {!! Form::close() !!}

    </div>

    @include('includes.formError')

@endsection
