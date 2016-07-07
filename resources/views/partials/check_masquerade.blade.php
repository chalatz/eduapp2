@if(Session::has('ninja_id'))

    <div class="container">
        <div class="alert alert-info" role="alert">
            <p>Αυτή τη στιγμή είστε <em>μεταμφιεσμένος</em>. Παρακαλούμε, <strong>Εργαστείτε Υπεύθυνα.</strong></p>
            <p><i class="fa fa-undo"></i> <a href="{{ route('admin.switch_back') }}">Επιστροφή ως Διαχειριστής</a></p>
        </div>
    </div>

@endif
