@extends('layouts.admin')

@section('content')

@inject('specialties', 'App\Http\Utilities\Specialty')
@inject('districts', 'App\Http\Utilities\District')
@inject('counties', 'App\Http\Utilities\County')
@inject('categories', 'App\Http\Utilities\Category')
@inject('lang_levels', 'App\Http\Utilities\Lang_level')
@inject('xp', 'App\Http\Utilities\Teaching_xp')

<h1 class="bg-primary" style="padding: .5em 1em; margin-bottom: 1.5em">Αναθέσεις Α - Ιστότοποι</h1>

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
                <p>{{ $site->title }}</p>
                <p><a href="{{ $site->url }}" target="_blank">{{ $site->url }}</a></p>
                <p><strong>Κατηγορία: </strong>{{ $site->cat_id }}</p>
                <p><strong>Περιφέρεια: </strong>{{ $site->district_id }}</p>
                @if($site->cat_id == 6 && $site->specialty_id > 0)
                    <p><strong>Ειδικότητα: </strong>{{ $specialties::all()[$site->specialty_id] }}</p>
                @endif
            </td>

            @if(App\Assignment::where('site_id', $site->id)->count() > 0)
                @foreach(App\Assignment::where('site_id', $site->id)->get() as $assignment)
                <?php $grader = App\Grader::find($assignment->grader_id); ?>
                    <td @if($site->district_id != $grader->district_id) style="background-color: lightgreen" @else style="background-color: lightcoral" @endif >
                        <p>{{ $grader->last_name }} {{ $grader->first_name }}</p>
                        <p><strong>Κατηγορία: </strong>{{ $grader->sites->first()->cat_id }}</p>
                        <p><strong>Περιφέρεια: </strong>{{ $grader->district_id }}</p>
                        <p><strong>Ειδικότητα: </strong>{{ $grader->specialty_id }}</p>
                    </td>
                @endforeach
            @else
                <td>Χωρίς ανάθεση</td>
                <td>Χωρίς ανάθεση</td>
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
