$(function(e) {
    'use strict';

    // DATATABLE 1
    $('#datatable1').DataTable({
        responsive: true,
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
        }
    });

    // DATATABLE 2
    $('#table-2').DataTable({
        "ajax": {
            "url": "/path/to/your/data",
            "type": "GET",
            "error": function (jqXHR, textStatus, errorThrown) {
                console.error("Ajax Error: ", textStatus, errorThrown);
            }
        }
    });    
    
    // SELECT2
    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity
    });
});