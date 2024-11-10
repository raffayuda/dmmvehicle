<?php

namespace App\Http\Controllers;
use App\Vehiclemodel;
use Illuminate\Http\Request;

class VehiclemodelController extends Controller
{
    public function index()
    {
        return view('vehiclemodel.indexvehiclemodel');
    }
        public function store(Request $request)
    {
        $vehiclemodel = new VehicleModel;
        $vehiclemodel->created_by=$request['created_by'];
        $vehiclemodel->vehiclemodels_name=$request['vehiclemodels_name'];
        $vehiclemodel->save();
    }
    public function edit($id)
    {
        $vehicleModel = VehicleModel::find($id);
        echo json_encode($vehicleModel);
    }
    public function update(Request $request, $id)
    {
        // return ($request);
        $vehiclemodel = VehicleModel::find($id);
        $vehiclemodel->created_by=$request['created_by'];
        $vehiclemodel->vehiclemodels_name=$request['vehiclemodels_name'];
        $vehiclemodel->update();
    }
    public function destroy($id)
    {
        $vehicleModel = VehicleModel::find($id);
        $vehicleModel->delete();
    }
}
