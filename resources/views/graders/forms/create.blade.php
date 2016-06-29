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

                  {!! Form::open(['route' => 'graders.store', 'class' => 'form-horizontal', 'role' => 'form', 'data-parsley-validate']) !!}

                    @include('graders.forms.partials.graders_form')

                    <div class="form-group">
                        <div class="col-md-12">
                            @if(isset($edit_and_suggest_self) && $edit_and_suggest_self)
                                {{ Form::button('Αποδοχή και Αποθήκευση', ['type' => 'submit', 'class' => 'btn btn-primary btn-block btn-lg']) }}
                            @else
                                {{ Form::button('Αποθήκευση', ['type' => 'submit', 'class' => 'btn btn-primary btn-block btn-lg']) }}
                            @endif
                        </div>
                    </div>

                  {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
