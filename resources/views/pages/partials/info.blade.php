<p>
  <strong>Καλώς ορίσατε!</strong>
</p>

<p>
  Έχετε συνδεθεί ως <strong><a href="{{ route('user.account_actions') }}">{{ Auth::user()->email }}</a></strong>
</p>

<p>
  και είστε:
</p>

<ul>
  @if(Auth::user()->hasRole('user'))
    <li><strong>Χρήστης</strong></li>
  @endif
  @if(Auth::user()->hasRole('site'))
    <li>
      <strong><a href="{{ route('sites.edit', ['sites' => Auth::user()->site->id]) }}">Υποψήφιος Ιστότοπος</a></strong>
    </li>
  @endif
  @if(Auth::user()->hasRole('grader_a'))
    <li>
      <strong><a href="{{ route('graders.edit', ['sites' => Auth::user()->grader->id]) }}">Αξιολογητής Α</a></strong>
    </li>
  @endif
  @if(Auth::user()->hasRole('grader_b'))
    <li>
      <strong><a href="{{ route('graders.edit_b', ['sites' => Auth::user()->grader->id]) }}">Αξιολογητής Β</a></strong>
    </li>
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
