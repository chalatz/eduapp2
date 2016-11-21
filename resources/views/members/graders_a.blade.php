@extends('layouts.admin')

@section('content')

@inject('specialties', 'App\Http\Utilities\Specialty')
@inject('districts', 'App\Http\Utilities\District')
@inject('counties', 'App\Http\Utilities\County')
@inject('categories', 'App\Http\Utilities\Category')
@inject('lang_levels', 'App\Http\Utilities\Lang_level')
@inject('xp', 'App\Http\Utilities\Teaching_xp')

<h1 class="bg-primary" style="padding: .5em 1em; margin-bottom: 1.5em">Αξιολογητές Α</h1>

<div class="row">
    <div class="col-md-8 col-md-offset-1">
        <a href="{{ route('members.graders_a_print') }}" target="_blank" type="button" class="btn btn-primary btn-lg">
          <i class="fa fa-print" aria-hidden="true"></i> Εκτυπώσιμη Μορφή
        </a>
        <em>Ανοίγει σε νέο παράθυρο και μετά Επιλογή Όλων (CTRL + A), αντιγραφή και επικόλληση στο Excel.</em>
    </div>
</div>

<table id="graders-table" class="table table-striped admin-table">

  <thead>
    <tr>
      <th>Κωδικός</th>
      <th>Φωτό</th>
      <th>Eπώνυμο</th>
      <th>Όνομα</th>
      <th>Email</th>
      <th>Τηλ. Ιστότοπου που τον πρότεινε</th>
      <th>Ειδικότητα</th>
      <th>Περιφέρεια</th>
      <th>Περιφ. Ενότητα</th>
      <th>Ταχ. Διεύθυνση</th>
      <th>Κατηγορίες που επιθυμεί</th>
      <th>Αξιολογητής Α στον προηγούμενο διαγωνισμό</th>
      <th>Αξιολογητής σε περισσότερους από έναν διαγωνισμούς</th>
      <th>Θα ήθελα να συμμετάσχω και ως Αξιολογητής Β</th>
      <th>Ξένες Γλώσσες</th>
      <th>Ξένες Γλώσσες - Προτιμήσεις</th>
      <th>Άλλες Ξένες Γλώσσες</th>
      <th>Ιστότοπος που τον πρότεινε</th>
      <th>Email Ιστότοπου</th>
      <th>Κατηγορία Ιστότοπου</th>
      <th>Περιφέρεια Ιστότοπου</th>
      <th>Αυτοπροτάθηκε</th>
      <th>Αποδέχτηκε</th>
      <th>Δημιουργήθηκε</th>
      <th>Εμπειρία</th>
      <th>Προσωπικά URL</th>
      <th>Βιογραφικό</th>
      @if(Auth::user()->hasRole('admin'))
          <th>Μεταμφίεση</th>
      @endif

    </tr>
  </thead>

  <tbody>
    @foreach($graders as $grader)

      @if($grader->user->hasRole('grader_a'))

        <tr>
          <td>{{ $grader->code() }}</td>
          <td>
            @if(strlen($grader->photo) > 0)
              <a class="enlarge-me" href="{{ route('graders.get_file', $grader->photo) }}">
                <img src="{{ route('graders.get_file', $grader->photo) }}" width="100" height="100" alt="{{ $grader->last_name }} {{ $grader->firt_name }}" title="{{ $grader->last_name }} {{ $grader->firt_name }}"></img>
              </a>
            @else
              χωρίς φωτό
            @endif
          </td>
          <td>{{ $grader->last_name }}</td>
          <td>{{ $grader->first_name }}</td>
          <td>{{ $grader->user->email }}</td>
          <td>
            @if($grader->sites->count() > 0)
              @foreach($grader->sites as $site)
                {{ $site->contact_phone }}<br>
              @endforeach
            @else
             na
            @endif
          </td>
          <td>{{ $specialties::all()[$grader->specialty_id] }}</td>
          <td>{{ $districts::all()[$grader->district_id] }}</td>
          <td>{{ $counties::flat_counties()[$grader->county_id] }}</td>
          <td>{{ $grader->address }}</td>
          <td>{{ $grader->desired_category }}</td>
          <td>{{ $grader->past_grader }}</td>
          <td>{{ $grader->past_grader_more }}</td>
          <td>{{ $grader->wants_to_be_grader_b }}</td>
          <td>
            @include('partials.languages')
          </td>
          <td>
            @include('partials.lang_prefs')
          </td>
          <td>{{ $grader->languages_other }} {{ $grader->languages_other_level }}</td>
          <td>
            @if($grader->sites->count() > 0)
              @foreach($grader->sites as $site)
                {{ $site->title }}
                <br>---<br>
              @endforeach
            @else
             na
            @endif
          </td>
          <td>
            @foreach(App\Suggestion::where('grader_email', $grader->user->email)->get() as $suggestion)
              {{ $suggestion->suggestor_email }}
              <br>---<br>
            @endforeach
          </td>
          <td>
            @if($grader->sites->count() > 0)
              @foreach($grader->sites as $site)
                {{ $site->contact_email }}
                <br>---<br>
              @endforeach
            @else
             na
            @endif
          </td>
          <td>
          @if($grader->sites->count() > 0)
            @foreach($grader->sites as $site)
              {{ $districts::all()[$site->district_id] }}
              <br>---<br>
            @endforeach
          @else
            na
          @endif
          </td>
          <td>
            @foreach(App\Suggestion::where('grader_email', $grader->user->email)->get() as $suggestion)
              {{ $suggestion->self_proposed }}
              <br>---<br>
            @endforeach
          </td>
          <td>
            @foreach(App\Suggestion::where('grader_email', $grader->user->email)->get() as $suggestion)
              {{ $suggestion->accepted }}
              <br>---<br>
            @endforeach
          </td>
          <td>{{ date('d / m / Y', strtotime($grader->created_at)) }}</td>
          <td>
            <?php $xps = explode('|', $grader->teaching_xp); ?>
            <ul>
            @foreach(explode('|', $grader->teaching_xp) as $xp_id)
              <li>{{ $xp::all()[$xp_id] }}</li>
            @endforeach
            </ul>
          </td>
          <td>
            <a href="{{ $grader->personal_url }}" target="_blank">{{ $grader->personal_url }}</a><br>
            <a href="{{ $grader->personal_url_2 }}" target="_blank">{{ $grader->personal_url_2 }}</a><br>
            <a href="{{ $grader->personal_url_3 }}" target="_blank">{{ $grader->personal_url_3 }}</a><br>
            <a href="{{ $grader->personal_url_4 }}" target="_blank">{{ $grader->personal_url_4 }}</a>
          </td>
          <td>
            @if(strlen($grader->personal_cv) > 0)
              <a href="{{ route('graders.get_file', $grader->personal_cv) }}">
                Άνοιγμα
              </a>
            @else
              na
            @endif
          </td>
          @if(Auth::user()->hasRole('admin'))
              <td>
                  <a href="{{ route('admin.masquerade', $grader->user->id) }}" target="_blank">Μεταμφίεση</a>
              </td>
          @endif

        </tr>

      @endif

    @endforeach
  </tbody>

  <tfoot>
    <th>Κωδικός</th>
    <th></th>
    <th>Eπώνυμο</th>
    <th>Όνομα</th>
    <th>Email</th>
    <th>Τηλ. Ιστότοπου που τον πρότεινε</th>
    <th>Ειδικότητα</th>
    <th>Περιφέρεια</th>
    <th>Περιφ. Ενότητα</th>
    <th>Ταχ. Διεύθυνση</th>
    <th>Κατηγορίες που επιθυμεί</th>
    <th>Αξιολογητής Α στον προηγούμενο διαγωνισμό</th>
    <th>Αξιολογητής σε περισσότερους από έναν διαγωνισμούς</th>
    <th>Θα ήθελα να συμμετάσχω και ως Αξιολογητής Β</th>
    <th>Ξένες Γλώσσες</th>
    <th>Ξένες Γλώσσες - Προτιμήσεις</th>
    <th>Άλλες Ξένες Γλώσσες</th>
    <th>Ιστότοπος που τον πρότεινε</th>
    <th>Email Ιστότοπου</th>
    <th>Κατηγορία Ιστότοπου</th>
    <th>Περιφέρεια Ιστότοπου</th>
    <th>Αυτοπροτάθηκε</th>
    <th>Αποδέχτηκε</th>
    <th>Δημιουργήθηκε</th>
    <th>Εμπειρία</th>
    <th>Προσωπικά URL</th>
    <th>Βιογραφικό</th>
    @if(Auth::user()->hasRole('admin'))
        <th>Μεταμφίεση</th>
    @endif
</tfoot>

</table>

@endsection
