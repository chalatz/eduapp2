@extends('layouts.admin')

@section('content')

@inject('specialties', 'App\Http\Utilities\Specialty')
@inject('districts', 'App\Http\Utilities\District')
@inject('counties', 'App\Http\Utilities\County')
@inject('categories', 'App\Http\Utilities\Category')
@inject('lang_levels', 'App\Http\Utilities\Lang_level')
@inject('xp', 'App\Http\Utilities\Teaching_xp')

<h1 class="bg-success" style="padding: .5em 1em; margin-bottom: 1.5em">
    Φάση Α - Αναθέσεις Ιστότοπου σε Αξιολογητές Α
</h1>
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Επωνυμία
                    </h3>
                </div>
                <div class="panel-body">
                    {{ $site->title }} - <a href="{{ $site->url }}" target="_blank">{{ $site->url }}</a>
                </div>
                <div class="panel-footer">
                    Κατηγορία: {{ $site->cat_id }}, Περιφέρεια: {{ $site->district_id }}, Κωδικός: {{ $site->id }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Δημιουγός Ιστότοπου (από τη δήλωση υποφηφιότητας)
                    </h3>
                </div>
                <div class="panel-body">
                    {{ $site->creator }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Αξιολογητής προτεινόμενος από τον Ιστότοπο
                    </h3>
                </div>
                <div class="panel-body">
                    {{ App\Grader::find($site->grader_id)->last_name }} {{ App\Grader::find($site->grader_id)->first_name }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Εδικότητα (από τη δήλωση του προτεινόμενου Αξιολογητή): ΠΕ60 - ΝΗΠΙΑΓΩΓΩΝ
                    </h3>
                </div>
                <div class="panel-body">
                    @if($site->cat_id == 6)
                        {{ $specialties::all()[$site->specialty_id] }}
                    @else
                        {{ $specialties::all()[App\Grader::find($site->grader_id)->specialty_id] }}
                    @endif
                    
                </div>
            </div>
        </div>
    </div>       

</div>



@endsection
