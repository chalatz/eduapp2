@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <a href="{{ route('graders.create') }}" type="button" class="btn btn-success btn-lg btn-block">
                Προτείνω τον εαυτό μου
            </a>

        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <a href="{{ route('suggest_other_grader') }}" type="button" class="btn btn-info btn-lg btn-block">
                Προτείνω κάποιον άλλον
            </a>

        </div>
    </div>

</div>

@endsection
