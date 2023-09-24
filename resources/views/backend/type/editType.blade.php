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
                    <h6 class="card-title">Edit Property Type</h6>
                    <form action="{{ route('update.type') }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" class="form-control" name="id" value="{{$types->id}}">
                        <div class="mb-3">
                            <label for="type_name" class="form-label">Property Type</label>
                            <input type="text" class="form-control @error('type_name') is-invalid @enderror" name="type_name" value="{{$types->type_name}}">
                            @error('type_name')
                                <span class="text-danger"> {{$message}} </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="icon_type" class="form-label">Icon Type</label>
                            <input type="text" class="form-control @error('icon_type') is-invalid @enderror" name="icon_type" value="{{$types->icon_type}}">
                            @error('icon_type')
                                <span class="text-danger"> {{$message}} </span>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-inverse-primary me-2 px-4">Add Property Type</button>
                    </form>
                    
                    
                </div>
              </div>    

          </div>
          <!-- right wrapper end -->


        </div>
    </div>
    
    @endsection