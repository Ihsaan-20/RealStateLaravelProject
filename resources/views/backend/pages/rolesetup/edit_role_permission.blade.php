@extends('admin.admin_dashboard')
    @section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <style>
     .form-check-label{
        text-transform: capitalize;
     }
      
    </style>

    <div class="page-content">

        <div class="row">
          <div class="col-12 grid-margin">
          </div>
        </div>
        <div class="row profile-body">

          <!-- right wrapper start -->
          <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Edit Role in Permission</h6>
                    <form id="myForm" action="{{ route('update.role.permission',$roles->id) }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                           <h3 class="text-warning mb-4">{{$roles->name}}</h3>
                        </div> 
                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" name="" id="checkDefaultMain">
                            <label class="form-check-label">Permission All</label>
                        </div> 
                        <hr>
                        {{-- row --}}
                        @foreach ($permission_groups as $perm )
                        <div class="row">

                            @php
                            $permissions= App\Models\User::getpermissionByGroup($perm->group_name);
                            @endphp

                            <div class="col-3">
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="checkDefault"
                                    {{ App\Models\User::roleHasPermissions($roles,$permissions) ? 'checked' : '' }}>
                                    <label class="form-check-label">{{$perm->group_name}}</label>
                                </div>  
                            </div>

                            <div class="col-9">
                               
                                @foreach ($permissions as $permission )   
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" 
                                            name="permission[]" value="{{$permission->id}}" 
                                            id="checkDefault{{$permission->id}}" {{$roles->hasPermissionTo($permission->name) ? 'checked' : ''}} />
                                    <label class="form-check-label" for="checkDefault{{$permission->id}}">{{$permission->name}}</label>
                                </div> 
                                @endforeach
                                <br>

                            </div>
                        </div> 
                            {{-- end row --}}
                        @endforeach

                        <button type="submit" class="btn btn-inverse-primary me-2 px-4">Update</button>
                    </form>
                    
                    
                </div>
              </div>    

          </div>
          <!-- right wrapper end -->


        </div>
    </div>
    <script>
        $('#checkDefaultMain').click(function(){
            if ($(this).is(':checked')) {
                $('input[type="checkbox"]').prop('checked', true);
            } else {
                $('input[type="checkbox"]').prop('checked', false);
            }
        });

    </script>

    @endsection