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

<h1 class="bg-primary" style="padding: .5em 1em; margin-bottom: 1.5em">Αναθέσεις Α - Ιστότοποι</h1>

<table id="evaluations-panel-table" class="table table-striped admin-table">

<div class="row" style="padding: 1em">
    <div class="col-md-12">

        @if($cat != 'all')
            <h3>Κατηγορία: {{ $cat }}</h3>
        @endif

        <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <a href="{{ route('assignments_panel_a_sites', '1') }}" type="button" class="btn btn-primary btn-lg">
                    Κατηγορία 1
                </a>
            </div>
            <div class="btn-group" role="group">
                <a href="{{ route('assignments_panel_a_sites', '2') }}" type="button" class="btn btn-success btn-lg">
                    Κατηγορία 2
                </a>
            </div>
           <div class="btn-group" role="group">
                <a href="{{ route('assignments_panel_a_sites', '3') }}" type="button" class="btn btn-info btn-lg">
                    Κατηγορία 3
                </a>
            </div>
           <div class="btn-group" role="group">
                <a href="{{ route('assignments_panel_a_sites', '4') }}" type="button" class="btn btn-warning btn-lg">
                    Κατηγορία 4
                </a>
            </div>
           <div class="btn-group" role="group">
                <a href="{{ route('assignments_panel_a_sites', '6') }}" type="button" class="btn btn-danger btn-lg">
                    Κατηγορία 6
                </a>
            </div>                                  
        </div>
    </div>
