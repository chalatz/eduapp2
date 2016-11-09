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

                  {!! Form::open(['route' => 'store_other_grader', 'class' => 'form-horizontal', 'role' => 'form', 'files' => true, 'data-parsley-validate']) !!}

                    <div class="alert alert-info" role="alert">
                        <strong>Η αποδοχή σας θα καταχωρηθεί μόνο αφού συμπληρώσετε τα στοιχεία σας και πατήσετε Αποθήκευση.</strong>
                    </div>

                    @include('suggestions.forms.partials.new_grader_form')

                  {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
