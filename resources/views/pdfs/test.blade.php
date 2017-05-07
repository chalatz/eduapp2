<!DOCTYPE html>
<html lang="el">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Βεβαίωση</title>
    
    <style>
    
        @font-face {
            font-family: 'Open Sans';
            src: url({{ asset('fonts/OpenSans-Regular.ttf') }});
            font-weight: normal;
        }

        @font-face {
            font-family: 'Open Sans';
            src: url({{ asset('fonts/OpenSans-Bold.ttf') }});
            font-weight: bold;
        }

        @font-face {
            font-family: 'Open Sans';
            src: url({{ asset('fonts/OpenSans-Italic.ttf') }});
            font-weight: italic;
        }                

        body {
            font-family: 'Open Sans', 'DejaVu Sans';
        }

        .main {
            width: 1000px;
            height: 650px;
            margin: 10px auto;
            text-align: center;
            outline: 1px solid black;
            background-image: url('{{ asset('img/certificate-bg.jpg') }}');
            background-repeat: no-repeat;
            background-position: top left;  
        }

        .info-wrapper {
            margin: 0 auto;
            position: relative;
            top: 235px;
            width: 830px;
            text-align: center;
        }

        table, tr, td {
            text-align: center;
        }

        .info {                    
            width: 100%;
        }

        .title {
            color: rgb(0, 112, 192);
            font-size: 20px;
            font-weight: bold;
        }

        .content {
            font-size: 14px;
        }

        .small {
            font-size: 10px;
            padding: 6px 90px;
        }


    </style>

</head>
<body>

    <div class="main">

        <div class="info-wrapper">

            <table class="info">

                <thead>
                    <tr>
                        <th class="title" colspan="2">
                            ΒΕΒΑΙΩΣΗ ΣΥΜΜΕΤΟΧΗΣ
                        </th>
                    </tr>
                </thead>
                
                <tbody class="content">
                    <tr>
                        <td colspan="2" style="padding: 10px 0">
                            Στον Ιστότοπο: <strong>ΟΝΟΜΑΣΙΑ</strong>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 10px 0">
                            Για τη συμμετοχή του στον <strong>8ο Διαγωνισμό Ελληνόφωνων Εκπαιδευτικών Ιστότοπων,</strong> ο οποίος έγινε στο πλαίσιο του 9ου Πανελλήνιου Συνεδρίου των Εκπαιδευτικών για τις Τεχνολογίες της Πληροφορίας και της Επικοινωνίας.
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 18px 0 8px 0">
                            Σύρος, 30 Μαΐου 2017
                        </td>
                    </tr>
                    <tr>
                        <td class="small">
                            Για την οργανωτική επιτροπή	
	                        του 8ου Διαγωνισμού Ελληνόφωνων του 9ου Πανελλήνιου Συνεδρίου
	                        Εκπαιδευτικών Ιστότοπων
                        </td>
                        <td class="small">
                            Για την οργανωτική επιτροπή	
	                        του 8ου Διαγωνισμού Ελληνόφωνων του 9ου Πανελλήνιου Συνεδρίου
	                        Εκπαιδευτικών Ιστότοπων
                        </td>
                    </tr>
                    <tr>
                        <td class="small">
                            <strong>Δρ. ΠΑΠΑΔΑΚΗΣ ΣΠΥΡΟΣ</strong><br>
                            <i>Διευθυντής ΠΕΚ Πάτρας</i><br>
                            <i>Σχολικός Σύμβουλος Πληροφορικής</i>
                        </td>
                        <td class="small">
                            <strong>ΤΖΙΜΟΠΟΥΛΟΣ ΝΙΚΟΣ</strong><br>
                            <i>Υπεύθυνος ΚΕ.ΠΛΗ.ΝΕ.Τ Κυκλάδων</i>
                        </td>
                    </tr>
                </tbody>

            </table>

        </div>
    
    </div>

    
</body>
</html>