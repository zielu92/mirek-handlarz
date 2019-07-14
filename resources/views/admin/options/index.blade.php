@extends('admin.layout.admin')


@section('content')
    <div class="col-lg-12">
        <h1>{{Lang::get('admin/options.options')}}</h1>
        @if($lastSettings)
            {!! Form::model($lastSettings,['method'=>'PATCH', 'action'=>['AdminOptionsController@update',
            $lastSettings->id], 'files'=>true]) !!}
            @else
                {!! Form::open(['method'=>'POST', 'action'=>'AdminOptionsController@store',  'files'=>true]) !!}
        @endif
        <h2>{{Lang::get('admin/options.main')}}</h2>
        <div class="form-row">
            <div class="form-group col-md-4">
                {!! Form::label('name', Lang::get('admin/options.name')) !!}
                {{ Form::text('name', null, ['class'=>'form-control'])}}
            </div>
{{--            <div class="form-group col-md-4">--}}
{{--                {!! Form::label('email', Lang::get('admin/options.email')) !!}--}}
{{--                {{ Form::email('email', null, ['id' => 'customer_id', 'class'=>'form-control'])}}--}}
{{--            </div>--}}
{{--            <div class="form-group col-md-4">--}}
{{--                {!! Form::label('phone1', Lang::get('admin/options.phone')) !!}--}}
{{--                {{ Form::text('phone1', null, ['class'=>'form-control'])}}--}}
{{--            </div>--}}
{{--            <div class="form-group col-md-4">--}}
{{--                {!! Form::label('address', Lang::get('admin/options.address')) !!}--}}
{{--                {{ Form::text('address', null, ['class'=>'form-control'])}}--}}
{{--            </div>--}}
            <div class="form-group col-md-4">
                {!! Form::label('logo', Lang::get('admin/options.logo')) !!}
                {!! Form::file('logo', ['class'=>'form-control']) !!}
            </div>
        </div>
        <hr>
        <h2>{{Lang::get('admin/options.page')}}</h2>
        <div class="form-row">
            <div class="form-group col-md-4">
                {!! Form::label('defaultLanguage', Lang::get('admin/options.language')) !!}
                {!! Form::select('defaultLanguage', ['' => Lang::get('admin/options.choice'),
                'en'=>'English','pl'=>'Polski'], null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group col-md-4">
                {!! Form::label('multiLanguage', Lang::get('admin/options.multiLanguage'))  !!}
                <br>
                <div class="col-lg-1">
                    {!! Form::radio('multiLanguage', 1, 1, ['class'=>'form-check-input'])  !!}
                    <label class="form-check-label" for="ratesOnlineYes">
                        {{ Lang::get('admin/options.ratesOnlineYes')}}
                    </label>
                </div>
                <div class="col-lg-1">
                    {!! Form::radio('multiLanguage', 0, 0, ['class'=>'form-check-input']) !!}
                    <label class="form-check-label" for="ratesOnlineNo">
                        {{ Lang::get('admin/options.ratesOnlineNo')}}
                    </label>
                </div>
            </div>
        </div>
        <hr>
        <h2>{{Lang::get('admin/options.currency')}}</h2>
        <div class="form-row">
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
                    {!! Form::radio('ratesOnline', 1, 1, ['id' => 'ratesOnlineYes', 'class'=>'form-check-input'])  !!}
                    <label class="form-check-label" for="ratesOnlineYes">
                        {{ Lang::get('admin/options.ratesOnlineYes')}}
                    </label>
                </div>
            </div>
        </div>
        <div class="form-grop col-md-12">
            {!! Form::submit(Lang::get('admin/options.save'), ['class'=>'btn btn-primary pull-right']) !!}
        </div>

        {!! Form::close() !!}

    </div>

    @include('includes.formError')

@endsection
