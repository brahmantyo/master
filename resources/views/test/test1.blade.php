<<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.8/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>
</head>

<style type="text/css">
tr.group,
tr.group:hover {
    background-color: #ddd !important;
}
</style>
<script type="text/javascript">/* Formatting function for row details - modify as you need */
$(document).ready(function() {
    var table = $('#example').DataTable({
        // "ajax": "data.txt",
        "aaData": '{"data":[[{"sjt":"SJT.1.9.150824.01","id":1,"kotamuat":1,"kotabongkar":4,"tglbrkt":"2015-08-22","tgltiba":null,"nilaimuatan":"0.00"},{"sjt":"SJT.1.9.150824.01","id":2,"kotamuat":1,"kotabongkar":2,"tglbrkt":"2015-08-22","tgltiba":"2015-08-25","nilaimuatan":"0.00"},{"sjt":"SJT.1.9.150827.01","id":1,"kotamuat":1,"kotabongkar":4,"tglbrkt":"2015-08-25","tgltiba":null,"nilaimuatan":"0.00"}][}',
        "columnDefs": [
            //{ "visible": false, "targets": 1 }
            
        ],
        "order": [[1,"desc"],[2,"asc"]],
        "columns": [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { "data": "sjt" },
            { "data": "id" },
            { "data": "kotamuat" },
            { "data": "kotabongkar"},
            { "data": "tglbrkt"},
            { "data": "tgltiba"},
            { "data": "totalbiaya"},
            { "data": "dp"},
            { "data": "sisa"},
            { "data": "tipe"},
        ],
        
        "displayLength": 25,
//         "drawCallback": function ( settings ) {
//             var api = this.api();
//             var rows = api.rows( {page:'current'} ).nodes();
//             var last=null;
//             var col1 = null;
//             api.column([1], {page:'current'}).data().each( function ( group, i ) {
                
// /*                if ( last !== group ) {
                    
//                     $(rows).eq( i ).before(
//                          '<tr class="group"><td>'+group+'</td></tr>'
//                     );
    
//                     last = group;
//                 }*/
//             });
//         }
    });
/*    table.rows.every(function(idx,a,b){
        console.log();
    });*/
 
    // Order by the grouping
/*    $('#example tbody').on( 'click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if ( currentOrder[0] === 2 && currentOrder[1] === 'asc' ) {
            table.order( [ 2, 'desc' ] ).draw();
        }
        else {
            table.order( [ 2, 'asc' ] ).draw();
        }
    } );*/
} );
</script>

<body>

<table id="example" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th></th>
            <th>SJT</th>
            <th>IDRute</th>
            <th>Cab Asal</th>
            <th>Cab Tujuan </th>
            <th>Tgl.Brkt</th>
            <th>Tgl.Tiba</th>
            <th>Tot.Biaya</th>
            <th>DP</th>
            <th>Sisa</th>
            <th>Tipe</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th></th>
            <th>SJT</th>
            <th>IDRute</th>
            <th>Cab Asal</th>
            <th>Cab Tujuan </th>
            <th>Tgl.Brkt</th>
            <th>Tgl.Tiba</th>
            <th>Tot.Biaya</th>
            <th>DP</th>
            <th>Sisa</th>
            <th>Tipe</th>
        </tr>
    </tfoot>
</table>

</body>
</html>