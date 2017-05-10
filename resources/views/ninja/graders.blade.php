@extends('layouts.bare')

@section('content')

@inject('districts', 'App\Http\Utilities\District')
@inject('specialties', 'App\Http\Utilities\Specialty')

'Κωδικός', 'Ονοματεπώνυμο', 'Επίθετο', 'Όνομα', 'Περιφέρεια', 'Ειδικότητα'<br>

@foreach($graders as $grader)
    @if($grader->has_graded())

        'i{{ $grader->code() }}',
        '{{ $grader->last_name }} {{ $grader->first_name }}',
        '{{ $grader->last_name }}',
        '{{ $grader->first_name }}',
        '{{ $districts::all()[$grader->district_id] }}',
        '{{ $specialties::all()[$grader->specialty_id] }}'<br>
        
    @endif

@endforeach

@endsection