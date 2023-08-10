@extends('admin-backend.layout.index')
@section('section')



<section class="section dashboard">
  <div class="row">

    <!-- Left side columns -->
    <div class="col-lg-12">
      <div class="row">

        <!-- Sales Card -->
        <div class="col-xxl-4 col-md-4">
          <div class="card info-card sales-card">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Sales <span>| Today</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-cart"></i>
                </div>
                <div class="ps-3">
                  <h6>145</h6>
                  <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                </div>
              </div>
            </div>

          </div>
        </div><!-- End Sales Card -->

        <!-- Revenue Card -->
        <div class="col-xxl-4 col-md-4">
          <div class="card info-card revenue-card">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Revenue <span>| This Month</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-currency-dollar"></i>
                </div>
                <div class="ps-3">
                  <h6>$3,264</h6>
                  <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                </div>
              </div>
            </div>

          </div>
        </div><!-- End Revenue Card -->

        <!-- Customers Card -->
        <div class="col-xxl-4 col-md-4">

          <div class="card info-card customers-card">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Customers <span>| This Year</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                  <h6>1244</h6>
                  <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span>

                </div>
              </div>

            </div>
          </div>

        </div>
    </div>
    <div class="col-12">
      <div class="card recent-sales overflow-auto">
           <div class="filter">
            <span id="loader" style="display: none;">
              <img src="{{asset('assets/img/gif/ajaxload.gif')}}" width="32px" height="32px" />
          </span>
          <button class="exportbtn btn btn-secondary" id="exportbtn" disabled="disabled"><i class="mdi mdi-file-excel"></i><span id="exportcount">Export</span></button>
             <a href="{{ '#' }}"> <button class="btn btn-primary me-4 adduser" id="add-usere"><i class="fas fa-add"></i> Add</button></a>
          </div>
          <div class="card-body">
              <h5 class="card-title">Users List</span></h5>
              <input class="form-check-input align" type="checkbox" name="checkAll" id="checkAll" />
              <label class="form-check-label" for="gridCheck">
                  Select All
              </label>  
              <br>        
              <table class="table table-borderless usertable" id="User-table" style="width: 100%;">
                  <thead>
                      <tr>
                          <th>#</th>
                          {{-- <th scope="col">ID</th> --}}
                          <th scope="col">User Name </th>
                          <th scope="col">Email</th>
                          <th scope="col">Role</th>
                          {{-- <th scope="col">location</th>  --}}
                          <th scope="col">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <br>
                    <div class="alert alert-success" id="exportsuccess" style="display:none">
                    Exported Successfully.
                    <div style="float:right;margin-top: -5px;">
                    <button type="button" id="Closesuccess" class="close" data-dismiss="modal" >&times;</button>
                    </div>
                    </div>
                  </tbody>
              </table>
          </div>
      </div>
  </div>
  <!-- Delete Section Modal -->
  <div class="modal fade section" id="delete-section" tabindex="-1">
    <div class="modal-dialog modal-md">
    <div class="modal-content">
        <form id="delete-section-form">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title"> <span id="delete-header"></span> Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">
            <input type="hidden" name="id" id="user-date-id" value="">
            <input type="hidden" name="route" id="user-data-update-route" value="">
            <div class="col-12">
            <label for="name" class="form-label">Do you really want to delete this <span id="section-name"></span>?</label>
            </div>
        </div>
            <div class="modal-footer">
                <button type="submit" id="Userdalete" class="btn btn-danger">Delete</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
            </div>
        </form>
    </div>
    </div>
</div>
<!-- End Delete Section Modal-->

