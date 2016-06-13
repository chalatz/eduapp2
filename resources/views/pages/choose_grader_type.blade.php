@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <button type="button" class="text-danger btn btn-link btn-danger btn-lg btn-block" data-toggle="modal" data-target="#what-is-grader-a-modal">
                <i class="fa fa-exclamation-triangle text-danger" aria-hidden="true"></i>&nbsp;
                <span class="text-danger lead">Τι Είναι ο Αξιολογητής Α και ποιες οι υποχρεώσεις του</span>
            </button>

        </div>
    </div> 

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if(Auth::user()->hasRole('grader_a'))
                @if(Auth::user()->suggestion))
                    <a href="{{ route('graders.edit', Auth::user()->grader->id) }}" type="button" class="btn btn-success btn-lg btn-block">
                @else
                    <a href="{{ route('graders.edit_and_suggest_self', Auth::user()->grader->id) }}" type="button" class="btn btn-success btn-lg btn-block">
                @endif

            @else
                <a href="{{ route('graders.create') }}" type="button" class="btn btn-success btn-lg btn-block">
            @endif

                Προτείνω τον εαυτό μου
            </a>

        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <a href="{{ route('other_grader_email') }}" type="button" class="btn btn-info btn-lg btn-block">
                Προτείνω κάποιον άλλον
            </a>

        </div>
    </div>   

    @include('partials.what_is_grader_a')

</div>

@endsection
