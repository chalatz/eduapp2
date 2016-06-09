@extends('layouts.app')

@section('content')

@inject('categories', 'App\Http\Utilities\Category')
@inject('districts', 'App\Http\Utilities\District')
@inject('counties', 'App\Http\Utilities\County')
@inject('countries', 'App\Http\Utilities\Country')
@inject('languages', 'App\Http\Utilities\Language')

@inject('categories', 'App\Http\Utilities\Category')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Καρτέλα Ιστότοπου</h1>

            {!! Form::model($site, ['method' => 'PUT', 'route' => ['sites.update', $site->id], 'class' => 'form-horizontal', 'role' => 'form']) !!}

            @include('sites.forms.partials.sites_info_form')
            @include('sites.forms.partials.sites_contact_info_form')

            <div class="form-group">
                <div class="col-md-12">
                    {{ Form::button('Αποθήκευση', ['type' => 'submit', 'class' => 'btn btn-primary btn-block btn-lg']) }}
                </div>
            </div>

            {!! Form::close() !!}

        </div>

    </div>
</div>

@endsection
