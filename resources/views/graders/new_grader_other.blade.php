@extends('layouts.app')

@section('content')

@inject('specialties', 'App\Http\Utilities\Specialty')
@inject('districts', 'App\Http\Utilities\District')
@inject('categories', 'App\Http\Utilities\Category')
@inject('lang_levels', 'App\Http\Utilities\Lang_level')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading"><h4>Εγγραφή Αξιολογητή Α</h4></div>
                <div class="panel-body">

                  {!! Form::open(['route' => 'store_other_grader', 'class' => 'form-horizontal', 'role' => 'form', 'data-parsley-validate']) !!}

                    @include('suggestions.forms.partials.new_grader_form')

                  {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
