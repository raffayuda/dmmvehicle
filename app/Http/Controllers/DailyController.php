<?php

namespace App\Http\Controllers;
use App\Daily;
use App\Maintenance;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DailyController extends Controller
{
    public function index()
    {
        return view('daily.indexdaily');
    }
        public function store(Request $request)
    {
        $daily = new Daily;
        $daily->vehicles_id=$request['vehicles_id'];
        $daily->log_date=$request['log_date'];
        $daily->odo=$request['odo'];
        $daily->driver=$request['driver'];
        $daily->fuel_topup=$request['fuel_topup'];
        $daily->equipement=$request['equipement'];
        $daily->condition=$request['condition'];
        $daily->problem=$request['problem'];
        $daily->created_by=$request['created_by'];

        $daily->save();

        $condition = $request['condition'];
        if ($condition == '2'){
        $maintenance = new Maintenance;
        $maintenance->vehicles_id=$request['vehicles_id'];
        $maintenance->packages_id=3;
        $maintenance->report_date=$request['log_date'];
        $maintenance->last_km=$request['odo'];
        $maintenance->next_km=$request['odo'];
        $maintenance->due_date=$request['log_date'];
        $maintenance->status='Open';
        $maintenance->problem=$request['problem'];
        $maintenance->created_by=$request['created_by'];

        $maintenance->save();

        }elseif ($condition == '3'){
            $cekbreakdown = Maintenance::where('packages_id','=',16)
            ->where('status','=','Open')
            ->where('vehicles_id','=',$request['vehicles_id'])
            ->count();
                if ($cekbreakdown < 1){
                $maintenance = new Maintenance;
                $maintenance->vehicles_id=$request['vehicles_id'];
                $maintenance->packages_id=16;
                $maintenance->report_date=$request['log_date'];
                $maintenance->last_km=$request['odo'];
                $maintenance->next_km=$request['odo'];
                $maintenance->due_date=$request['log_date'];
                $maintenance->status='Open';
                // $maintenance->problem=$request['problem'];
                $maintenance->problem=$cekbreakdown;
                $maintenance->created_by=$request['created_by'];

                $maintenance->save();
                }
        }
        
        
        // $finding = new Maintenance;

        // $finding->save();
    }
    public function edit($id)
    {
        $daily = Daily::find($id);
        echo json_encode($daily);
    }
    public function update(Request $request, $id)
    {
        $daily = Daily::find($id);
        $daily->vehicles_id=$request['vehicles_id'];
        $daily->log_date=$request['log_date'];
        $daily->odo=$request['odo'];
        $daily->driver=$request['driver'];
        $daily->fuel_topup=$request['fuel_topup'];
        $daily->equipement=$request['equipement'];
        $daily->condition=$request['condition'];
        $daily->problem=$request['problem'];
        $daily->created_by=$request['created_by'];

        $daily->update();
    }
    public function destroy($id)
    {
        $daily = Daily::find($id);
        $daily->delete();
    }

    public function listdaily()
    {
        $now = Carbon::today();
        $date = tanggal_indo($now);
        $dates = tanggal_db($now);
        // return($now);
        $year = $now->year;
        $month = $now->month;
        // $dailys = Daily::orderBy('created_at','desc')->get();
        $dailys = DB::table('dailies')
            ->leftjoin('vehicles', 'vehicles.vehicles_id', '=', 'dailies.vehicles_id')
            ->leftjoin('equipements', 'equipements.equipements_id', '=', 'dailies.equipement')
            ->leftjoin('conditions', 'conditions.conditions_id', '=', 'dailies.condition')
            ->leftjoin('employees', 'employees.employees_id', '=', 'dailies.driver')
            ->where('dailies.created_at','>',$now)
            ->orderBy('dailies.log_date','desc')
            ->get();
            // return($dailys);
        $no = 0;
        $data = array();
        foreach($dailys as $daily){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $daily->nomor_lambung;
            $row[] = $daily->log_date;

            $last_odo = Daily::where('vehicles_id',$daily->vehicles_id)->where('log_date','<',$daily->log_date)->orderBy('log_date','DESC')->first();
            if (!empty($last_odo)) {
                # code...
                $row[] = $last_odo->odo;
            
                if ($daily->odo <= $last_odo->odo  OR ($daily->odo-$last_odo->odo) >= 500) {
                    # code...
                $row[] = '<div style="color:red;">'.$daily->odo.'</div>';
                } else {
                    # code...
                $row[] = $daily->odo;
                }

            } else {
                # code...
                $row[] = '-';
                $row[] = $daily->odo;


            }
            
            
            
            $row[] = $daily->employees_name;
            $row[] = $daily->fuel_topup;
            $row[] = $daily->equipements_name;
            $row[] = $daily->conditions_name;
            $row[] = $daily->problem;



            $row[] = '<div>
                    <a onCLick="editForm('.$daily->dailies_id.')" class="btn btn-info"><i class="fa fa-edit"></i></a>
                    <a onClick="deleteData('.$daily->dailies_id.')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </div>';
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }
    public function dailyhistory()
    {
        return view('daily.dailyhistory');
    }

    public function listdailyhistory()
    {
        $now = Carbon::today();
        $date = tanggal_indo($now);
        $dates = tanggal_db($now);
        // return($now);
        $year = $now->year;
        $month = $now->month;
        // $dailys = Daily::orderBy('created_at','desc')->get();
        $dailys = DB::table('dailies')
            ->leftjoin('vehicles', 'vehicles.vehicles_id', '=', 'dailies.vehicles_id')
            ->leftjoin('equipements', 'equipements.equipements_id', '=', 'dailies.equipement')
            ->leftjoin('conditions', 'conditions.conditions_id', '=', 'dailies.condition')
            ->leftjoin('employees', 'employees.employees_id', '=', 'dailies.driver')
            ->orderBy('dailies.vehicles_id','ASC')
	    ->limit(1000)
            ->get();
            // return($dailys);
        $no = 0;
        $data = array();
        foreach($dailys as $daily){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $daily->nomor_lambung;
            $row[] = $daily->log_date;
            // $row[] = '<div style="text-align:right;">'.format_uang($daily->odo).'</div>';
             $last_odo = Daily::where('vehicles_id',$daily->vehicles_id)->where('log_date','<',$daily->log_date)->orderBy('log_date','DESC')->first();
            if (!empty($last_odo)) {
                # code...
                $row[] = $last_odo->odo;
            
                if ($daily->odo <= $last_odo->odo) {
                    # code...
                $row[] = '<div style="color:red;">'.$daily->odo.'</div>';
                } else {
                    # code...
                $row[] = $daily->odo;
                }

            } else {
                # code...
                $row[] = '-';
                $row[] = $daily->odo;


            }
            $row[] = $daily->employees_name;
            $row[] = $daily->fuel_topup;
            $row[] = $daily->equipements_name;
            $row[] = $daily->conditions_name;
            $row[] = $daily->problem;



            // $row[] = '<div>
            //         <a onCLick="editForm('.$daily->dailies_id.')" class="btn btn-info"><i class="fa fa-edit"></i></a>
            //         <a onClick="deleteData('.$daily->dailies_id.')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            //         </div>';
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }
}
