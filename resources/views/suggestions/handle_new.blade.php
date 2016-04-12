@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            @if(isset($suggestions_count))

                <div class="alert alert-warning lead" role="alert">
                    @if($suggestions_count == 1)
                        Έχετε ήδη αποδεχθεί πρόσκληση Αξιολογητή άλλη μία φορά. Παρακαλούμε αποδεχτείτε μόνον εάν είστε διατεθιμένος να αξιολογήσετε ισάριθμους Ιστότοπους, μέσα στους προβλεπόμενους χρόνους.
                    @endif
                    @if($suggestions_count > 1)
                        Έχετε ήδη αποδεχθεί προσκλήσεις Αξιολογητή άλλες {{ $suggestions_count }} φορές. Παρακαλούμε αποδεχτείτε μόνον εάν είστε διατεθιμένος να αξιολογήσετε ισάριθμους Ιστότοπους, μέσα στους προβλεπόμενους χρόνους.
                    @endif
                </div>

            @endif

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
