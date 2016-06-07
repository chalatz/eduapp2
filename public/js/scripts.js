(function($){

  // --- Data tables

  // Graders -----
  // Setup - add a text input to each footer cell
  $('#graders-table tfoot th').each( function () {
      var title = $(this).text();
      $(this).html( '<input type="text" placeholder="'+title+'" />' );
  } );

  var table = $('#graders-table').DataTable({
    initComplete: function ()
      {
        var r = $('#graders-table tfoot tr');
        r.find('th').each(function(){
          $(this).css('padding', 8);
        });
        $('#graders-table thead').append(r);
        $('#search_0').css('text-align', 'center');
      },
    "dom": 'lfriptip',
    "language": {
        "sProcessing":   "Επεξεργασία...",
        "sLengthMenu":   "Εμφάνισε _MENU_ εγγραφές",
        "sZeroRecords":  "Δεν βρέθηκαν εγγραφές που να ταιριάζουν",
        "sInfo":         "Εμφανίζονται _START_ εως _END_ από _TOTAL_ εγγραφές",
        "sInfoEmpty":    "Εμφανίζονται 0 έως 0 από 0 εγγραφές",
        "sInfoFiltered": "(φιλτραρισμένες από _MAX_ συνολικά εγγραφές)",
        "sInfoPostFix":  "",
        "sSearch":       "Αναζήτηση:",
        "sUrl":          "",
        "oPaginate": {
            "sFirst":    "Πρώτη",
            "sPrevious": "Προηγούμενη",
            "sNext":     "Επόμενη",
            "sLast":     "Τελευταία"
        }
    },
    "pageLength": 100
  });

  // Apply the search
  table.columns().every( function () {
      var that = this;

      $( 'input', this.footer() ).on( 'keyup change', function () {
          if ( that.search() !== this.value ) {
              that
                  .search( this.value )
                  .draw();
          }
      } );
  } );
  // End Graders -----

  // Styling staff
  $('.dataTables_wrapper .dataTables_length').addClass('col-sm-2');
  $('.dataTables_wrapper .dataTables_filter').addClass('col-sm-8').css('text-align', 'left');
  $('.dataTables_wrapper .dataTables_info').addClass('col-sm-3').before('<div class="row"></div>');
  $('.dataTables_wrapper .dataTables_paginate').addClass('col-sm-9').css('text-align', 'left');

  // --- End Data tables


})(jQuery);
