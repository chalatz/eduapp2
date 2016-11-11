@extends('layouts.app')

@section('content')

@inject('categories', 'App\Http\Utilities\Category')
@inject('districts', 'App\Http\Utilities\District')
@inject('counties', 'App\Http\Utilities\County')
@inject('countries', 'App\Http\Utilities\Country')
@inject('languages', 'App\Http\Utilities\Language')

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h1>Υποβολή Υποψηφιότητας Ιστότοπου</h1>

            {!! Form::open(['route' => 'sites.store', 'class' => 'site-form form-horizontal', 'role' => 'form', 'data-parsley-validate']) !!}

              @include('sites.forms.partials.sites_info_form')
              @include('sites.forms.partials.sites_contact_info_form')
              @include('sites.partials.grader_a_info')

              {{ Form::hidden('i_agree', 0) }}
              <div class="col-md-12 form-group{{ $errors->has('i_agree') ? ' has-error' : '' }}">
                  {{ Form::checkbox('i_agree', 1, 0, ['id' => 'i_agree', 'required', 'data-parsley-required-message' => 'Πριν συνεχίσετε, θα πρέπει πρώτα να συμφωνήσετε.']) }}
                  <label for="i_agree">
                       Έχω διαβάσει τους <a href="http://2017.eduwebawards.gr/requirements/" target="_blank">Όρους συμμετοχής</a> και συμφωνώ με αυτούς
                   </label>

                  @if ($errors->has('i_agree'))
                      <span class="help-block">
                          <strong>{{ $errors->first('i_agree') }}</strong>
                      </span>
                  @endif

              </div>

              <div class="form-group">
                  <div class="col-md-12">
                      {{ Form::button('Αποθήκευση', ['type' => 'submit', 'class' => 'btn btn-primary btn-block btn-lg']) }}
                  </div>
              </div>

            {!! Form::close() !!}

        </div>
    </div>
</div>

@endsection