{{-- edit user model  --}}
<div class="container">
  <!-- Delete Modal -->
  <div class="modal" id="myModal" >
  <div class="modal-dialog modal-md modal-centered">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" >
        <h4>Manage Account</h4>
        <button type="button" id="CloseModal" class="close btn btn-danger" data-dismiss="modal" >&times;</button>
      </div>
      <form id="manageusers">
          @csrf
      <div class="modal-body">
      <div class="row">
          <div class="col-12">
              <label for="name" class="form-label">User Name </label>
              <input type="text" id="username" name="username" class="form-control" id="main-section-name" value="" >
          </div>
             
          <div class="col-12">
              <label for="description" class="form-label">Email</label>
              <input type="text" id="email" name="email" class="form-control" id="main-section-name" value="" >
          </div>
          <div class="col-12" id="addpassword">
            
          </div>
          <div class="col-12">
              <label for="description" class="form-label">User Role</label>
              <select class="form-select" name="usertype" id="usertype">
                  <option value="Users">Users</option>
                  <option value="Director">Director</option>
                  <option value="ZonalDirector">Zonal Director</option>
                  <option value="YouthAnimator">Youth Animator</option>
                  <option value="President">President</option>
                  <option value="VicePresident">Vice President</option>
                  <option value="admin">Admin</option>
              </select>
          </div>

          <div class="col-12">
              <label for="description" class="form-label">Status</label>
              <select class="form-select" name="status" id="user_status">
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>
              </select>
          </div>
          <div class="col-12">
          <div class="row comment-section" style="display: none;">
            <div class="form-group col-md-12">
              <label for="description" class="form-label">Comments</label>
              <textarea class="form-control" name="comments" id="comment" value="" maxlength="255"></textarea>
              <span class="error-comment" id="error-comment" style="display: none;">Please Enter Comment</span>
            </div>
          </div>
      </div>
          <input type="hidden" value="" name="id" id="id">
      </div>
      <br>
      {{-- <div class="col-12">
          <span style="margin-left: 5px">
          <input class="form-check-input" name="approvestatus" type="checkbox" id="approvestatus" value="Approved">
          <label class="form-label" for="gridCheck">
             Approved
          </label>
          </span>
      </div> --}}
      <br>
      <div class="modal-footer">
        <button class="btn btn-add m-t-15 waves-effect mb-3 btn btn-primary updatemodel" id="manageusersupdate" hidden>Update</button>
        <button class="btn btn-add m-t-15 waves-effect mb-3 btn btn-primary addmodel" id="adduser" hidden>Add</button>
        <button class="btn btn-add m-t-15 waves-effect mb-3 btn btn-danger" id="closeModal" type="button"  >
        Cancel</button>
      </div>
      </div>
    </form>
  </div>
  </div>
  </div>
</div>
{{-- end user model --}}
  </div>
</section>
<script>


    $(".adduser").click(function(){
    $('#username').prop('disabled',false);
    $('.updatemodel').attr('hidden',true);
    $('.addmodel').removeAttr('hidden');
    $("#addpassword").append('<div id="passwordadd"><label for="password" class="form-label">Password</label>' +
    '<input type="text" id="password" name="password" class="form-control" value=""></div>');
    $('#myModal').appendTo("body").modal('toggle');
  });

  $('#adduser').click(function(e){ 
        e.preventDefault();
        var formId = 'manageusers';
        var method = 'POST';
        var data = $("#"+formId+"").serializeArray();
        var url = "{{ url('addUser') }}";
        manageusers(data,method,url);
  });



