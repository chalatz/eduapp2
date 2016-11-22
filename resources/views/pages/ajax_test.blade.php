@extends('layouts.admin')

@section('content')
<div class="container">
    
    <div class="row">

    
    
        <a data-district="11" href="{{ route('ajax_url', 11) }}" id="ajax-btn">Ajax Me!</a>

        <div id="ajax-data">
        
        </div>

    </div>   

</div>

@endsection
