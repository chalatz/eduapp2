<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Edu Web Awards 2017 - Πληροφοριακό Σύστημα</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    {{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
</head>

<body id="app-layout">

    @include('partials.nav')

    <div class="container">
        <h2>Πληροφοριακό Σύστημα 8ου Διαγωνισμού Ελληνόφωνων Εκπαιδευτικών Ιστότοπων</h2>
        <hr>
    </div>

    @include('partials/check_verification')

    <div class="container">
        @include('flash::message')
    </div>

    @if(isset($errors) && $errors->count() > 0)
        <div class="container">
            <div class="alert alert-danger" role="alert">
                <strong>Υπάρχουν κάποια προβλήματα με την υποβολή της φόρμας. Παρακαλούμε δείτε τα παρακάτω.</strong>
            </div>
        </div>
    @endif

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="{{ URL::asset('js/parsley.min.js') }}"></script>
    
    <script src="{{ URL::asset('js/sweetalert.js') }}"></script>
    @include('sweet::alert')
    <script type="text/javascript" src="https://cdn.datatables.net/u/bs-3.3.6/jq-2.2.3,dt-1.10.12/datatables.min.js"></script>
    <script src="{{ URL::asset('js/scripts.js') }}"></script>
</body>
</html>
