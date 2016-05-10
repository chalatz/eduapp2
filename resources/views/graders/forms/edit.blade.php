@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Στοιχεία Αξιολογητή</h4></div>
                <div class="panel-body">

                  {!! Form::model($grader, ['method' => 'PUT', 'route' => ['graders.update', $grader->id], 'class' => 'form-horizontal', 'role' => 'form']) !!}

                    @if(isset($edit_and_suggest_self) && $edit_and_suggest_self)
                        {{ Form::hidden('edit_and_suggest_self', 'yes') }}
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
