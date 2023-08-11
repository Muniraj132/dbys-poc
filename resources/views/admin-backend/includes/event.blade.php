@extends('admin-backend.layout.index')
@section('section')
@php
use Carbon\Carbon;
if(!empty($event)){
    $status = $event->status;
    $description =$event->description;
}else{
    $status = "nodata";
    $description ="";
}
@endphp
   <style>
      /* Hide the default file input */
      .mandatory{
        color: red
      }
      .file-upload input[type="file"] {
        display: none;
        
      }
      .file-upload{
        margin-top: 10px;
      }
      /* Style the custom label to resemble a button */
      .labelimg {
        display: inline-block;
        padding: 10px 20px;
        background-color: #3498db;
        color: #fff;
        cursor: pointer;
        border-radius: 5px;
      }

      /* Optional: Add hover and active states for the label to make it more interactive */
      .labelimg:hover {
        background-color: #2980b9;
      }

      .labelimg:active {
        background-color: #1c7bb8;
      }
      .image-preview {
        margin-left: 100px;
        margin-top: -39px;
      }
      .error {
    font-size: 14px;
    color: red;
     }
     .datetimepicker input {
      background-color: #f2f2f2;
      color: #333;
    }
    </style>

<section class="section dashboard">
  <div class="row">
    
      <div class="col-12">
          <div class="card recent-sales overflow-auto">
            <div class="card-body">
              <h5 class="card-title">{{ request()->is('*/Add-Event') ? 'Add' : '' }}{{ request()->is('*/Edit-Event/*') ? 'Edit' : '' }} Event Form</h5>
              @if(request()->is('*/Edit-Event/*'))
                        <input type="text" id="route" value="edit" hidden>
                        @php
                          $selectedDateTime = $event->start_datetime;
                          $selectedDate = Carbon::parse($selectedDateTime)->toDateString();
                          $endDateTime = $event->end_datetime;
                          $enddate = Carbon::parse($endDateTime)->toDateString();
                        @endphp 
                    @else
                        <input type="text" id="route" value="add" hidden>
                    @endif
              <form  id="Eventform" class="row g-3">
                @csrf
                <input type="text" name="id" id="id" value="{{ $event->id ?? '' }}" hidden>
               <div class="col-md-6">
                    <label class="form-label">Event Name <span class="mandatory">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ $event->title ?? '' }}">
               </div>
               <div class="col-md-6">
                {{-- <label class="form-label">Title <span class="mandatory">*</span></label>
                <input type="text" class="form-control"> --}}

                <div class="image-preview">
                  <img
                  @if(request()->is('*/Edit-Event/*'))
                  src="{{ asset('/Eventresource_files/')}}/{{ $event->image }}"
                  @else
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTmVuDWwaoWggi_jvKDPsrgddPRdwQo-va3iQ&usqp=CAU"
                  @endif
                    style="height: 150px"
                    id="preview-image"
                    alt="Image Preview" />
                </div>
            
                <div class="file-upload" style=" margin-left: 100px !important;">
                  <label class="labelimg" for="image-upload" >
                    <i class="fas fa-cloud-upload-alt"></i>
                    {{ request()->is('*/Add-Event') ? 'Upload' : '' }}{{ request()->is('*/Edit-Event/*') ? 'Change' : '' }}</h5>
                     Image
                  </label>
                  <input type="file" id="image-upload" class="imageevent" value="{{ $event->image ??'' }}" name="image"/>

                </div>
              </div>
              
               <div class="col-6">
                      <label for="activedate" class="form-label">Start Date & Time <span class="mandatory">*</span></label>
                      <input type="text" name="start_datetime" id="start_datetime" value="{{ $selectedDateTime ?? '' }}" class="form-control datetimepicker">
                  </div>

            <div class="col-6">
                    <label for="enddate" class="form-label">End Date & Time<span class="mandatory">*</span></label>
                    <input type="text" name="end_datetime" id="end_datetime" value="{{ $endDateTime ?? '' }}" class="form-control datetimepicker">
            </div>
            <div class="col-md-6">
              <label class="form-label">Location<span class="mandatory">*</span></label>
              <input type="text" name="location" class="form-control" value="{{ $event->location ?? '' }}">
            </div>
            <div class="col-md-6">
              <label class="form-label">Status<span class="mandatory">*</span></label>
              <select id="status" class="form-select" name="status">
                <option value="">Select Option</option>
                <option @if ($status == 'publish') selected @endif value="publish">Publish</option>
                <option @if ($status == 'unpublish') selected @endif value="unpublish">Un Publish</option>
               </select>
            </div>
            <div class="col-12">
              <label for="inputAddress2" class="form-label">Description <span class="mandatory">*</span></label>
              <Textarea class="form-control" name="description" id="description" >
                {!! $description !!}</Textarea>
          </div>
          {{-- <div class=" col-md-6">
            <label class="required"
                for="request_date">datetime</label>
            <input class="form-control datetimepicker"
                type="text" id="datetimeInput"  name="end_datetime"  value="" required
                data-date-format="DD-MM-YYYY HH:mm:ss">

        </div> --}}
          <div class="text-center">
            <button type="submit" class="btn btn-primary question">Submit</button>
           <a href="{{ '/Dbys/Events' }}"  class="btn btn-secondary" id="Close-add-question">Close</a>
        </div>
              </form>
            </div>
          </div>
      </div>
  </div>
