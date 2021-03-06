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
                <div class="panel-heading"><h4>Καρτέλα Αξιολογητή Α</h4></div>
                <div class="panel-body">

                  {!! Form::model($grader, ['method' => 'PUT', 'route' => ['graders.update', $grader->id], 'class' => 'form-horizontal', 'role' => 'form', 'files' => true, 'data-parsley-validate']) !!}

                    @if(isset($edit_and_suggest_self) && $edit_and_suggest_self)
                        {{ Form::hidden('edit_and_suggest_self', 'yes') }}
                    @endif

                    @include('graders.forms.partials.graders_form')

                    <div class="form-group">
                        <div class="col-md-12">
                            @if($end_of_gradings == 0 || Session::has('ninja_id') || Auth::user()->hasRole('member'))
                                @if(isset($edit_and_suggest_self) && $edit_and_suggest_self)
                                    {{ Form::button('Αποδοχή και Αποθήκευση', ['type' => 'submit', 'class' => 'btn btn-primary btn-block btn-lg']) }}
                                @else
                                    {{ Form::button('Αποθήκευση', ['type' => 'submit', 'class' => 'btn btn-primary btn-block btn-lg']) }}
                                @endif
                            @else
                                {{ Form::button('Αποθήκευση', ['type' => 'button', 'class' => 'btn btn-primary btn-block btn-lg', 'disabled' => 'disabled']) }}
                                <p class="text-danger lead">
                                    <strong>Η επεξεργασία Αξιολογητών έχει λήξει</strong>
                                </p>
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
