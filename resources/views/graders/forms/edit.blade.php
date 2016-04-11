@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Στοιχεία Αξιολογητή</h4></div>
                <div class="panel-body">

                  {!! Form::model($grader, ['method' => 'PUT', 'route' => ['graders.update', $grader->id], 'class' => 'form-horizontal', 'role' => 'form']) !!}

                    {{ Form::hidden('proposal_status', $proposal_status) }}

                    @include('graders.forms.partials.graders_form')

                  {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