</div>

  <thead>
    <tr>
      <th>Ιστότοπος</th>
      <th>Αξιολογητής 1</th>
      <th>Αξιολογητής 2</th>
      <th>Πλήθος</th>
    </tr>
  </thead>

  <tbody>
    @foreach($sites as $site)

        <tr>
            <td>
                <p>{{ $site->title }}</p>
                <p><a href="{{ $site->url }}" target="_blank">{{ $site->url }}</a></p>
                <p><strong>Κωδικός: </strong>{{ $site->id }}</p>                
                <p><strong>Κατηγορία: </strong>{{ $site->cat_id }}</p>
                <p><strong>Περιφέρεια: </strong>{{ $site->district_id }}</p>
                @if($site->cat_id == 6 && $site->specialty_id > 0)
                    <p><strong>Ειδικότητα: </strong>{{ $specialties::all()[$site->specialty_id] }}</p>
                @endif
                @if($site->cat_id == 1 && $site->primary_edu_id > 0)
                    <p><strong>Βαθμίδα: </strong>{{ $primary_schools::all()[$site->primary_edu_id] }}</p>
                @endif
                @if($site->cat_id == 3 && $site->secondary_edu_id > 0)
                    <p><strong>Βαθμίδα: </strong>{{ $secondary_schools::all()[$site->secondary_edu_id] }}</p>
                @endif                              
                <a class="btn btn-primary btn-block" href="{{ route('assign_eval_site_a', $site->id) }}" role="button">Ανάθεση</a>
            </td>

            @if(App\Evaluation::where('site_id', $site->id)->count() > 0)
                @foreach(App\Evaluation::where('site_id', $site->id)->get() as $evaluation)
                    @if($evaluation)
                        <?php $grader = App\Grader::find($evaluation->grader_id); ?>
                
                        <td @if($site->district_id != $grader->district_id) style="background-color: lightgreen" @else style="background-color: lightcoral" @endif >
                            @if($site->grader_id == $grader->id)
                                <h3 style="background:red; color:white; padding: 6px;">ΠΡΟΣΟΧΗ: Του ανατέθηκε ο Ιστότοπός του!!!</h3>
                            @endif
                            <h4>{{ $grader->last_name }} {{ $grader->first_name }}</h4>

                            <?php $assigned_sites = App\Evaluation::where('grader_id', $grader->id)->count(); ?>

                            @if($grader->hasSite())
                                <?php $his_sites = $grader->suggestions_count * 2; ?>
                            @else
                                <?php $his_sites = 2; ?>
                            @endif

                            @if($evaluation->can_evaluate == 'yes')
                                <p style="font-weight: bold; background-color: green; color: white; padding: .5em">
                                    Αποδέχτηκε
                                </p>
                            @endif
                            @if($evaluation->can_evaluate == 'no')
                                <p style="font-weight: bold; background-color: red; color: white; padding: .5em">
                                    Δεν Αποδέχτηκε επειδή:<br>
                                    {!! nl2br(e($evaluation->why_cannot_evaluate)) !!}
                                </p>
                            @endif
                            @if($evaluation->can_evaluate == 'na')
                                <p style="font-weight: bold; background-color: yellow; color:blue; padding: .5em">
                                    Δεν Αποδέχτηκε Ακόμη<br>
                                </p>
                            @endif

                            @if($evaluation->is_educational == 'no')
                                <p style="font-weight: bold; background-color: red; color: darkorange; padding: .5em">
                                    Δεν Βρήκε τον Ιστότοπο Εκπαιδευτικό επειδή:<br>
                                    {!! nl2br(e($evaluation->why_not_educational)) !!}
                                </p>
                            @endif                           


                            <p @if($assigned_sites > $his_sites) style="background: lightcoral; padding: 6px;" @endif >
                                <strong>Του ανατέθηκαν: </strong>{{ $assigned_sites }}
                            </p>

                            <p><strong>Του αναλογούν: </strong>{{ $his_sites }}</p>

                            <p><strong>Κωδικός: </strong>{{ $grader->id }}</p>
                            @if($grader->hasSite())
                                <p @if($site->cat_id == $grader->sites->first()->cat_id) style="background:red; color:white; padding: 6px;" @endif><strong>Κατηγορία: </strong>{{ $grader->sites->first()->cat_id }}</p>
                            @endif
                            <p @if($site->district_id == $grader->district_id) style="background:red; color:white; padding: 6px;" @endif><strong>Περιφέρεια: </strong>{{ $grader->district_id }}</p>
                            <p><strong>Ειδικότητα: </strong>{{ $specialties::all()[$grader->specialty_id] }}</p>
                            <p><strong>Επιθυμεί: </strong>{{ $grader->desired_category }}</p>
                            <p>
                                <strong>Εμπειρία:</strong> 
                                @foreach(explode('|', $grader->teaching_xp) as $xp_index)
                                    {{ $xp::all()[$xp_index] }},
                                @endforeach
                            </p>
                            
                            <p><strong>Ξένες Γλώσσες: </strong><p>
                            @if($grader->english) Αγγλικά - {{ $grader->english_level }}<br> @endif
                            @if($grader->french) Γαλλικά - {{ $grader->french_level }}<br> @endif
                            @if($grader->german) Γερμανικά - {{ $grader->german_level }}<br> @endif
                            @if($grader->italian) Ιταλικά - {{ $grader->italian_level }} @endif

                            <p><strong>Ξένες Γλώσσες - Προτιμήσεις: </strong><p>
                            @if($grader->lang_pref_english) Αγγλικά<br> @endif
                            @if($grader->lang_pref_french) Γαλλικά<br> @endif
                            @if($grader->lang_pref_german) Γερμανικά<br> @endif
                            @if($grader->lang_pref_italian) Ιταλικά @endif
                            
                        </td>
                    @endif
                @endforeach
            @else
                <td>
                    <p>Χωρίς ανάθεση</p>
                </td>
                <td>
                    <p>Χωρίς ανάθεση</p>
                </td>
            @endif

            <td>
                {{ App\Evaluation::where('site_id', $site->id)->count() }}
            </td>


        
        </tr>

    @endforeach
  </tbody>

    <tfoot>
        <th>Ιστότοπος</th>
        <th>Αξιολογητής 1</th>
        <th>Αξιολογητής 2</th>
        <th>Πλήθος</th>
  </tfoot>

</table>

@endsection
