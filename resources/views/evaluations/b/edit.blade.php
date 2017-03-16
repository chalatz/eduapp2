@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col md-12">

        <div class="panel panel-info">
            <div class="panel-heading">
                <h2 class="panel-title">Στοιχεία Ιστότοπου</h2>
            </div>
            <div class="panel-body">
                <a href="{{ App\Site::find($evaluation->site_id)->url }}" target="_blank" style="font-weight: bold; font-size: 1.3em; margin-bottom: 2em; display: block;">
                    {{ App\Site::find($evaluation->site_id)->title }} <i class="fa fa-external-link" aria-hidden="true"></i>
                </a>
            </div>
        </div>

        <p><strong><a href="{{ route('evaluation_b.show') }}">&larr; Επιστροφή στις Αναθέσεις Μου</a></strong></p>

        {!! Form::model($evaluation, ['method' => 'PATCH','route' => ['evaluation_b.update', $evaluation->id], 'class' => 'form-horizontal', 'id' => 'evaluation_update', 'name' => 'evaluation_update', 'data-parsley-validate']) !!}

            @include('evaluations.partials.' .$criterion. '_criterion_form')
                
            <div class="form-group">
                <div class="col-md-12">
                    {{ Form::button('Αποθήκευση', ['type' => 'submit', 'class' => 'btn btn-primary btn-block btn-lg']) }}
                </div>
            </div>

        {{ Form::close() }}

        <p><strong><a href="{{ route('evaluation_b.show') }}">&larr; Επιστροφή στις Αναθέσεις Μου</a></strong></p>

    </div>
</div>

@endsection