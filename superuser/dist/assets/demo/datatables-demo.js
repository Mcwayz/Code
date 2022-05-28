// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable( {
    "columnDefs": [ {
      targets: [1,2,3,4,5], searchable: false
      } ]
  } );
});
