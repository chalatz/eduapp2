@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <a href="{{ route('user.suggest_answer', ['answer' => 'yes', 'unique_string' => $unique_string]) }}" type="button" class="btn btn-success btn-lg btn-block">
                Αποδέχομαι
            </a>

            <a href="{{ route('user.suggest_answer', ['answer' => 'no', 'unique_string' => $unique_string]) }}" type="button" class="btn btn-danger btn-lg btn-block">
                Δεν Αποδέχομαι
            </a>

        </div>
    </div>
</div>
@endsection