</section>

<script>
  
  $(document).ready(function() {
    $('.datetimepicker').datetimepicker({
      format: 'DD-MM-YYYY hh:mm:ss A',
      locale: 'en',
      sideBySide: true,
      icons: {
          up: 'fas fa-chevron-up',
          down: 'fas fa-chevron-down',
          previous: 'fas fa-chevron-left',
          next: 'fas fa-chevron-right'
        }
    });
  });

   // Get references to the input and image elements
   const inputElement = document.getElementById("image-upload");
      const imageElement = document.getElementById("preview-image");
      inputElement.addEventListener("change", (event) => {
        const file = event.target.files[0];
        
        if (file) {
          const reader = new FileReader();
          reader.onload = (e) => {
            imageElement.src = e.target.result;
          };
          reader.readAsDataURL(file);
        } else {
          imageElement.src = "#";
        }
      });

      ClassicEditor.create( document.querySelector( '#description' ),{
      toolbar: [ 'heading','bold', 'italic', 'undo', 'redo', 'numberedList', 'bulletedList']
      });

      var today = new Date().toISOString().split('T')[0];
      $("#start_datetime").change(function(){
      $("#end_datetime").prop("min", $(this).val());
      $("#end_datetime").val(""); //clear end date input when start date changes
      });

      var isEditMode = {!! json_encode(request()->is('*/Edit-Event/*')) !!};
      if (isEditMode != true) {
    var validationRules = 
    {
                title: {
                      required: true,
                  },
                  start_datetime : {
                      required: true,
                  },
                  end_datetime: {
                      required: true,
                  },
                  description: {
                      required: true,
                  },
                  status: {
                      required: true,
                  },
                  location: {
                      required: true,
                  },
                  image:{
                    extension: "jpg,jpeg,png",
                    required: true,
                  }
        };
  }else{
    var validationRules = 
    {
                title: {
                      required: true,
                  },
                  start_datetime : {
                      required: true,
                  },
                  end_datetime: {
                      required: true,
                  },
                  description: {
                      required: true,
                  },
                  status: {
                      required: true,
                  },
                  location: {
                      required: true,
                  }
        };
  }

      $("#Eventform").validate({
            ignore: [":disabled"],
            rules:validationRules,
            messages : {
               title: {
                    required: "Please enter Event Title",
                },
                start_datetime : {
                    required: "Please select Start Date",
                },
                end_datetime : {
                    required: "Please select End Date",
                },
                description : {
                    required: "Please enter the Description",
                },
                status : {
                    required: "Please select the Status",
                },
                location:{
                    required: "Please enter the location",
                },
                image:{
                  extension: "Please upload file in these format only (jpg, jpeg, png, ico, bmp).",
                  required: "Please upload the image",
                }
            },
            submitHandler: function(form) {
                var thisForm = $(form);
                var formId = thisForm.attr("id");
                var formData = new FormData($("#" + formId)[0]);
              
                var route = $('#route').val();
                if(route == "edit"){
                    url = "{{ url('EventUpdate') }}";
                }else{
                    url = "{{ url('EventStore') }}";
                }
                $.ajax({
                    type: "post",
                    url: url,
                    data:formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        swal("Success!", ""+response.success+"", "success").then(okay => {
                            if (okay) {
                                window.location.href = "{{url('/Dbys/Events')}}";
                            }
                        });
                    }
                });
            }
        });
</script>
@endsection