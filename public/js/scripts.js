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

  // If the site selects other country, the county gets selected
  var other_country = function(){

      $('#district_id').on('change', function(){
          $this = $(this);

          if($this.val() === '14'){
              $('#county_id').val('75');
          } else {
              $('#county_id').val('');
          }
      });

  };

    $('.stats-table').dataTable({
        paging: false,
        searching: false,
        info: false
    });

    $('#assignments-panel-table tbody tr').each(function(index){
        if($(this).children('td').length == 3){
            $(this).children('td').eq(1).after('<td></td>');
        }
    });

  // Assignments panel -----
  // Setup - add a text input to each footer cell
  $('#assignments-panel-table tfoot th').each( function () {
      var title = $(this).text();
      $(this).html( '<input type="text" placeholder="'+title+'" />' );
  } );

  var assignments_panel_table = $('#assignments-panel-table').DataTable({
    initComplete: function ()
      {
        var r = $('#assignments-panel-table tfoot tr');
        r.find('th').each(function(){
          $(this).css('padding', 8);
        });
        $('#assignments-panel-table thead').append(r);
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
    "pageLength": 1000
  });

  // Apply the search
  assignments_panel_table.columns().every( function () {
      var that = this;

      $( 'input', this.footer() ).on( 'keyup change', function () {
          if ( that.search() !== this.value ) {
              that
                  .search( this.value )
                  .draw();
          }
      } );
  } );
  // End Assignments panel -----

  $('#submissions-stats-table').dataTable({
        paging: false,
        searching: false,
        info: false,
        "columnDefs": [
            { "orderData": 2, "targets": 0 },
            { "targets": 2, "visible": false }
        ]
  });    

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

  other_country();

  var funky_charts = function(){

    // hovering the table
    $('#cats-stats-table .stats-cats-row').on('mouseover', function(){
          
        var $this = $(this),
            cats_row = $this.attr('id'),
            cats_row_index = cats_row.substr(cats_row.length - 1),
            pie_piece = $('.cats-bars-chart .ct-series').eq(cats_row_index - 1);

            pie_piece.siblings('.ct-chart-pie .ct-series').css({'opacity':'.2'});

        });

        $('#cats-stats-table .stats-cats-row').on('mouseleave', function(){
            $('.ct-series').css({'opacity':'1'});
        });

    // hovering the legend
    $('#cats-pie-legend .pie-legend-item').on('mouseover', function(){
          
        var $this = $(this),
            legend_row_id = $this.attr('id'),
            legend_row_index = legend_row_id.substr(legend_row_id.length - 1),
            pie_piece = $('.cats-bars-chart .ct-series').eq(legend_row_index - 1);

            pie_piece.siblings('.ct-chart-pie .ct-series').css({'opacity':'.2'});

        });     

        $('#cats-pie-legend .pie-legend-item').on('mouseleave', function(){
            $('.ct-series').css({'opacity':'1'});
        });           

  };

  var sites_modals = function(){
    $("#sites-modal").on("show.bs.modal", function(e) {
        var link = $(e.relatedTarget);
        $(this).find(".modal-body").load(link.attr("href"));
    }); 
  };

  var graders_modals = function(){
    $("#graders-modal").on("show.bs.modal", function(e) {
        var link = $(e.relatedTarget);
        $(this).find(".modal-body").load(link.attr("href"));
    }); 
  };  

  $( window ).load(function() {
    sites_modals();
    graders_modals();
    funky_charts();
  });

  $('body .dropdown-toggle').dropdown();

  $(".select2").select2();

    // Ajax post
    $('.handle-sites-form').submit(function(event){

    event.preventDefault();

    var form = $(this),
        site__id = form.attr('id');
        
        if(handle_sites_cat__id === '6'){
            property__id = $('#specialty_id-' + site__id).val();
        }

        if(handle_sites_cat__id === '1'){
            property__id = $('#primary_edu_id-' + site__id).val();
        }

        if(handle_sites_cat__id === '3'){
            property__id = $('#secondary_edu_id-' + site__id).val();
        }        

        $.ajax({
            method: 'POST',
            url: handle_sites_post_url,
            data: {
                site_id: site__id,
                property_id : property__id,
                handle_sites_cat_id: handle_sites_cat__id,
                _token: token
            },
        }).done(function(msg){
            $('#site-ok-' + site__id).html('OK!').fadeIn();
            console.log(msg['message']);
        });

  });

  // Ajax test
//   $('#ajax-btn').on('click', function(e){

//     e.preventDefault();

//     var district_id = $(this).data('district');

//     $.ajax({
//         type: 'GET',
//         url: 'ajax-url/' + district_id,
//         success: function(data){
//             $('#ajax-data').append(data);
//             console.log(data);
//         }
//     });

//   });

    // TEST Fill modal with content from link href
    // $("#ajax-modal").on("show.bs.modal", function(e) {
    //     var link = $(e.relatedTarget);
    //     $(this).find(".modal-body").load(link.attr("href"));
    // });   

})(jQuery);
