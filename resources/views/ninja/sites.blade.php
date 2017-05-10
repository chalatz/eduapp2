@extends('layouts.bare')

@section('content')

@inject('districts', 'App\Http\Utilities\District')
@inject('categories', 'App\Http\Utilities\Category')

'Κωδικός', 'Ονομασία', 'URL', 'Κατηγορία', 'Περιφέρεια', 'Δημιουργοί'<br>

@foreach($sites as $site)

    'i{{ sprintf("%03d", $site->id) }}',
    '{{ $site->title }}',
    '{{ $site->url }}',
    '{{ $site->cat_id }}',
    '{{ $districts::all()[$site->district_id] }}',
    '{{ $site->creator }}'<br>

@endforeach

@endsection