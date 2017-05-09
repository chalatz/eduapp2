@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
        
            <h2>Βεβαιώσεις Συμμετοχής</h2>

            <table class="table table-striped">
                @if(in_array('site', $type))
                    <tr>
                        <td>
                            <strong><a href="{{ route('make_certificate', 'site') }}">
                                <i class="fa fa-download" aria-hidden="true"></i> Βεβαίωση Συμμετοχής Ιστότοπου
                            </a></strong>
                        </td>
                        <td>
                            Εάν δεν είναι σωστή η ονομασία του Ιστοτόπου σας, μπορείτε να την αλλάξετε <a href="{{ route('sites.edit', ['sites' => Auth::user()->site->id]) }}">στην καρτέλα του Υποψηφίου Ιστότοπου</a>, στο πεδίο Τίτλος Ιστότοπου, να πατήσετε Αποθήκευση και να επιστρέψετε εδώ.
                        </td>
                    </tr>
                @endif

                @if(in_array('grader', $type))
                    <tr>
                        <td>
                            <strong><a href="{{ route('make_certificate', 'grader') }}">
                                <i class="fa fa-download" aria-hidden="true"></i> Βεβαίωση Συμμετοχής Αξιολογητή/τριας
                            </a></strong>
                        </td>
                        <td>
                            Εάν δεν είναι σωστό το ονοματεπώνυμό σας, μπορείτε να το διορθώσετε 
                            @if(Auth::user()->hasRole('grader_a'))
                                <a href="{{ route('graders.edit', ['sites' => Auth::user()->grader->id]) }}">
                                    στην καρτέλα του Αξιολογητή 
                                </a>, 
                            @else
                                <a href="{{ route('graders.edit_b', ['sites' => Auth::user()->grader->id]) }}">
                                    στην καρτέλα του Αξιολογητή
                                </a>, 
                            @endif
                            στα πεδία Επώνυμο και Όνομα, να πατήσετε Αποθήκευση και να επιστρέψετε εδώ.
                        </td>
                    </tr>
                @endif

                @if(in_array('member', $type))
                    <tr>
                        <td>
                            <strong><a href="{{ route('make_certificate', 'member') }}">
                                <i class="fa fa-download" aria-hidden="true"></i> Βεβαίωση Μέλους Επιτροπής
                            </a></strong>
                        </td>
                        <td>
                            Εάν δεν είναι σωστό το ονοματεπώνυμό σας, μπορείτε να το διορθώσετε <a href="{{ route('graders.edit_b', ['sites' => Auth::user()->grader->id]) }}">στην καρτέλα του Αξιολογητή</a>, στα πεδία Επώνυμο και Όνομα, να πατήσετε Αποθήκευση και να επιστρέψετε εδώ.
                        </td>
                    </tr>
                @endif                

            </table>

            <p class="lead bg-primary box">
                Οι βεβαιώσεις των βραβευμένων Ιστότοπων, τα δώρα, οι Έπαινοι και οι Ειδικοί Έπαινοι, θα αποσταλλούν ηλεκτρονικά / ταχυδρομικά.
            </p>

        </div>
    </div>
</div>
@endsection
