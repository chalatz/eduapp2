@extends('layouts.admin')

@section('content')
<div class="container">
    
    <div class="row">
    
        <a data-district="1" href="{{ route('ajax_url', 1) }}" data-remote="false" data-toggle="modal" data-target="#ajax-modal" id="ajax-btn">Ajax Me!</a>

        <div id="ajax-data">
        
        </div>

    </div>


    <div class="row">
        <!-- Link trigger modal -->
        <a href="/ajax-url" data-remote="false" data-toggle="modal" data-target="#myModal" class="btn btn-default">
            Launch Modal
        </a>
    </div>

    <!-- Default bootstrap modal example -->
    <div class="modal fade" id="ajax-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
        </div>
        <div class="modal-body">
            ...
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Κλείσιμο</button>
        </div>
        </div>
    </div>
    </div>



</div>

@endsection
