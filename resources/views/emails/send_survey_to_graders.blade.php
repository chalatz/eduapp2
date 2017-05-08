@extends('layouts.email')

@section('content')

    <h3>ΕΡΩΤΗΜΑΤΟΛΟΓΙΟ - ΒΑΘΜΟΛΟΓΙΕΣ - ΒΕΒΑΙΩΣΕΙΣ ΣΥΜΜΕΤΟΧΗΣ {{ App\Config::first()->index }}ου ΔΕΕΙ</h3>

    <p>
        Αγαπητοί και αγαπητές <strong>Αξιολογητές</strong>,
    </p>

    <p>
        Ευχαριστούμε για τη συμμετοχή σας στο διαγωνισμό, την εμπιστοσύνη που μας δείξατε και την αρωγή σας στην αξιολόγηση.
    </p>

    <p>
        Για την επιτυχή ολοκλήρωση του Διαγωνισμού είναι ιδιαίτερα σημαντική η ανατροφοδότηση που θα μας δώσετε, απαντώντας με ειλικρίνεια στο <a href="https://goo.gl/forms/SYiQYVIpyhxEgENL2">ερωτηματολόγιο</a> του {{ App\Config::first()->index }}ου ΔΕΕΙ (<a href="https://goo.gl/forms/SYiQYVIpyhxEgENL2">https://goo.gl/forms/SYiQYVIpyhxEgENL2</a>), μέχρι την Πέμπτη 18/5/2017.
    </p>

    <p>
        Θα χρειαστεί να αφιερώσετε δέκα λεπτά και αν το επιθυμείτε μπορείτε να υποβάλετε προτάσεις για τη βελτίωσή του, σε όλα τα θέματα, όπως: όροι συμμετοχής, διαδικασία αξιολόγησης, άξονες – κριτήρια και διαβάθμιση αυτών.
    </p>

    <p>
        <span style="text-decoration: underline">ΠΡΟΚΕΙΜΕΝΟΥ ΝΑ</span>
        <ul>
            <li>δείτε τη βαθμολογία σας εφόσον είστε υποψήφιος</li>
            <li>δείτε τις βαθμολογίες των άλλων Αξιολογητών των Ιστότοπων που τυχόν έχετε αξιολογήσει</li>
            <li>κατεβάσετε τις βεβαιώσεις συμμετοχής σας</li>
        </ul>
        ΘΑ ΠΡΕΠΕΙ ΠΡΩΤΑ ΝΑ ΣΥΜΠΛΗΡΩΣΕΤΕ ΤΟ <a href="https://goo.gl/forms/SYiQYVIpyhxEgENL2" target="_blank">ερωτηματολόγιο</a> στη διεύθυνση <a href="https://goo.gl/forms/SYiQYVIpyhxEgENL2" target="_blank">https://goo.gl/forms/SYiQYVIpyhxEgENL2</a>
    </p>
    <p>
        Μετά την υποβολή του ερωτηματολογίου, <span class="highlighter">θα σας δωθεί ένα κλειδί</span>, <strong>το οποίο θα πρέπει να αποθηκεύσετε!</strong> Στη συνέχεια, αφού συνδεθείτε στο Πληροφοριακό Σύστημα του διαγωνισμού (<a href="http://www.eduwebawards.gr/app2/public/">http://www.eduwebawards.gr/app2/public/</a>) θα υποβάλλετε το κλειδί αυτό και θα πατήσετε <strong>Επιβεβαίωση Κλειδιού</strong>.
    </p>

    <p>
        Σας ενημερώνουμε ότι την Κυριακή, 30 Απριλίου 2017, στη Σύρο, στο πλαίσιο του 9ου Πανελλήνιου Συνεδρίου των Εκπαιδευτικών για τις ΤΠΕ «Αξιοποίηση των Τεχνολογιών της Πληροφορίας και της Επικοινωνίας στη Διδακτική Πράξη», έγινε η τελετή της απονομής των βραβείων των διακριθέντων ιστότοπων.
    </p>

    <p>
        <strong>Τα τελικά αποτελέσματα και τα βραβεία  του {{ App\Config::first()->index }}ου ΔΕΕΙ, είναι αναρτημένα στον επίσημο ιστότοπο του Διαγωνισμού, <a href="http://www.eduwebawards.gr">http://www.eduwebawards.gr</strong></a>
    </p>

@endsection