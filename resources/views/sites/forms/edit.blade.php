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

            {!! Form::model($site, ['method' => 'PUT', 'route' => ['sites.update', $site->id], 'class' => 'site-form form-horizontal', 'role' => 'form','data-parsley-validate']) !!}

            @include('sites.forms.partials.sites_info_form')
            @include('sites.forms.partials.sites_contact_info_form')
            @include('sites.partials.grader_a_info')

            <div class="form-group">
                <div class="col-md-12">
                    @if($end_of_gradings == 0 || Session::has('ninja_id') || Auth::user()->hasRole('member'))
                        {{ Form::button('Αποθήκευση', ['type' => 'submit', 'class' => 'btn btn-primary btn-block btn-lg']) }}
                    @else
                        {{ Form::button('Αποθήκευση', ['type' => 'button', 'class' => 'btn btn-primary btn-block btn-lg', 'disabled' => 'disabled']) }}                        
                        <p class="text-danger lead">
                            <strong>Η επεξεργασία Υποψηφιοτήτων έχει λήξει</strong>
                        </p>
                    @endif
                </div>
            </div>

            {!! Form::close() !!}

        </div>

    </div>
</div>

@endsection
