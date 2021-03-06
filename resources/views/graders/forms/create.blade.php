@extends('layouts.app')

@section('content')

@inject('specialties', 'App\Http\Utilities\Specialty')
@inject('districts', 'App\Http\Utilities\District')
@inject('counties', 'App\Http\Utilities\County')
@inject('categories', 'App\Http\Utilities\Category')
@inject('lang_levels', 'App\Http\Utilities\Lang_level')
@inject('teaching_xp', 'App\Http\Utilities\Teaching_xp')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading"><h4>Εγγραφή Αξιολογητή Α</h4></div>
                <div class="panel-body">

                  {!! Form::open(['route' => 'graders.store', 'class' => 'form-horizontal', 'role' => 'form', 'files' => true, 'data-parsley-validate']) !!}

                    @if(isset($answer) && $answer == 'yes')
                        <div class="alert alert-info" role="alert">
                            <strong>Η αποδοχή σας θα καταχωρηθεί μόνο αφού συμπληρώσετε τα στοιχεία σας και πατήσετε Αποθήκευση.</strong>
                        </div>
                    @endif

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
