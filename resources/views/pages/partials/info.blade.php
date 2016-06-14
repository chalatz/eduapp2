<p>
  <strong>Καλώς ορίσατε!</strong>
</p>

<p>
  Έχετε συνδεθεί ως <strong>{{ Auth::user()->email }}</strong>
</p>

<p>
  και είστε:
</p>

<ul>
  @if(Auth::user()->hasRole('user'))
    <li><strong>Χρήστης</strong></li>
  @endif
  @if(Auth::user()->hasRole('site'))
    <li><strong>Υποψήφιος Ιστότοπος</strong></li>
  @endif
  @if(Auth::user()->hasRole('grader_a'))
    <li><strong>Αξιολογητής Α</strong></li>
  @endif
  @if(Auth::user()->hasRole('grader_b'))
    <li><strong>Αξιολογητής Β</strong></li>
  @endif
  @if(Auth::user()->hasRole('member'))
    <li><strong>Μέλος Επιτροπής</strong></li>
  @endif
  @if(Auth::user()->hasRole('admin'))
    <li><strong>Διαχειριστής</strong></li>
  @endif
  @if(Auth::user()->hasRole('ninja'))
    <li><strong>Ninja</strong></li>
  @endif
</ul>
