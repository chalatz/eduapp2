@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Στοιχεία Αξιολογητή Α</h4></div>
                <div class="panel-body">

                  {!! Form::open(['route' => 'graders.store', 'class' => 'form-horizontal', 'role' => 'form']) !!}

                    @include('graders.forms.partials.graders_form')

                  {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
