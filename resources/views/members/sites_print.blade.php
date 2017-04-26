@extends('layouts.bare')

@section('content')

@inject('specialties', 'App\Http\Utilities\Specialty')
@inject('districts', 'App\Http\Utilities\District')
@inject('categories', 'App\Http\Utilities\Category')
@inject('countries', 'App\Http\Utilities\Country')
@inject('languages', 'App\Http\Utilities\Language')

<table class="table table-striped admin-table">

  <thead>
    <tr>
      <th>Κωδικός</th>
      <th>Επωνυμία</th>
      <th>URL</th>
      <th>Κατηγορία</th>
      <th>Δημιουργός/οί</th>
      <th>Νομικά υπεύθυνος</th>
      <th>Ιδιότητα Νομικά υπεύθυνου</th>
      <th>Περιφέρεια</th>
      <th>Χώρα</th>
      <th>Γλώσσα</th>
      <th>Προσωπικά Δεδομένα</th>
      <th>Έχει λάβει άδεια;</th>
      <th>Περιορισμένη Πρόσβαση</th>
      <th>Λεπτομέρειες Εισόδου</th>
      <th>Επώνυμο Υπεύθυνου επικοινωνίας</th>
      <th>Όνομα Υπεύθυνου επικοινωνίας</th>
      <th>Email Επικοινωνίας</th>
      <th>Τηλέφωνα</th>
      <th>Ταχ. Διεύθυνση</th>
      <th>Αυτοπροτείνεται</th>
      <th>Δημιουργήθηκε</th>
    </tr>
  </thead>

  <tbody>
    @foreach($sites as $site)

      @if($site->user->hasRole('site'))

        <tr>
          <td>i{{ sprintf("%03d", $site->id) }}</td>
          <td>{{ $site->title }}</td>
          <td><a href="{{ $site->url }}" target="_blank">{{ $site->url }}</a></td>
          <td>{{ $categories::all()[$site->cat_id] }}</td>
          <td>{{ $site->creator }}</td>
          <td>{{ $site->responsible }}</td>
          <td>{{ $site->responsible_type }}</td>
          <td>{{ $districts::all()[$site->district_id] }}</td>
          <td>{{ $countries::all()[$site->country_id] }}</td>
          <td>{{ $languages::all()[$site->language_id] }}</td>
          <td>{{ $site->uses_private_data }}</td>
          <td>{{ $site->received_permission }}</td>
          <td>{{ $site->restricted_access }}</td>
          <td>{{ $site->restricted_access_details }}</td>
          <td>{{ $site->contact_last_name }}</td>
          <td>{{ $site->contact_first_name }}</td>
          <td>{{ $site->contact_email }}</td>
          <td>{{ $site->contact_phone }}</td>
          <td>{{ $site->contact_address }}</td>
          <td>{{ $site->user->suggestion->self_proposed }}</td>
          <td>{{ date('d / m / Y', strtotime($site->created_at)) }}</td>
        </tr>

      @endif

    @endforeach
  </tbody>

</table>

@endsection
