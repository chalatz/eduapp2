@if(App\Config::first()->phase_c_gradings && Auth::user()->grader && Auth::user()->grader->has_to_grade_c())
    <p>
        <a href="{{ route('evaluation_c.show') }}" type="button" class="btn btn-danger btn-lg btn-block">
            Γ Φάση: Έναρξη Αξιολόγησης
        </a>
    </p>
@endif                

@if(Auth::user()->hasRole('site') && App\Config::first()->end_of_gradings)
    @if(Auth::user()->site->survey_ok)
        <p>
            <a style="font-size: 2em" href="{{ route('site.summary') }}" type="button" class="btn btn-info btn-lg btn-block">
                <i class="fa fa-eye" aria-hidden="true"></i> Δείτε τη Βαθμολογία σας και τυχόν σχόλια
            </a>
        </p>
    @else

        <div class="attention-block">
            <p>
                Προκειμένου να δείτε τη βαθμολογία σας, θα πρέπει πρώτα να συμπληρώσετε το <a href="https://goo.gl/forms/SYiQYVIpyhxEgENL2" target="_blank">ερωτηματολόγιο</a> στη διεύθυνση <a href="https://goo.gl/forms/SYiQYVIpyhxEgENL2" target="_blank">https://goo.gl/forms/SYiQYVIpyhxEgENL2</a>.
            </p>
            <p>
                Μετά την υποβολή του ερωτηματολογίου, <span class="highlighter">θα σας δωθεί ένα κλειδί</span>, το οποίο θα πρέπει να υποβάλλετε παρακάτω και να πατήσετε <strong>Επιβεβαίωση Κλειδιού</strong>.
            </p>
        </div>

        {!! Form::open(['route' => 'store_survey', 'class' => 'form-horizontal', 'role' => 'form', 'data-parsley-validate']) !!}

        <div class="form-group">
            <div class="col-md-12">
                
                <div class="col-md-12 form-group{{ $errors->has('survey_key') ? ' has-error' : '' }}">
                    {{ Form::label('survey_key', 'Δώστε το Κλειδί που πείρατε μετά τη συμπλήρωση του Ερωτηματολογίου:') }}
                    {{ Form::text('survey_key', null, ['class' => 'form-control', 'id' => 'survey_key', 'required']) }}

                    @if ($errors->has('survey_key'))
                        <span class="help-block">
                            <strong>{{ $errors->first('survey_key') }}</strong>
                        </span>
                    @endif
                </div>                 

                {{ Form::button('Επιβεβαίωση Κλειδιού', ['type' => 'submit', 'class' => 'btn btn-primary btn-block btn-lg']) }}

            </div>
        </div>
        
    @endif
@endif