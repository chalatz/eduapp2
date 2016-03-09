@extends('layouts.app')

@section('content')

@inject('categories', 'App\Http\Utilities\Category')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Στοιχεία Υποψηφιότητας</h4></div>
                <div class="panel-body">

                  {!! Form::open(['route' => 'store_other_grader', 'class' => 'form-horizontal', 'role' => 'form']) !!}

                    @include('suggestions.forms.partials.new_grader_form')

                  {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
