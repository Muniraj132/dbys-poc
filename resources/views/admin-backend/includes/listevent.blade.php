@extends('admin-backend.layout.index')
@section('section')
<style>
    .listimages{
        height: 30px;
        width: 30px;
    }
</style>
<section class="section dashboard">
  <div class="row">
        <!-- Churchlist Section -->
        <div class="col-12">
            <div class="card recent-sales overflow-auto">
                 <div class="filter">
                   <a href="{{ '/Dbys/Add-Event' }}"> <button class="btn btn-primary me-4" id="add-active_date"><i class="fas fa-add"></i> Add</button></a>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Events</span></h5>
                    <table class="table table-borderless activedatestable" id="main-event-table" style="width: 100%;">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Events </th>
                                <th scope="col">image</th>
                                <th scope="col">start Date & Time</th>
                                <th scope="col">End Date & Time</th>
                                <th scope="col">location</th> 
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End Churchlist Section -->  
    </div>
     <!-- Delete Section Modal -->
     <div class="modal fade section" id="delete-section" tabindex="-1">
        <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form id="delete-section-form">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"> <span id="delete-header"></span> Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="active-date-id" value="">
                <input type="hidden" name="route" id="active-date-update-route" value="">
                <div class="col-12">
                <label for="name" class="form-label">Do you really want to delete this <span id="section-name"></span>?</label>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" id="Eventdelate" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                </div>
            </form>
        </div>
        </div>
    </div>
<!-- End Delete Section Modal-->
</section>
<script>
var activedate = $('table#main-event-table').DataTable({
        processing: true,
        serverSide: true,
        bFilter: true, 
        bInfo: true,
        bPaginate: true,
        ajax: "{{ url('eventdata') }}",
        columns: [
            {data: "id", render: function (data, type, row, meta) {return meta.row + meta.settings._iDisplayStart + 1;}},

            {data: 'title', name: 'title',orderable: true, searchable: true},
             {data: 'image', name: 'image',orderable: false, searchable: true},
             {
                    data: 'start_datetime',
                    name: 'Active Date',
                    orderable: true,
                    searchable: true,
                    render: function (data) {
                        var datetime = new Date(data);
                        var dd = String(datetime.getDate()).padStart(2, '0');
                        var mm = String(datetime.getMonth() + 1).padStart(2, '0');
                        var yyyy = datetime.getFullYear();
                        
                        var hours = datetime.getHours();
                        var minutes = String(datetime.getMinutes()).padStart(2, '0');
                        var ampm = hours >= 12 ? 'PM' : 'AM';
                        hours = hours % 12;
                        hours = hours ? hours : 12; // Convert 0 to 12
                        
                        return dd + '/' + mm + '/' + yyyy + ' ' + hours + ':' + minutes + ' ' + ampm;
                    }
             },  

             {
                    data: 'end_datetime',
                    name: 'End Date',
                    orderable: true,
                    searchable: true,
                    render: function (data) {
                        var datetime = new Date(data);
                        var dd = String(datetime.getDate()).padStart(2, '0');
                        var mm = String(datetime.getMonth() + 1).padStart(2, '0');
                        var yyyy = datetime.getFullYear();
                        
                        var hours = datetime.getHours();
                        var minutes = String(datetime.getMinutes()).padStart(2, '0');
                        var ampm = hours >= 12 ? 'PM' : 'AM';
                        hours = hours % 12;
                        hours = hours ? hours : 12; // Convert 0 to 12
                        
                        return dd + '/' + mm + '/' + yyyy + ' ' + hours + ':' + minutes + ' ' + ampm;
                    }
                },

            {data: 'location', name: 'Year',orderable: true, searchable: true},
            // {data: 'Status', name: 'Status',orderable: true, searchable: true},
            {data: 'Action', name: 'Action', orderable: false, searchable: true},
        ]
    });

    $('.activedatestable').on('click','.activedatedel',function() {
        $('#active-date-update-route').val($(this).attr('section-id'));
        $('#active-date-id').val($(this).attr('data-id'));
        $("#delete-header").text('Event');
        $("#section-name").text('Event');
    });

    $("#Eventdelate").on('click',function (event) {      
        event.preventDefault();
        var route = $('#active-date-update-route').val();
        var id = $('#active-date-id').val();
        if(route == "main"){
            url="{{url('eventdatedelete')}}";
        }
        
        deleteSection(id,url);
    });

    function deleteSection(id,url){
        $.ajax({
            type: "get",
            url: url,
            data : {
                id : id
            },
            success: function(response) {
                $("#delete-section").modal("hide");
                activedate.draw();
                if(response.success){
                    swal("Success!", ""+response.success+"", "success");
                }else{
                    swal("Warning!", ""+response.failed+"", "warning");
                }
            }
        });
    }

</script>
@endsection