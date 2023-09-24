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
                    <h6 class="card-title">Add Role</h6>
                    <form id="myForm" action="{{ route('store.role') }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Role Name</label>
                            <input type="text" class="form-control" name="name">
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
                  
              },
              messages :{
                name: {
                      required : 'Please Enter Permission Name',
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