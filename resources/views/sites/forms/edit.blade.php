@extends('layouts.app')

@section('content')

@inject('categories', 'App\Http\Utilities\Category')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Στοιχεία Υποψηφιότητας</h4></div>
                <div class="panel-body">

                  {!! Form::model($site, ['method' => 'PUT', 'route' => ['sites.update', $site->id], 'class' => 'form-horizontal', 'role' => 'form']) !!}

                    @include('sites.forms.partials.sites_form')

                  {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
