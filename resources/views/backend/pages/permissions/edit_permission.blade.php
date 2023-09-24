@extends('admin.admin_dashboard')
    @section('admin')

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
                    <h6 class="card-title">Edit Permission</h6>
                    <form id="myForm" action="{{ route('update.permission') }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$permission->id}}">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Permission Name</label>
                            <input type="text" class="form-control" name="name" value="{{$permission->name}}">
                        </div> 
                        <div class="mb-3">
                            <label for="group_name" class="form-label">Group Name</label>
                            <select class="form-select form-select-lg" name="group_name">
                                <option selected="" disabled >Select Group</option>
                                <option value="property" {{$permission->group_name == 'property' ? 'selected' : ''}}>Property Type</option>
                                <option value="amenitie" {{$permission->group_name == 'amenitie' ? 'selected' : ''}}>Amenitie</option>
                                <option value="role" {{$permission->group_name == 'role' ? 'selected' : ''}}>Role & Permission</option>
                            </select>
                        </div>                       
                        <button type="submit" class="btn btn-inverse-primary me-2 px-4">Update Permission</button>
                    </form>
                    
                    
                </div>
              </div>    

          </div>
          <!-- right wrapper end -->


        </div>
    </div>

    
    @endsection