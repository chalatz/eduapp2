@extends('layouts.app')

@section('content')
<div class="container">

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

</div>

@endsection
