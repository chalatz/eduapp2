(function($){

  var depandable_fields = function(wrapper, depender, dependee, depender_value) {

    if(depender.val() != depender_value){
        wrapper.hide();
        //dependee.val('');
    }

    depender.on('change', function(){
        if(depender.val() == depender_value){
            wrapper.fadeIn();
        } else {
            //dependee.val('');
            wrapper.hide();
        }
    });

  }; // end depandable_fields()

  var checkbox_toggle_visibility = function(thebox, wrapper) {
    wrapper.hide();

    if($(this).is(':checked')){
        wrapper.show();
    }

    thebox.on('click', function(){
        if($(this).is(':checked')){
            wrapper.fadeIn();
        } else {
            wrapper.fadeOut();
        }
    });
}; // end checkbox_toggle_visibility()

  var langs = function(thebox, theselect){

    theselect.on('change', function(){
        if(theselect.val() !== ''){
            thebox.prop('checked', true);
        } else {
            thebox.prop('checked', false);
        }
    });

  }; // end langs()


  // --- Data tables

  // Sites -----
  // Setup - add a text input to each footer cell
  $('#sites-table tfoot th').each( function () {
      var title = $(this).text();
      $(this).html( '<input type="text" placeholder="'+title+'" />' );
  } );

  var sites_table = $('#sites-table').DataTable({
    initComplete: function ()
      {
        var r = $('#sites-table tfoot tr');
        r.find('th').each(function(){
          $(this).css('padding', 8);
        });
        $('#sites-table thead').append(r);
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
  sites_table.columns().every( function () {
      var that = this;

      $( 'input', this.footer() ).on( 'keyup change', function () {
          if ( that.search() !== this.value ) {
              that
                  .search( this.value )
                  .draw();
          }
      } );
  } );
  // End Sites -----

  // Graders -----
  // Setup - add a text input to each footer cell
  $('#graders-table tfoot th').each( function () {
      var title = $(this).text();
      $(this).html( '<input type="text" placeholder="'+title+'" />' );
  } );

  var graders_table = $('#graders-table').DataTable({
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
  graders_table.columns().every( function () {
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

  depandable_fields($('#received_permission_wrapper'), $('.site-form select#uses_private_data'), $('#received_permission'), 'yes');
  depandable_fields($('#restricted_access_details_wrapper'), $('.site-form select#restricted_access'), $('#restricted_access_details'), 'yes');

  checkbox_toggle_visibility($('input[name=propose_myself]'), $('#why_propose_myself_wrapper'));
  if($('input[name=propose_myself]').is(':checked') === true){
      $('#why_propose_myself_wrapper').show();
  }

  langs($('#english'), $('#english_level'));
  langs($('#french'), $('#french_level'));
  langs($('#german'), $('#german_level'));
  langs($('#italian'), $('#italian_level'));

  $('body .dropdown-toggle').dropdown();

})(jQuery);
