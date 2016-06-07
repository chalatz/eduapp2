@extends('layouts.admin')

@section('content')

@inject('specialties', 'App\Http\Utilities\Specialty')
@inject('districts', 'App\Http\Utilities\District')
@inject('categories', 'App\Http\Utilities\Category')
@inject('lang_levels', 'App\Http\Utilities\Lang_level')

<table id="graders-table" class="table table-striped admin-table">

  <thead>
    <tr>
      <th>Κωδικός</th>
      <th>Eπώνυμο</th>
      <th>Όνομα</th>
      <th>Email</th>
      <th>Τηλ. Ιστότοπου που τον πρότεινε</th>
      <th>Ειδικότητα</th>
      <th>Περιφέρεια</th>
      <th>Ταχ. Διεύθυνση</th>
      <th>Κατηγορίες που επιθυμεί</th>
      <th>Αξιολογητής Α στον προηγούμενο διαγωνισμό</th>
      <th>Αξιολογητής σε περισσότερους από έναν διαγωνισμούς</th>
      <th>Θα ήθελα να συμμετάσχω και ως Αξιολογητής Β</th>
      <th>Ξένες Γλώσσες</th>
      <th>Άλλες Ξένες Γλώσσες</th>
      <th>Ιστότοπος που τον πρότεινε</th>
      <th>Email Ιστότοπου</th>
      <th>Κατηγορία Ιστότοπου</th>
      <th>Περιφέρεια Ιστότοπου</th>
      <th>Αυτοπροτάθηκε</th>
      <th>Αποδέχτηκε</th>
      <th>Δημιουργήθηκε</th>
      @if(Auth::user()->hasRole('ninja'))
          <th>Μεταμφίεση</th>
      @endif

    </tr>
  </thead>

  <tbody>
    @foreach($graders as $grader)

      @if($grader->user->hasRole('grader_a'))

        <tr>
          <td>{{ $grader->id }}</td>
          <td>{{ $grader->last_name }}</td>
          <td>{{ $grader->first_name }}</td>
          <td>{{ $grader->user->email }}</td>
          <td>TODO</td>
          <td>{{ $specialties::all()[$grader->specialty_id] }}</td>
          <td>{{ $districts::all()[$grader->district_id] }}</td>
          <td>{{ $grader->address }}</td>
          <td>{{ $grader->desired_category }}</td>
          <td>{{ $grader->past_grader }}</td>
          <td>{{ $grader->past_grader_more }}</td>
          <td>{{ $grader->wants_to_be_grader_b }}</td>
          <td>
            @include('partials.languages')
          </td>
          <td>{{ $grader->languages_other }} {{ $grader->languages_other_level }}</td>
          <td>TODO</td>
          <td>{{ $grader->user->suggestion->suggestor_email }}</td>
          <td>TODO</td>
          <td>TODO</td>
          <td>{{ $grader->user->suggestion->self_proposed }}</td>
          <td>{{ $grader->user->suggestion->accepted }}</td>
          <td>{{ date('d / m / Y', strtotime($grader->created_at)) }}</td>
          @if(Auth::user()->hasRole('ninja'))
              <td>{{ link_to('/admin/masquerade/'.$grader->user_id, 'Μεταμφίεση') }}  </td>
          @endif

        </tr>

      @endif

    @endforeach
  </tbody>

  <tfoot>
    <th>Κωδικός</th>
    <th>Eπώνυμο</th>
    <th>Όνομα</th>
    <th>Email</th>
    <th>Τηλ. Ιστότοπου που τον πρότεινε</th>
    <th>Ειδικότητα</th>
    <th>Περιφέρεια</th>
    <th>Ταχ. Διεύθυνση</th>
    <th>Κατηγορίες που επιθυμεί</th>
    <th>Αξιολογητής Α στον προηγούμενο διαγωνισμό</th>
    <th>Αξιολογητής σε περισσότερους από έναν διαγωνισμούς</th>
    <th>Θα ήθελα να συμμετάσχω και ως Αξιολογητής Β</th>
    <th>Ξένες Γλώσσες</th>
    <th>Άλλες Ξένες Γλώσσες</th>
    <th>Ιστότοπος που τον πρότεινε</th>
    <th>Email Ιστότοπου</th>
    <th>Κατηγορία Ιστότοπου</th>
    <th>Περιφέρεια Ιστότοπου</th>
    <th>Αυτοπροτάθηκε</th>
    <th>Αποδέχτηκε</th>
    <th>Δημιουργήθηκε</th>
</tfoot>

</table>

@endsection
