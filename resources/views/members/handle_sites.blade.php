@extends('layouts.admin')

@section('content')

@inject('specialties', 'App\Http\Utilities\Specialty')
@inject('districts', 'App\Http\Utilities\District')
@inject('categories', 'App\Http\Utilities\Category')
@inject('countries', 'App\Http\Utilities\Country')
@inject('languages', 'App\Http\Utilities\Language')
@inject('primary_schools', 'App\Http\Utilities\PrimaryEdu')
@inject('secondary_schools', 'App\Http\Utilities\SecondaryEdu')

<h1 class="bg-success" style="padding: .5em 1em; margin-bottom: 1.5em">
    Υποψήφιοι Ιστότοποι - <span style="font-size: .6em">{{ $categories::all()[$cat_id] }}</span>
</h1>

<table id="sites-table" class="table table-striped admin-table">

  <thead>
    <tr>
      <th></th>
      <th></th>
      <th>Κωδικός</th>
      <th>Επωνυμία</th>
      <th>URL</th>
      <th>Δημιουργός/οί</th>
    </tr>
  </thead>

  <tbody>
    @foreach($sites as $site)

      @if($site->user->hasRole('site'))

        <tr>
          <form class="handle-sites-form" id="{{ $site->id }}" action="handle-sites">
            <td>
              {{ Form::token() }}
              @if($cat_id == 6 )
                {{ Form::select('specialty_id-'.$site->id, $specialties::all(), isset($site->specialty_id) ? $site->specialty_id : null, ['class' => 'form-control', 'id' => 'specialty_id-'.$site->id]) }}
              @endif
              @if($cat_id == 1 )
                {{ Form::select('primary_edu_id-'.$site->id, $primary_schools::all(), isset($site->primary_edu_id) ? $site->primary_edu_id : null, ['class' => 'form-control', 'id' => 'primary_edu_id-'.$site->id]) }}
              @endif
              @if($cat_id == 3 )
                {{ Form::select('secondary_edu_id-'.$site->id, $secondary_schools::all(), isset($site->secondary_edu_id) ? $site->secondary_edu_id : null, ['class' => 'form-control', 'id' => 'secondary_edu_id-'.$site->id]) }}
              @endif         
            </td>
            <td>
              {{ Form::button('Αποθήκευση', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
              <span id="site-ok-{{ $site->id }}" class="label label-success"></span>
            </td>
          </form>
          <td>i{{ sprintf("%03d", $site->id) }}</td>
          <td>{{ $site->title }}</td>
          <td><a href="{{ $site->url }}" target="_blank">{{ $site->url }}</a></td>
          <td>{{ $site->creator }}</td>
        </tr>

      @endif

    @endforeach
  </tbody>

  <tfoot>
    <th></th>
    <th></th>
    <th>Κωδικός</th>
    <th>Επωνυμία</th>
    <th>URL</th>
    <th>Δημιουργός/οί</th>
</tfoot>

</table>

<script>
  var handle_sites_post_url = '{{ route("admin.post_handle_sites") }}';
  var token = '{{ csrf_token() }}';
  var handle_sites_cat__id = '{{ $cat_id }}';
</script>

@endsection
