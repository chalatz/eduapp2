@if(App\Config::first()->phase_a_gradings && Auth::user()->grader && Auth::user()->grader->has_eval_a())
    <p>
        <a href="{{ route('evaluation_a.show') }}" type="button" class="btn btn-success btn-lg btn-block">
            Α Φάση: Έναρξη Αξιολόγησης
        </a>
    </p>
@endif