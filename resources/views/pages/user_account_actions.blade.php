@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Ο Λογαριασμός Μου - {{ Auth::user()->email }}</h4></div>
                <div class="panel-body">

                    <div class="row col-md-8 col-md-offset-2">
                        <a href="{{ url('/change-password') }}"><i class="fa fa-key" aria-hidden="true"></i> Αλλαγή Κωδικού Πρόσβασης</a>
                    </div>

                    <div class="row col-md-8 col-md-offset-2">
                        <a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> Αποσύνδεση</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
