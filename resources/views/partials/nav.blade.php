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
              {{ App\Config::first()->index }}ος ΔΕΕΙ
          </a>
      </div>

      <div class="collapse navbar-collapse" id="app-navbar-collapse">
          <!-- Left Side Of Navbar -->
          <ul class="nav navbar-nav">

              <li><a href="{{ route('home') }}">Αρχική Π.Σ</a></li>

              @if(Auth::check())

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
                          <i class="fa fa-user-secret" aria-hidden="true"></i> Διαχειριστικά <span class="caret"></span>
                      </a>

                      <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/admin/sites') }}">Υποψήφιοι</a></li>
                        <li><a href="{{ url('/admin/graders/a') }}">Αξιολογητές Α</a></li>
                        <li><a href="{{ url('/admin/graders/b') }}">Αξιολογητές Β</a></li>
                        <li><a href="{{ url('admin/handle-sites/1') }}">Πρωτοβάθμια</a></li>
                        <li><a href="{{ url('admin/handle-sites/3') }}">Δευτεροβάθμια</a></li>
                        <li><a href="{{ url('admin/handle-sites/6') }}">Προσωπικοί</a></li>
                      </ul>
                  </li>

                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                          <i class="fa fa-bar-chart" aria-hidden="true"></i> Στατιστικά <span class="caret"></span>
                      </a>

                      <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/statistics') }}">Υποψήφιοι</a></li>
                        <li><a href="{{ url('/grader-statistics/a') }}">Αξιολογητές Α</a></li>
                        <li><a href="{{ url('grader-statistics/b') }}">Αξιολογητές Β</a></li>
                        <li><a href="{{ url('submissions') }}">Υποβολές</a></li>
                      </ul>
                  </li>

                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Βαθμολογίες και Αναθέσεις <span class="caret"></span>
                    </a>

                      <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('sites_grades_c') }}">Φάση Γ</a></li>                      
                        <li><a href="{{ route('sites_grades_b') }}">Φάση Β</a></li> 
                        <li><a href="{{ route('sites_grades_a') }}">Φάση Α</a></li>                      
                      </ul>
                  </li>

                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Αποτελέσματα <span class="caret"></span>
                    </a>

                      <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('admin.final_list', 1) }}">Τελικά!</a></li>
                        <li><a href="{{ route('admin.axes_list', 1) }}">Άξονες</a></li>
                        <li><a href="{{ route('admin.c_list', 1) }}">Φάση Γ</a></li>
                        <li><a href="{{ route('admin.b_list', 1) }}">Φάση Β</a></li>                      
                        <li><a href="{{ route('admin.a_list', 1) }}">Φάση Α (με αποκλειόμενους)</a></li>
                        <li><a href="{{ route('admin.a_list_ok', 1) }}">Φάση Α (χωρίς αποκλειόμενους)</a></li>
                      </ul>
                  </li>

                @endif

                @if(Auth::user()->hasRole('ninja'))

                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                          Ninja <span class="caret"></span>
                      </a>

                      <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('ninja_menu') }}">emails</a></li>
                        <li><a href="{{ route('ninja.a_list', 1) }}">Φάση Α (με αποκλειόμενους)</a></li>
                      </ul>
                  </li>

                @endif                              

              @endif

                @if(Auth::check())
                  @if(!Auth::user()->hasRole('member') && !Auth::user()->hasRole('admin') && !Auth::user()->hasRole('ninja'))
                    <li><a href="{{ url('/statistics') }}">Στατιστικά</a></li>
                  @endif
                @else
                  <li><a href="{{ url('/statistics') }}"><i class="fa fa-bar-chart" aria-hidden="true"></i> Στατιστικά</a></li>
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
                        <li><a href="{{ url('/change-password') }}"><i class="fa fa-key" aria-hidden="true"></i> Αλλαγή Κωδικού Πρόσβασης</a></li>
                        <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> Αποσύνδεση</a></li>
                      </ul>
                  </li>
              @endif
          </ul>
      </div>
  </div>
</nav>
