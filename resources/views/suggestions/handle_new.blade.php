@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <p class="lead">
                Σας έχει προτείνει ο υποψήφιος με ονομασία <strong class="bg-info">{{ $suggestion->suggestor_name }}</strong> και email <strong class="bg-info">{{ $suggestion->suggestor_email }}</strong>.
            </p>
            <p class="lead">
                Προσωπικό μήνυμα από τον υποψήφιο:
            </p>
            <p class="lead bg-info" style="padding: .2em 1em">{!! nl2br(e($suggestion->personal_msg)) !!}</p>

        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <button type="button" class="text-danger btn btn-link btn-lg btn-block" data-toggle="modal" data-target="#what-is-grader-a-modal">
                <i class="fa fa-exclamation-triangle text-danger" aria-hidden="true"></i>&nbsp;
                <span class="text-danger">Τι Είναι ο Αξιολογητής Α και ποιες οι υποχρεώσεις του</span>
            </button>

        </div>
    </div>

    @if(isset($suggestions_count))
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="alert alert-warning lead" role="alert">
                    @if($suggestions_count == 1)
                        Έχετε ήδη αποδεχθεί πρόσκληση Αξιολογητή άλλη μία φορά. Παρακαλούμε αποδεχτείτε μόνον εάν είστε διατεθιμένος να αξιολογήσετε ισάριθμους Ιστότοπους, μέσα στους προβλεπόμενους χρόνους.
                    @endif
                    @if($suggestions_count > 1)
                        Έχετε ήδη αποδεχθεί προσκλήσεις Αξιολογητή άλλες {{ $suggestions_count }} φορές. Παρακαλούμε αποδεχτείτε μόνον εάν είστε διατεθιμένος να αξιολογήσετε ισάριθμους Ιστότοπους, μέσα στους προβλεπόμενους χρόνους.
                    @endif
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <a href="{{ route('user.suggest_answer', ['answer' => 'yes', 'unique_string' => $unique_string]) }}" type="button" class="btn btn-success btn-lg btn-block" onclick="return confirm('Εϊστε σίγουρος ότι αποδέχεστε;');">
                <i class="fa fa-check" aria-hidden="true"></i> Αποδέχομαι
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <a href="{{ route('user.suggest_answer', ['answer' => 'no', 'unique_string' => $unique_string]) }}" type="button" class="btn btn-danger btn-lg btn-block" onclick="return confirm('Εϊστε σίγουρος ότι ΔΕΝ αποδέχεστε;');">
                <i class="fa fa-times" aria-hidden="true"></i> Δεν Αποδέχομαι
            </a>
        </div>
    </div>

    @include('partials.what_is_grader_a')

</div>
@endsection
