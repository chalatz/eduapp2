@extends('layouts.admin')

@section('content')

@inject('specialties', 'App\Http\Utilities\Specialty')
@inject('districts', 'App\Http\Utilities\District')
@inject('counties', 'App\Http\Utilities\County')
@inject('categories', 'App\Http\Utilities\Category')
@inject('lang_levels', 'App\Http\Utilities\Lang_level')
@inject('xp', 'App\Http\Utilities\Teaching_xp')
@inject('primary_schools', 'App\Http\Utilities\PrimaryEdu')
@inject('secondary_schools', 'App\Http\Utilities\SecondaryEdu')

<h1 class="bg-success" style="padding: .5em 1em; margin-bottom: 1.5em">
    Φάση Β - Αναθέσεις Ιστότοπου σε Αξιολογητές Β
</h1>
<div style="padding: 0 2em;">


    <p style="font-size: 1.5em">
        <a href="{{ route('assignments_panel_b_sites', $site->cat_id) }}">&larr; Επιστροφή στις Αναθέσεις Β</a>
    </p>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Επωνυμία
                    </h3>
                </div>
                <div class="panel-body">
                    {{ $site->title }} - <a href="{{ $site->url }}" target="_blank">{{ $site->url }}</a>
                </div>
                <div class="panel-footer">
                    Κατηγορία: {{ $site->cat_id }}, Περιφέρεια: {{ $site->district_id }}, Κωδικός: {{ $site->id }}
                    @if($site->cat_id == 6 && $site->specialty_id > 0)
                        <p>Ειδικότητα: {{ $specialties::all()[$site->specialty_id] }}</p>
                    @endif
                    @if($site->cat_id == 1 && $site->primary_edu_id > 0)
                        <p>Βαθμίδα: {{ $primary_schools::all()[$site->primary_edu_id] }}</p>
                    @endif
                    @if($site->cat_id == 3 && $site->secondary_edu_id > 0)
                        <p>Βαθμίδα: {{ $secondary_schools::all()[$site->secondary_edu_id] }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Δημιουγός Ιστότοπου (από τη δήλωση υποφηφιότητας)
                    </h3>
                </div>
                <div class="panel-body">
                    {{ $site->creator }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Αξιολογητής προτεινόμενος από τον Ιστότοπο
                    </h3>
                </div>
                <div class="panel-body">
                    {{ App\Grader::find($site->grader_id)->last_name }} {{ App\Grader::find($site->grader_id)->first_name }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Εδικότητα (από τη δήλωση του προτεινόμενου Αξιολογητή)
                    </h3>
                </div>
                <div class="panel-body">
                    @if($site->cat_id == 6)
                        {{ $specialties::all()[$site->specialty_id] }}
                    @else
                        {{ $specialties::all()[App\Grader::find($site->grader_id)->specialty_id] }}
                    @endif
                    
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">
                        Τρέχουσες αναθέσεις
                    </h2>
                </div>
                <div class="panel-body">
                    
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Αξιολογητής</th>
                                <th>Περιφέρεια</th>
                                <th>Κατηγορία</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach(App\Assignment_b::where('site_id', $site->id)->get() as $assignment)
                                <?php $grader = App\Grader::find($assignment->grader_id); ?>

                                <?php $assigned_sites = App\Assignment_b::where('grader_id', $grader->id)->count(); ?>
                                @if($grader->hasSite())
                                    <?php $his_sites = $grader->suggestions_count * 2; ?>
                                @else
                                    <?php $his_sites = 2; ?>
                                @endif
                                <tr>
                                    <td>
                                        {{ $grader->last_name }} {{ $grader->first_name }}, {{ $specialties::all()[$grader->specialty_id] }}
                                        <p>
                                            <strong>Αναθέσεις Φάσης Β:</strong> {{ App\Assignment_b::where('grader_id', $grader->id)->count() }}
                                        </p>

                                        <p>
                                            <strong>Αναθέσεις Φάσης Α:</strong> {{ App\Assignment::where('grader_id', $grader->id)->count() }}
                                        </p>
                                    </td>
                                    <td @if($site->district_id != $grader->district_id) style="background-color: lightgreen" @else style="background-color: lightcoral" @endif>{{ $grader->district_id }}</td>
                                    <td @if($grader->hasSite() && $site->cat_id != $grader->sites->first()->cat_id) style="background-color: lightgreen" @else style="background-color: lightcoral" @endif>
                                        @if($grader->hasSite()) 
                                            {{ $grader->sites->first()->cat_id }}
                                        @else
                                            Χωρίς κατηγορία (αφού δεν υπάρχει υποψήφιος)
                                        @endif
                                    </td>
                                    <td><a class="btn btn-danger" href="{{ route('assign_delete_b', [$assignment->id, $site->id]) }}" role="button" onclick="return confirm('Εϊστε σίγουρος;');">Διαγραφή</a></td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                    
                </div>
            </div>
        </div>
    </div>


        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['route' => 'assignments.store_manual_b', 'class' => 'form-horizontal', 'role' => 'form', 'data-parsley-validate']) !!}

                <div class="form-group">
                    <div class="col-md-12">

                        <p class="help-block">
                            <strong>Περ.</strong>   - Περιφέρεια<br>
                            <strong>Κατ.</strong> - Κατηγορία site υποψηφιότητας Αξιολογητή<br>
                            <strong>Ειδ.</strong> - Ειδικότητα<br>
                            <strong>Επιθυμεί.</strong> - Κατηγορίες που επιθυμεί<br>
                            <strong>Κωδ. site.</strong> - Κωδικός site υποψηφιότητας Αξιολογητή<br>
                            <strong>ΧΥ</strong> - Χωρίς Υποψηφιότητα<br>
                            <strong>Φάση Α/Β</strong> - Αναθέσεις Φάσης Α/Β<br>                            
                        </p>
                    
                        <select name="grader_id" id="grader_id" class="js-example-basic-single select2" "required">

                            <option value="">Επιλέξτε Αξιολογητή Β...</option>

                            @foreach($graders as $mygrader)

                                @if($mygrader->user->hasRole('grader_b'))

                                    @if($mygrader->hasSite()))
                                        <?php $grader_cat_id =  $mygrader->sites->first()->cat_id; ?>
                                    @else
                                        <?php $grader_cat_id =  0; ?>
                                    @endif

                                    @if($mygrader->id != $site->grader_id && $mygrader->district_id != $site->district_id && $grader_cat_id != $site->cat_id)
                                        <option value="{{ $mygrader->id }}">
                                            @if(!$mygrader->hasSite()) ΧΥ - @endif
                                            {{ $mygrader->last_name }} {{ $mygrader->first_name }}, 
                                            Περ. {{ $mygrader->district_id }},
                                            @if($mygrader->hasSite())                                             
                                                Κατ. {{ $mygrader->sites->first()->cat_id }}, 
                                            @endif
                                            Ειδ. {{ $specialties::all()[$mygrader->specialty_id] }},
                                            Επιθυμεί. {{ $mygrader->desired_category }}, 
                                            Εμπειρία. 
                                            @foreach(explode('|', $mygrader->teaching_xp) as $xp_index)
                                                {{ $xp::all()[$xp_index] }}, 
                                            @endforeach

                                            Ξένες Γλώσσες. 
                                            @if($mygrader->english) Αγγλικά - {{ $mygrader->english_level }}, @endif
                                            @if($mygrader->french) Γαλλικά - {{ $mygrader->french_level }}, @endif
                                            @if($mygrader->german) Γερμανικά - {{ $mygrader->german_level }}, @endif
                                            @if($mygrader->italian) Ιταλικά - {{ $mygrader->italian_level }}, @endif

                                            Ξένες Γλώσσες - Προτιμήσεις. 
                                            @if($mygrader->lang_pref_english) Αγγλικά, @endif
                                            @if($mygrader->lang_pref_french) Γαλλικά, @endif
                                            @if($mygrader->lang_pref_german) Γερμανικά, @endif
                                            @if($mygrader->lang_pref_italian) Ιταλικά, @endif

                                            Φάση Α: {{ App\Assignment::where('grader_id', $mygrader->id)->count() }} 
                                            Φάση Β: {{ App\Assignment_b::where('grader_id', $mygrader->id)->count() }}                                         
                                            
                                        </option>

                                    @endif

                                @endif

                            @endforeach

                        </select>

                        @if ($errors->has('grader_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('grader_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{ Form::hidden('site_id', $site->id) }}
                
                <div class="form-group">
                    <div class="col-md-12">
                        {{ Form::button('Υποβολη Ανάθεσης', ['type' => 'submit', 'class' => 'btn btn-primary btn-block btn-lg']) }}
                    </div>
                </div>

                {!! Form::close() !!}

            </div>
        </div>

        <p style="font-size: 1.5em">
            <a href="{{ route('assignments_panel_b_sites', $site->cat_id) }}">&larr; Επιστροφή στις Αναθέσεις Α</a>
        </p>

</div>



@endsection
