get_movie_list();
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function get_movie_list(){
    if ($.fn.dataTable.isDataTable('#movie_list'))
    {
        $('#movie_list').DataTable().destroy();
    }
    var datatable_postdata = {};

    $('#movie_list').DataTable({
        "processing": true,
        "serverSide": true,
        "searching": true,
        "pagingType": "full_numbers",
        "iDisplayLength":15,
        "lengthMenu": [[5,15,25,50,100], [5,15,25,50,100]],
        "buttons": [
            { "extend": 'excel', "text":'Export <i class="fa fa-file-excel-o"></i>',"className": 'btn btn-default btn-sm', 'title' : 'Customer Data' }
        ],
        "dom": 'lBfrtip',
        "language": {
            "emptyTable": "No Records Found",
        },
        "columnDefs": [
            { "orderable": false, "targets": 0},
            { "orderable": false, "targets": [0,1,2,3,4]}
        ],
        ajax: {
            
            url: '/get-movie-listing',
            data:datatable_postdata,
            dataType:"JSON",
        
        },
            "columns": [
               
                {data: 'title', name: 'title'},
                {data: 'year', name: 'year'},
                {data: 'description', name: 'description'},
                {data: 'image', name: 'image'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
} 