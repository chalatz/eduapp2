@extends('layouts.admin')

@section('content')

@inject('specialties', 'App\Http\Utilities\Specialty')
@inject('districts', 'App\Http\Utilities\District')
@inject('categories', 'App\Http\Utilities\Category')
@inject('lang_levels', 'App\Http\Utilities\Lang_level')

<h1 class="bg-info" style="padding: .5em 1em; margin-bottom: 1.5em">Αξιολογητές Β</h1>

<table id="graders-table" class="table table-striped admin-table">

  <thead>
    <tr>
      @if(Auth::user()->hasRole('ninja'))
        <th>Μεταμφίεση</th>
      @endif
      <th>Έγκριση</th>
      <th>Κωδικός</th>
      <th>Eπώνυμο</th>
      <th>Όνομα</th>
      <th>Email</th>
      <th>Ειδικότητα</th>
      <th>Περιφέρεια</th>
      <th>Ταχ. Διεύθυνση</th>
      <th>Κατηγορίες που επιθυμεί</th>
      <th>Αξιολογητής Α στον προηγούμενο διαγωνισμό</th>
      <th>Αξιολογητής σε περισσότερους από έναν διαγωνισμούς</th>
      <th>Ξένες Γλώσσες</th>
      <th>Άλλες Ξένες Γλώσσες</th>
      <th>Δημιουργήθηκε</th>
      @if(Auth::user()->hasRole('ninja'))
          <th>Μεταμφίεση</th>
      @endif

    </tr>
  </thead>

  <tbody>
    @foreach($graders as $grader)

      @if($grader->user->hasRole('grader_b'))

        <tr>
          @if(Auth::user()->hasRole('ninja'))
            <td>{{ link_to('/admin/masquerade/'.$grader->user_id, 'Μεταμφίεση') }}</td>
          @endif
          <td>
            @if($grader->approved)
              Έχει Εγκριθεί από: <em>{{$grader->approver_email}}</em>
            @else
              <a href="{{ route('members.approve', $grader->id) }}">Εγκρίνω</a>
            @endif
          </td>
          <td>{{ $grader->code() }}</td>
          <td>{{ $grader->last_name }}</td>
          <td>{{ $grader->first_name }}</td>
          <td>{{ $grader->user->email }}</td>
          <td>{{ $specialties::all()[$grader->specialty_id] }}</td>
          <td>{{ $districts::all()[$grader->district_id] }}</td>
          <td>{{ $grader->address }}</td>
          <td>{{ $grader->desired_category }}</td>
          <td>{{ $grader->past_grader }}</td>
          <td>{{ $grader->past_grader_more }}</td>
          <td>
            @include('partials.languages')
          </td>
          <td>{{ $grader->languages_other }} {{ $grader->languages_other_level }}</td>                  
          <td>{{ date('d / m / Y', strtotime($grader->created_at)) }}</td>
          @if(Auth::user()->hasRole('ninja'))
              <td>{{ link_to('/admin/masquerade/'.$grader->user_id, 'Μεταμφίεση') }}</td>
          @endif

        </tr>

      @endif

    @endforeach
  </tbody>

  <tfoot>
    @if(Auth::user()->hasRole('ninja'))
        <th></th>
    @endif
    <th></th>
    <th>Κωδικός</th>
    <th>Eπώνυμο</th>
    <th>Όνομα</th>
    <th>Email</th>
    <th>Ειδικότητα</th>
    <th>Περιφέρεια</th>
    <th>Ταχ. Διεύθυνση</th>
    <th>Κατηγορίες που επιθυμεί</th>
    <th>Αξιολογητής Α στον προηγούμενο διαγωνισμό</th>
    <th>Αξιολογητής σε περισσότερους από έναν διαγωνισμούς</th>
    <th>Ξένες Γλώσσες</th>
    <th>Άλλες Ξένες Γλώσσες</th>
    <th>Δημιουργήθηκε</th>
</tfoot>

</table>

@endsection
