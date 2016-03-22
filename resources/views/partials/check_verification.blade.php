@if(Auth::check() && !Auth::user()->verified)
    <div class="container">
      <div class="row">
          <div class="alert alert-danger">
              Δεν έχετε επιβεβαιώσει το email σας. Παρακαλούμε ελέγξτε τα εισερχόμενα του ηλεκτρονικού ταχυδρομείου σας ({{ Auth::user()->email }}).
          </div>
          <a href="{{ route('user.send_verification') }}" type="button" class="btn btn-warning btn-block">Αποστολή νέου email επιβεβαίωσης</a>
      </div>
    </div>
@endif
