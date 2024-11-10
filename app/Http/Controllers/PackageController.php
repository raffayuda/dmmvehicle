<?php

namespace App\Http\Controllers;
use App\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        return view('package.indexpackage');
    }
        public function store(Request $request)
    {
        $package = new Package;
        $package->packages_name=$request['packages_name'];
        $package->vehiclemodels_id=$request['vehiclemodels_id'];
        $package->maintenance_type=$request['maintenance_type'];
        $package->km=$request['km'];
        $package->day=$request['day'];
        $package->next_packages_id=$request['next_packages_id'];
        $package->created_by=$request['created_by'];

        $package->save();
    }
    public function edit($id)
    {
        $package = Package::find($id);
        echo json_encode($package);
    }
    public function update(Request $request, $id)
    {
        // return ($request);
        $package = Package::find($id);
        $package->packages_name=$request['packages_name'];
        $package->vehiclemodels_id=$request['vehiclemodels_id'];
        $package->maintenance_type=$request['maintenance_type'];
        $package->km=$request['km'];
        $package->day=$request['day'];
        $package->next_packages_id=$request['next_packages_id'];
        $package->created_by=$request['created_by'];

        $package->update();
    }
    public function destroy($id)
    {
        $package = Package::find($id);
        $package->delete();
    }
}
