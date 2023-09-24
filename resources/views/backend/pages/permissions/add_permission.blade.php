@extends('admin.admin_dashboard')
    @section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    {{-- Image Css--}}
    <style>
      .image-sec{
        display: grid;
        place-items: center;
      }
      .circle-container {
        width: 180px;
        height: 180px;
        border-radius: 50%;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #ffffff; /* Optional background color for the circle */
      }
      .circle-container img {
        max-width: 100%;
        max-height: 100%;
      }
    </style>

    <div class="page-content">

        <div class="row">
          <div class="col-12 grid-margin">
          </div>
        </div>
        <div class="row profile-body">

          {{-- Update Profile Data here  --}}
          <!-- right wrapper start -->
          <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Add Permission</h6>
                    <form id="myForm" action="{{ route('store.permission') }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Permission Name</label>
                            <input type="text" class="form-control" name="name">
                        </div> 
                        <div class="mb-3">
                            <label for="group_name" class="form-label">Group Name</label>
                            <select class="form-select form-select-lg" name="group_name">
                                <option selected="" disabled >Select Group</option>
                                <option value="property">Property Type</option>
                                <option value="amenitie">Amenitie</option>
                                <option value="role">Role & Permission</option>
                            </select>
                        </div>                       
                        <button type="submit" class="btn btn-inverse-primary me-2 px-4">Add Permission</button>
                    </form>
                    
                    
                </div>
              </div>    

          </div>
          <!-- right wrapper end -->


        </div>
    </div>

    <script type="text/javascript">
      $(document).ready(function (){
          $('#myForm').validate({
              rules: {
                name: {
                      required : true,
                  },
                guard_name: {
                    required : true,
                },
                  
              },
              messages :{
                name: {
                      required : 'Please Enter Permission Name',
                  },
                guard_name: {
                      required : 'Please Select Group Name',
                }, 
              },
              
              errorElement : 'span', 
              errorPlacement: function (error,element) {
                  error.addClass('invalid-feedback');
                  element.closest('.form-group').append(error);
              },
              highlight : function(element, errorClass, validClass){
                  $(element).addClass('is-invalid');
              },
              unhighlight : function(element, errorClass, validClass){
                  $(element).removeClass('is-invalid');
              },
          });
      });
      
  </script>
    
    @endsection