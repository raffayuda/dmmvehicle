<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Vehicle;
use App\Vehiclemodel;
use App\Package;
use App\Maintenance;
use Carbon\Carbon;
class CreatewoController extends Controller
{
    public function index()
    {
        // $id = 'bikin';
        // return view('createwo.indexcreatewo',compact('id'));
        return view('createwo.indexcreatewo');
    }
    public function create()
    {
        $id = 'bikin';
        // $prs_id = 0;
        // $part = Sparepart::all();
        return view('createwo.createwo',compact('id'));
    }

    public function listwomanual()
    {
        $wos = DB::table('vehicles')
            ->whereNull('initial_maintenance')
            ->orWhere('initial_maintenance','0')
            ->get();
        $no = 0;
        $data = array();
        foreach($wos as $wo){
            $no++;
            $row=array();
            $row[] = $no;
            $model = Vehiclemodel::find($wo->vehiclemodels_id);
            $row[] = $model->vehiclemodels_name;
            $row[] = $wo->nomor_lambung;
            
            $row[] = '
                    <a href="/dmmvehicle/createwo/'.$wo->vehicles_id.'/edit" class="btn btn-info"><i class="fa fa-edit">Create Maintenace Program</i></a>
                    </div>';
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }
    public function edit($id)
    {

        // $vehicle = Vehicle::find($id);
        $vehicle = DB::table('vehicles')
        ->leftJoin('vehiclemodels','vehiclemodels.vehiclemodels_id','=','vehicles.vehiclemodels_id')
        ->where('vehicles.vehicles_id',$id)
        ->first();
        $package = Package::where('vehiclemodels_id',$vehicle->vehiclemodels_id)->get();
        // return($vehicle);
        // return redirect()->route('pr.edit', [$id]);
        return view('createwo.editwo',compact('id','vehicle','package'));

    }
    public function update(Request $request, $id)
    {   
        // return($request);
        // $pr = Pr::find($id);
        // $pr->remarks = $request->remarks;
        // $pr->created_by = $request->created_by;
        // $pr->update();
        // return($request);
        $now = Carbon::today('Asia/Jakarta');
        // return($now);
        $cycle = Package::find($request->packages_id_prev);
        $day = $cycle->day; 
        // $last_maintenance = $request->last_date_prev;
        // $last_maintenance = date('Y-m-d', strtotime($request->last_date_prev));
        $last_maintenance = Carbon::parse($request->last_date_prev,'Asia/Jakarta');
        // return($last_maintenance);
        $due_dates = $last_maintenance->addDays($day);
        $due_date = date('Y-m-d', strtotime($due_dates));

        // return($due_date);

        $prev = new Maintenance;
        $prev->vehicles_id = $request->vehicles_id;
        $prev->packages_id = $request->packages_id_prev;
        $prev->report_date = tanggal_db($now);
        $prev->last_km = $request->last_km_prev;
        $prev->last_date = $request->last_date_prev;
        // $prev->next_km = $request->next_km_prev;
        $prev->due_date = $due_date;
        $prev->created_by = $request->created_by;
        $prev->status = 'Open';


        
        $prev->save();
        $cycles = Package::find($request->packages_id);

        $next_km = $request->last_km + $cycles->km;
        // return($cycles);
        $routine = new Maintenance;
        $routine->vehicles_id = $request->vehicles_id;
        $routine->packages_id = $cycles->next_packages_id;
        $routine->report_date = tanggal_db($now);

        $routine->last_km = $request->last_km;
        $routine->next_km = $next_km;
        $routine->last_date = $request->last_date;
        $routine->created_by = $request->created_by;

        $routine->status = 'Open';
        $routine->save();

        $vehicle = Vehicle::find($request->vehicles_id);
        $vehicle->initial_maintenance='1';
        $vehicle->update();

        // return view('createwo.indexcreatewo');
        return redirect()->route('createwo.index');

        // return view('pr.editpr',compact('id','pr'));

    }
}
