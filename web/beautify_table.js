$(document).ready(function() {
  $('#thistimewithid').DataTable( {
      "lengthMenu": [[10, 25, 50, 100, 500, -1], [10, 25, 50, 100, 500, "All"]],
      "pageLength": 25,
      "dom": 'Bfrtip',
      "buttons": [
          'pageLength', 'csv', 'excel'
      ]
  } );
} );
