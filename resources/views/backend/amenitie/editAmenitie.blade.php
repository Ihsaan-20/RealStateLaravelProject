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
                    <h6 class="card-title">Add Amenitie</h6>
                    <form action="{{ route('update.amenitie') }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="id" value="{{$amenities->id}}"> 
                        <div class="mb-3">
                            <label for="amenitie_name" class="form-label">Amenitie</label>
                            <input type="text" class="form-control @error('amenitie_name') is-invalid @enderror" name="amenitie_name" value="{{$amenities->amenitie_name}}">
                            @error('amenitie_name')
                                <span class="text-danger"> {{$message}} </span>
                            @enderror
                        </div>                        
                        <button type="submit" class="btn btn-inverse-primary me-2 px-4">Update Amenitie</button>
                    </form>
                    
                    
                </div>
              </div>    

          </div>
          <!-- right wrapper end -->


        </div>
    </div>
    
    @endsection