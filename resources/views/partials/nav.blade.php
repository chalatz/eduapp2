<nav class="navbar navbar-default">
  <div class="container">
      <div class="navbar-header">

          <!-- Collapsed Hamburger -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
              <span class="sr-only">Toggle Navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>

          <!-- Branding Image -->
          <a class="navbar-brand" href="http://2017.eduwebawards.gr/" target="_blank">
              8ος ΔΕΕΙ
          </a>
      </div>

      <div class="collapse navbar-collapse" id="app-navbar-collapse">
          <!-- Left Side Of Navbar -->
          <ul class="nav navbar-nav">

              <li><a href="{{ route('home') }}">Αρχική</a></li>

              @if(Auth::check())

                @if(Auth::user()->hasRole('member'))
                  <li>
                    <a href="{{ route('statitics') }}"><i class="fa fa-bar-chart" aria-hidden="true"></i> Στατιστικά</a>
                  </li>
                @endif

                @if(Auth::user()->site)
                  <li>
                    <a href="{{ route('sites.edit', ['sites' => Auth::user()->site->id]) }}">
                      Υποψηφιότητα
                    </a>
                  </li>
                @endif

                @if(Auth::user()->grader && Auth::user()->hasRole('grader_a'))
                  <li>
                    <a href="{{ route('graders.edit', ['sites' => Auth::user()->grader->id]) }}">
                      Αξιολογητής Α
                    </a>
                  </li>
                @endif

                @if(Auth::user()->grader && Auth::user()->hasRole('grader_b'))
                  <li>
                    <a href="{{ route('graders.edit_b', ['sites' => Auth::user()->grader->id]) }}">
                      Αξιολογητής Β
                    </a>
                  </li>
                @endif

                @if(Auth::user()->hasRole('member'))
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                          Διαχειριστικά <span class="caret"></span>
                      </a>

                      <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/admin/sites') }}">Υποψήφιοι</a></li>
                        <li><a href="{{ url('/admin/graders/a') }}">Αξιολογητές Α</a></li>
                        <li><a href="{{ url('/admin/graders/b') }}">Αξιολογητές Β</a></li>
                      </ul>
                  </li>
                @endif

              @endif

          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="nav navbar-nav navbar-right">
              <!-- Authentication Links -->
              @if (Auth::guest())
                  <li><a href="{{ url('/login') }}"><i class="fa fa-btn fa-sign-in"></i> Σύνδεση</a></li>
                  <li><a href="{{ url('/register') }}"><i class="fa fa-btn fa-user-plus"></i> Εγγραφή</a></li>
              @else
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                          {{ Auth::user()->email }} <span class="caret"></span>
                      </a>

                      <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/change-password') }}">Αλλαγή Κωδικού Πρόσβασης</a></li>
                        <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Αποσύνδεση</a></li>
                      </ul>
                  </li>
              @endif
          </ul>
      </div>
  </div>
</nav>
