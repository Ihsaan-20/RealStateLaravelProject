<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PermissionExport;
use App\Imports\ImportPermission;
use App\Models\{User};
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function AllPermission(){
        $permissions = Permission::all();
        return view('backend.pages.permissions.all_permission', compact('permissions'));
    }//end method;

    public function AddPermission(){
        return view('backend.pages.permissions.add_permission');
    }//end method;

    public function StorePermission(Request $request){
        // dd($request->all());
        Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name
        ]);

        $notification = [
            'message' => 'Permission Create Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.permission')->with($notification);
    }//end method;

    public function EditPermission($id){
        $permission = Permission::findOrFail($id);
        return view('backend.pages.permissions.edit_permission', compact('permission'));
    }//end method;

    public function UpdatePermission(Request $request){
        $per_id = $request->id;

        Permission::findOrFail($per_id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name
        ]);

        $notification = [
            'message' => 'Permission Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.permission')->with($notification);

    }//end method;

    public function DeletePermission($id){
        Permission::findOrFail($id)->delete();
        $notification = [
            'message' => 'Permission Deleted Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('all.permission')->with($notification);
    }//end method;

    /*
    =========================IMPORT & EXPORT=====================================
    =============================================================================
    */
    public function ImportPermission(){

        return view('backend.pages.permissions.import_permission');
        // return "working";
    }

    public function export() 
    {
        return Excel::download(new PermissionExport, 'permissions.xlsx');
    }//end method;

    public function import(Request $request) 
    {
        Excel::import(new ImportPermission, $request->file('import_file'));
        
        $notification = [
            'message' => 'File Imported Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('all.permission')->with($notification);
    }//end method;

    /*
    ========================= ROLE METHODS =====================================
    =============================================================================
    */
    public function AllRole(){
        $roles = Role::latest()->get();
        return view('backend.pages.roles.all_roles', compact('roles'));
    }//end method;

    public function AddRole(){
        return view('backend.pages.roles.add_role');
    }//end method;

    public function StoreRole(Request $request){
        // dd($request->all());
        Role::create([
            'name' => $request->name,
        ]);

        $notification = [
            'message' => 'Role Create Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.role')->with($notification);
    }//end method;

    public function EditRole($id){
        $roles = Role::findOrFail($id);
        return view('backend.pages.roles.edit_role', compact('roles'));
    }//end method;

    public function UpdateRole(Request $request){
        $role_id = $request->id;

        Role::findOrFail($role_id)->update([
            'name' => $request->name,
        ]);

        $notification = [
            'message' => 'Role Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.role')->with($notification);

    }//end method;

    public function DeleteRole($id){
        Role::findOrFail($id)->delete();
        $notification = [
            'message' => 'Role Deleted Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('all.role')->with($notification);
    }//end method;

    // 
     /*
    ========================= ROLE IN PERMISSION METHODS =====================================
    =============================================================================
    */
    public function AllRolePermission(){
        $roles = Role::all();
        return view('backend.pages.rolesetup.all_role_permission', compact('roles'));
    }//end method;

    public function AddRolePermission(){
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('backend.pages.rolesetup.add_role_permission', compact('roles','permissions','permission_groups'));
    }//end method;

    public function StoreRolePermission(Request $request){
        // dd($request->all());
       $data = array();
       $permissions = $request->permission;

       foreach ($permissions as  $item) {
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);
       }//end loop
        $notification = [
            'message' => 'Role Permission Added Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }//end method;

    public function EditRolePermission($id){
        $roles = Role::findOrFail($id);
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('backend.pages.rolesetup.edit_role_permission', compact('roles','permissions','permission_groups'));
    }//end method;

    public function UpdateRolePermission(Request $request, $id){
        $role = Role::findOrFail($id);
        $permissions = $request->permission;

        if( !empty($permissions)){
            $role->syncPermissions($permissions);
        }

        $notification = [
            'message' => 'Role Permission Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.role.permission')->with($notification);

    }//end method;

    public function DeleteRolePermission($id){
        $role = Role::findOrFail($id);
        if( !is_null($role)){
            $role->delete();
        }
        $notification = [
            'message' => 'Role Permission Deleted Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('all.role.permission')->with($notification);
    }//end method;



}
