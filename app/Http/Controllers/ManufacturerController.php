<?php

namespace App\Http\Controllers;
use App\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    public function index()
    {
        return view('manufacturer.indexmanufacturer');
    }
        public function store(Request $request)
    {
        $manufacturer = new Manufacturer;
        $manufacturer->created_by=$request['created_by'];
        $manufacturer->manufacturers_name=$request['manufacturers_name'];
        $manufacturer->manufacturers_address=$request['manufacturers_address'];
        $manufacturer->contact_person=$request['contact_person'];
        $manufacturer->phone=$request['phone'];
        $manufacturer->email=$request['email'];

        $manufacturer->save();
    }
    public function edit($id)
    {
        $manufacturer = Manufacturer::find($id);
        echo json_encode($manufacturer);
    }
    public function update(Request $request, $id)
    {
        $manufacturer = Manufacturer::find($id);
        $manufacturer->created_by=$request['created_by'];
        $manufacturer->manufacturers_name=$request['manufacturers_name'];
        $manufacturer->manufacturers_address=$request['manufacturers_address'];
        $manufacturer->contact_person=$request['contact_person'];
        $manufacturer->phone=$request['phone'];
        $manufacturer->email=$request['email'];

        $manufacturer->update();
    }
    public function destroy($id)
    {
        $manufacturer = Manufacturer::find($id);
        $manufacturer->delete();
    }
}
