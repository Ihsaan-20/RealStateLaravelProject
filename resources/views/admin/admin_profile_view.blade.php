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
          <!-- left wrapper start -->
          <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
            <div class="card rounded">
              <div class="card-body">
                <div class="image-sec">
                  <div class="circle-container mb-2">
                    <img class="rounded-circle" src="{{ (!empty($profileData->photo)) ? url('uploads/admin_images/'.$profileData->photo) : url('uploads/no_image.jpg') }}" alt="profile">
                  </div>
                    <div class="mt-3">
                      <h4 class="text-light text-center">{{ $profileData->name }}</h4>
                    </div>
                </div>
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Username:</label>
                  <p class="text-muted">{{ $profileData->username }}</p>
                </div>
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
                  <p class="text-muted">{{ $profileData->email }}</p>
                </div>
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Phone:</label>
                  <p class="text-muted">{{ $profileData->phone }}</p>
                </div>
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Address:</label>
                  <p class="text-muted">{{ $profileData->address }}</p>
                </div>
                
                <div class="mt-3 d-flex social-links">
                  <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                    <i data-feather="github"></i>
                  </a>
                  <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                    <i data-feather="twitter"></i>
                  </a>
                  <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                    <i data-feather="instagram"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <!-- left wrapper end -->

          {{-- Update Profile Data here  --}}
          <!-- right wrapper start -->
          <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Update Details</h6>
                        <form class="forms-sample" action="{{route('admin.profile.store')}}" method="POST" enctype="multipart/form-data">
                          @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" autocomplete="off" value="{{$profileData->name}}">
                            </div>
                            <div class="mb-3">
                              <label for="" class="form-label">Username</label>
                              <input type="text" class="form-control" name="username" autocomplete="off" value="{{$profileData->username}}">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Email address</label>
                                <input type="email" class="form-control" name="email" value="{{$profileData->email}}">
                            </div>
                            <div class="mb-3">
                              <label for="" class="form-label">Address</label>
                              {{-- <textarea name="address" class="d-block w-100" name="" rows="3">{{$profileData->address}}</textarea> --}}
                              <input type="text" class="form-control" name="address" value="{{$profileData->address}}">
                              
                            </div>
                            <div class="mb-3">
                              <label for="" class="form-label">Profile Image</label>
                              <input type="file" class="form-control" id="image" name="photo">                              
                            </div>
                            <div class="circle-container mb-3" style="width: 100px; height:100px">
                              <img class="rounded-circle" id="showImage" src="{{ (!empty($profileData->photo)) ? url('uploads/admin_images/'.$profileData->photo) : url('uploads/no_image.jpg') }}" alt="profile">
                            </div>

                            <button type="submit" class="btn btn-primary me-2 px-4">Save Changes</button>
                        </form>
  
                </div>
              </div>    

          </div>
          <!-- right wrapper end -->


        </div>
    </div>
    {{-- show upload image live --}}
    <script>
      $(document).ready(function(){
        $('#image').change(function(e){  // Pass the event object 'e'
          var reader = new FileReader();
          reader.onload = function(event){  // Change 'e' to 'event'
            $('#showImage').attr('src', event.target.result);  // Change 'e.target.result' to 'event.target.result'
          }
          reader.readAsDataURL(e.target.files[0]);  // Use 'e.target.files[0]' instead of 'e.target.files['0']'
        });
      });
    </script>
    
    @endsection