$('.usertable').on('click','.userdel',function() {
        $('#user-data-update-route').val($(this).attr('section-id'));
        $('#user-date-id').val($(this).attr('data-id'));
        $("#delete-header").text('User');
        $("#section-name").text('User');
    });

  var activedate = $('table#User-table').DataTable({
        processing: true,
        serverSide: true,
        bFilter: true, 
        bInfo: true,
        bPaginate: true,
        ajax: "{{ url('userdata') }}",
        columns: [
              
        {data: 'actioncheck', name: 'Actioncheck', orderable: false, searchable: true},

            // {data: "id", render: function (data, type, row, meta) {return meta.row + meta.settings._iDisplayStart + 1;}},
            {data: 'username', name: 'username',orderable: true, searchable: true},
            {data: 'email', name: 'email',orderable: false, searchable: true},
            {data: 'usertype', name: 'Role',orderable: true, searchable: true},
            {data: 'Action', name: 'Action', orderable: false, searchable: true},
        ]
    });

    $("#Userdalete").on('click',function (event) {      
        event.preventDefault();
        var route = $('#user-data-update-route').val();
        var id = $('#user-date-id').val();
        if(route == "main"){
            url="{{url('userdatedelete')}}";
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

    $('#User-table').on('click','.activeedit',function() {
        var data = {'id' : $(this).attr('data-id')};
        var method = 'GET';
        var url = "{{ url('Dbys/Get-Users') }}";
        manageusers(data,method,url);
        $('#myModal').appendTo("body").modal('toggle');
        $('.addmodel').attr('hidden',true);
        $('.updatemodel').removeAttr('hidden');
        $('#username').prop('disabled',true);
    });

    $("#manageusersupdate").click(function(e) {
        e.preventDefault();
        var formId = 'manageusers';
        var method = 'POST';
        var data = $("#"+formId+"").serializeArray();
        var url = "{{ url('Dbys/Update-Users') }}";
        manageusers(data,method,url);
    });

    function manageusers(data,method,url){
      $.ajax({
        method : method,
        url: url,
        data : data,
          success: function(response) {
            if(method == 'GET'){

                data = response.data;
                $('#id').empty().val(data['id']);
                $('#username').empty().val(data['username']);
                
                $('#email').empty().val(data['email']);
                $('#usertype option[value="'+data["usertype"]+'"]').attr('selected','selected');
                 $('#user_status option[value="'+data["status"]+'"]').attr('selected','selected');
                // approved = data['approvestatus'];
                // if(approved == 'Approved'){
                //     $('#approvestatus').empty().attr('checked', true);
                // }else{
                //     $('#approvestatus').empty().attr('checked', false);
                // }
                if( response.data['status'] == "Inactive")
                {
                    $('.comment-section').removeAttr('style');
                    $('#comment').empty().val(response.data['comments']);
                }
            }else{
                $("#myModal").modal("hide");
                swal("Success!", ""+response.success+"", "success").then(function(){
                window.location.reload();
            });
            }
          }
       });
    }
      $('#user_status').on('change',function() {
          let user_status = $('#user_status').val();
          if(user_status == "Inactive"){
              $('#pastorActiveBtn').removeAttr('style');
              $('.comment-section').removeAttr('style');
          }else{
              $('#pastorActiveBtn').removeAttr('style');
              $('.comment-section').attr('style','display:none');
          }
      });
      $("#closeModal").click(function() {
          $('#myModal').modal('hide');
          $('#manageusers').trigger('reset');
          $("#passwordadd").remove();
      });
      $("#CloseModal").click(function() {
        $('#myModal').modal('hide');
        $('#manageusers').trigger('reset');
        $("#passwordadd").remove();
      });

      // Export data
      $("#checkAll").click(function () {
        var check = $(this).prop('checked');
        var numberChecked = $('input:checkbox[name="export"]').not(this).prop('checked', this.checked).length;
        if(check == true){
            $('#exportbtn').removeAttr('disabled');
            $("span#exportcount").html("Export (" + numberChecked + ")");
        }else{
            $('#exportbtn').attr('disabled','disabled');
            $("span#exportcount").html("Export");
        }

    }); 
    $(document).on('click', 'input[name="export"]', function() {

        var check = $(this).prop('checked');
        var data= $("#export:checked").length;


        if(check == true){
            $('#exportbtn').removeAttr('disabled');
            $("span#exportcount").html("Export (" + data + ")");
        }else{
            $('#exportbtn').attr('disabled','disabled');
            $('input:checkbox[name="checkAll"]').removeAttr('checked');
            $("span#exportcount").html("Export");
        }

        i = 0;
        var arr = [];
        $('#export:checked').each(function () {
            arr[i++] = $(this).val();
        });

        if(arr != ''){
            $('#exportbtn').removeAttr('disabled');
            $("span#exportcount").html("Export (" + data + ")");
        }else{
            $('#exportbtn').attr('disabled','disabled');
            $('input:checkbox[name="checkAll"]').removeAttr('checked');
            $("span#exportcount").html("Export");
        }

        });

        $('#exportbtn').click(function () {
        i = 0;
        var arr = [];
        $('#export:checked').each(function () {
            arr[i++] = $(this).val();
        });
        exportCSV(arr);
        });
        function exportCSV(arr) {
        var data = id = {arr};
        var url = "{{ Route('exportXlxs') }}";
        $.ajax({
            method : "get",
            url: url,
            data : data,
            beforeSend: function(){
                $("#loader").show();
            },
            success: function(response) {
                $("#loader").hide();
                var a = document.createElement('a');
                var url = "{{asset('files/DbysUserlist.csv')}}";
                a.href = url;
                a.download = 'DbysUserlist.csv';
                document.body.append(a);
                a.click();
                a.remove();
                $("#exportsuccess").removeAttr('style').delay(2000).fadeOut();
            }
        });
        }
        $("#Closesuccess").click(function() {
        $('#exportsuccess').attr('style','display:none');
        });
</script>
@endsection