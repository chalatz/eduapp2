@extends('layouts.admin')

@section('content')

@inject('specialties', 'App\Http\Utilities\Specialty')
@inject('districts', 'App\Http\Utilities\District')
@inject('counties', 'App\Http\Utilities\County')
@inject('categories', 'App\Http\Utilities\Category')
@inject('lang_levels', 'App\Http\Utilities\Lang_level')
@inject('xp', 'App\Http\Utilities\Teaching_xp')

<h1 class="bg-primary" style="padding: .5em 1em; margin-bottom: 1.5em">Αναθέσεις Α</h1>

<table id="assignments-table" class="table table-striped admin-table">

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
                {{ $site->title }}<br>
                <a href="{{ $site->url }}" target="_blank">{{ $site->url }}</a>
            </td>

            @if(App\Assignment::where('site_id', $site->id)->count() > 0)
                @foreach(App\Assignment::where('site_id', $site->id)->get() as $assignment)
                    <td>{{ App\Grader::find($assignment->grader_id)->last_name }} {{ App\Grader::find($assignment->grader_id)->first_name }}</td>
                @endforeach
            @else
                <td>not assigned</td>
                <td>not assigned</td>
            @endif

            <td>
                {{ App\Assignment::where('site_id', $site->id)->count() }}
            </td>


        
        </tr>

    @endforeach
  </tbody>

  <tfoot>
    
</tfoot>

</table>

@endsection
