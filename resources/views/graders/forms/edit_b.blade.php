@extends('layouts.app')

@section('content')

@inject('specialties', 'App\Http\Utilities\Specialty')
@inject('districts', 'App\Http\Utilities\District')
@inject('categories', 'App\Http\Utilities\Category')
@inject('lang_levels', 'App\Http\Utilities\Lang_level')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Στοιχεία Αξιολογητή Β</h4></div>
                <div class="panel-body">

                  {!! Form::model($grader, ['method' => 'PUT', 'route' => ['graders.update_b', $grader->id], 'class' => 'form-horizontal', 'role' => 'form']) !!}

                    @include('graders.forms.partials.graders_form')

                    @include('graders.forms.partials.graders_b_form')

                    <div class="form-group">
                        <div class="col-md-12">
                            {{ Form::button('Αποθήκευση', ['type' => 'submit', 'class' => 'btn btn-primary btn-block btn-lg']) }}
                        </div>
                    </div>

                  {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
