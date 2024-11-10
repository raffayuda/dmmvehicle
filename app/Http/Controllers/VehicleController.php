<?php

namespace App\Http\Controllers;
use App\Vehicle;
use App\Lisence;
use DB;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        return view('vehicle.indexvehicle');
    }
        public function store(Request $request)
    {
        $vehicle = new Vehicle;
        $vehicle->vehiclemodels_id=$request['vehiclemodels_id'];
        $vehicle->manufacturers_id=$request['manufacturers_id'];
        $vehicle->nomor_lambung=$request['nomor_lambung'];
        $vehicle->nomor_polisi=$request['nomor_polisi'];
        $vehicle->tahun_pembuatan=$request['tahun_pembuatan'];
        $vehicle->nomor_rangka=$request['nomor_rangka'];
        $vehicle->nomor_mesin=$request['nomor_mesin'];
        $vehicle->nomor_polis=$request['nomor_polis'];
        $vehicle->created_by=$request['created_by'];
        $vehicle->save();


        $lastInsertedId = $vehicle->vehicles_id;

        $lisence = new Lisence;
        $lisence->vehicles_id=$lastInsertedId;
        $lisence->created_by=$request['created_by'];
        // $lisence->created_by=$request['created_by'];
        $lisence->save();





        
    }
    public function edit($id)
    {
        $vehicle = Vehicle::find($id);
        echo json_encode($vehicle);
    }
    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::find($id);
        $vehicle->vehiclemodels_id=$request['vehiclemodels_id'];
        $vehicle->manufacturers_id=$request['manufacturers_id'];
        $vehicle->nomor_lambung=$request['nomor_lambung'];
        $vehicle->nomor_polisi=$request['nomor_polisi'];
        $vehicle->tahun_pembuatan=$request['tahun_pembuatan'];
        $vehicle->nomor_rangka=$request['nomor_rangka'];
        $vehicle->nomor_mesin=$request['nomor_mesin'];
        $vehicle->nomor_polis=$request['nomor_polis'];
        $vehicle->created_by=$request['created_by'];




        $vehicle->update();
    }
    public function destroy($id)
    {
        $vehicle = Vehicle::find($id);
        $vehicle->delete();
        $lisence = Lisence::find($id);
        $lisence->delete();
    }

    public function listvehicle()
    {
        
        // $vehicles = Vehicle::orderBy('created_at','desc')->get();
        $vehicles = DB::table('vehicles')
            ->leftjoin('vehiclemodels', 'vehiclemodels.vehiclemodels_id', '=', 'vehicles.vehiclemodels_id')
            ->leftjoin('manufacturers', 'manufacturers.manufacturers_id', '=', 'vehicles.manufacturers_id')
            ->get();
            // return($vehicles);
        $no = 0;
        $data = array();
        foreach($vehicles as $vehicle){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $vehicle->vehiclemodels_name;
            $row[] = $vehicle->manufacturers_name;
            $row[] = $vehicle->nomor_lambung;
            $row[] = $vehicle->nomor_polisi;
            $row[] = $vehicle->tahun_pembuatan;
            $row[] = $vehicle->nomor_rangka;
            $row[] = $vehicle->nomor_mesin;
            $row[] = $vehicle->nomor_polis;



            $row[] = '<div>
                    <a onCLick="editForm('.$vehicle->vehicles_id.')" class="btn btn-info"><i class="fa fa-edit"></i></a>
                    <a onClick="deleteData('.$vehicle->vehicles_id.')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </div>';
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }
}
