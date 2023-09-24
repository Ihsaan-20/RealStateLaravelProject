<?php

namespace App\Exports;

use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Concerns\FromCollection;

class PermissionExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //get all table data;
        // return Permission::all();

        // get selected data;
        return Permission::select('name', 'group_name')->get();
    }
}
