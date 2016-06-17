@extends('layouts.bare')

@section('content')

@inject('specialties', 'App\Http\Utilities\Specialty')
@inject('districts', 'App\Http\Utilities\District')
@inject('categories', 'App\Http\Utilities\Category')
@inject('lang_levels', 'App\Http\Utilities\Lang_level')

<table class="table table-striped admin-table">

  <thead>
    <tr>
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
      <th>Γιατί αυτοπροτείνεται</th>
      <th>Δημιουργήθηκε</th>
    </tr>
  </thead>

  <tbody>
    @foreach($graders as $grader)

      @if($grader->user->hasRole('grader_b'))

        <tr>
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
          <td>{!! nl2br(e($grader->why_propose_myself)) !!}</td>
          <td>{{ date('d / m / Y', strtotime($grader->created_at)) }}</td>
        </tr>

      @endif

    @endforeach
  </tbody>

</table>

@endsection
