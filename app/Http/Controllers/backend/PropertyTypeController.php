<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PropertyType;
use App\Models\Amenitie;

class PropertyTypeController extends Controller
{
    public function AllType()
    {
        $types = PropertyType::latest()->get();
        return view('backend.type.all_type', compact('types'));
    } //end method;

    public function AddType()
    {
        return view('backend.type.addType');
    } //end method;

    public function StoreType(Request $request){
        $request->validate([
            'type_name' => 'required|unique:property_types',
            'icon_type' => 'required'
        ]);

        PropertyType::insert([
            'type_name' => $request->type_name,
            'icon_type' => $request->icon_type
        ]);

        $notification = array(
            'message' => 'Property Type Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.type')->with($notification);

    }//end method;

    public function EditType($id){
        $types = PropertyType::findOrFail($id);
        return view('backend.type.editType', compact('types'));
    }//end method;

    public function UpdateType(Request $request){
        $id = $request->id;
        $request->validate([
            'type_name' => 'required|unique:property_types',
            'icon_type' => 'required'
        ]);

        PropertyType::findOrFail($id)->update([
            'type_name' => $request->type_name,
            'icon_type' => $request->icon_type
        ]);

        $notification = array(
            'message' => 'Property Type Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.type')->with($notification);

    }//end method;

    public function DeleteType($id){
        PropertyType::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Property Type Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.type')->with($notification);
    }

// Amenitie functions *********************************************
//-----------------------------------------------------------------
//-----------------------------------------------------------------

public function AllAmenitie(){
        $amenities = Amenitie::latest()->get();
        return view('backend.amenitie.allAmenitie', compact('amenities'));
    } //end method;
    
    public function AddAmenitie(){
        return view('backend.amenitie.addAmenitie');
    } //end method;

    public function StoreAmenitie(Request $request){
        $request->validate([
            'amenitie_name' => 'required|unique:amenities',
        ]);

        Amenitie::insert([
            'amenitie_name' => $request->amenitie_name,
        ]);

        $notification = array(
            'message' => 'Amenitie Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.amenitie')->with($notification);

    }//end method;

    public function EditAmenitie($id){
        $amenities = Amenitie::findOrFail($id);
        return view('backend.amenitie.editAmenitie', compact('amenities'));
    }//end method;

    public function UpdateAmenitie(Request $request){
        $id = $request->id;
        $request->validate([
            'amenitie_name' => 'required|unique:amenities',
        ]);

        Amenitie::findOrFail($id)->update([
            'amenitie_name' => $request->amenitie_name,
        ]);

        $notification = array(
            'message' => 'Amenitie Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.amenitie')->with($notification);

    }//end method;

    public function DeleteAmenitie($id){
        Amenitie::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Amenitie Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.amenitie')->with($notification);
    }



    
}
