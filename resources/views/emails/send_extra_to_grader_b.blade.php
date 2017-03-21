@extends('layouts.email')

@section('content')

    <h3>ΦΑΣΗ Β - ΑΝΑΘΕΣΗ ΙΣΤΟΤΟΠΩΝ ΣΕ ΑΞΙΟΛΟΓΗΤΗ Β {{ App\Config::first()->index }}ου ΔΕΕΙ</h3>

    <h3>ΝΕΑ ΑΝΑΘΕΣΗ ΓΙΑ ΚΡΙΣΗ</h3>

    <p>
        Αγαπητέ/ή <strong>{{ $data['grader_name'] }}</strong>,
    </p>

    <p>
        Σας έχουμε αναθέσει <strong>έναν νέο Ιστότοπο<strong> για να αξιολογήσετε, με τα εξής στοιχεία
    </p>

    <p>
        Τίτλος Ιστότοπου: <strong>{{ $data['site_title'] }}</strong><br>
        URL Ιστότοπου: <strong><a href="{{ $data['site_url'] }}">{{ $data['site_url'] }}</a></strong>
    </p>

    <p>
        Σας παρακαλούμε να αποδεχτείτε την πρόσκλησή μας να αξιολογήσετε τον ιστότοπο που σας έχει ανατεθεί.
    </p>

    <p>
        Παρακαλούμε συνδεθείτε στο πληροφοριακό σύστημα του {{ App\Config::first()->index }}ου ΔΕΕΙ (<a href="http://www.eduwebawards.gr/app2/public/">http://www.eduwebawards.gr/app2/public/</a>) και πατήστε <strong>Έναρξη Αξιολόγησης.</strong>
    </p>

    <p>
        Μετά από την κρίση σας σε κάθε κριτήριο-άξονα, πατήστε «ΑΠΟΘΗΚΕΥΣΗ». Εάν είστε σίγουρος ότι έχετε ολοκληρώσει, μπορείτε να πατήσετε “Οριστική Υποβολή Βαθμολογίας”. Αυτή η ενέργεια δεν είναι απαραίτητη, αρκεί βέβαια να έχετε βαθμολογήσει όλους τους άξονες.
    </p>

    <p>
        Εάν υπάρχει πολύ σοβαρός λόγος για την αυτο-εξαίρεσή σας, έχετε τη δυνατότητα <strong>μέσα στις επόμενες 2 ημέρες</strong> να δηλώσετε ότι δεν μπορείτε να αναλάβετε την αξιολόγηση αυτού του ιστότοπου για αυτό το λόγο και να σας αλλάξουμε τον ιστότοπο.
    </p>

    <p>
        Οι αξιολογήσεις, προαιρετικά, μπορούν να συνοδεύονται από σχόλια-υποδείξεις για βελτίωση του ιστότοπου συνολικά, ανά άξονα και ανά κριτήριο, με στόχο να βοηθήσουν τους δημιουργούς να βελτιώσουν τους ιστότοπούς τους στο μέλλον. Παρακαλούμε τουλάχιστο για ένα συνολικό σχόλιο ως προς το τι σας άρεσε περισσότερο σε κάθε ιστότοπο και στο τι θα προτείνατε για βελτιώσεις.
    </p>

    <p>
        Αν έχετε ξεχάσει τον κωδικό πρόσβασης για την είσοδό σας στο πληροφοριακό σύστημα του {{ App\Config::first()->index }}ου ΔΕΕΙ, μπορείτε να πατήσετε στο “Ξέχασα τον Κωδικό Πρόσβασής μου”, για να σας αποσταλούν οδηγίες επαναφοράς κωδικού πρόσβασης.
    </p>

    <p>
        Εάν αντιμετωπίσετε οποιοδήποτε πρόβλημα, παρακαλούμε επικοινωνήστε στο <strong>info@eduwebawards.gr<strong>
    </p>
       

@endsection
