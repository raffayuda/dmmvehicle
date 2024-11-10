<?php

namespace App\Http\Controllers;
use App\Maintenance;
use App\Package;
use App\Workorder;
use App\Packagepartcatalogue;
use App\Partpackage;
use App\Vehiclemodel;
use Carbon\Carbon;

use DB;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index()
    {
        return view('maintenance.indexmaintenance');
    }
        public function store(Request $request)
    {
        
        $maintenance = new Maintenance;
        $maintenance->maintenances_date=$request['maintenances_date'];
        $maintenance->spareparts_id=$request['spareparts_id'];
        $maintenance->manufacture=$request['manufacture'];
        $maintenance->document=$request['document'];
        $maintenance->document_number=$request['document_number'];
        $maintenance->receipt_from=$request['receipt_from'];
        $maintenance->condition=$request['condition'];
        $maintenance->qty=$request['qty'];
        $maintenance->uom=$request['uom'];
        $maintenance->remarks=$request['remarks'];
        $maintenance->taken_by=$request['taken_by'];
        $maintenance->store_man=$request['store_man'];
        $maintenance->approved_by=$request['approved_by'];
        $maintenance->created_by=$request['created_by'];
        $maintenance->save();
        

    }
    public function edit($id)
    {
        // $maintenance = Maintenance::find($id);
        $maintenance = DB::table('maintenances')
            ->leftjoin('packages', 'packages.packages_id', '=', 'maintenances.packages_id')
            ->leftjoin('vehicles', 'vehicles.vehicles_id', '=', 'maintenances.vehicles_id')
            ->where('maintenances.maintenances_id','=',$id)
            ->first();
        echo json_encode($maintenance);
    }
    public function update(Request $request, $id)
    {
        $maintenance = Maintenance::find($id);
        $maintenance->schedule_date=$request['schedule_date'];
        $maintenance->problem=$request['problem'];
        $maintenance->status='Scheduled';
        $maintenance->created_by=$request['created_by'];
        $maintenance->update();
        // dd($request);
        $workorder = new Workorder;
        $workorder->schedule_date=$request['schedule_date'];
        $workorder->vehicles_id=$request['vehicles_ids'];
        $workorder->packages_id=$request['packages_ids'];
        $workorder->odo=$request['last_km'];
        $workorder->problem=$request['problem'];
        $workorder->status='Scheduled';
        $workorder->merged='0';
        $workorder->created_by=$request['created_by'];
        $workorder->save();
        $lastInsertedId = $workorder->workorders_id;


        $now = Carbon::today();
        $date = tanggal_indo($now);
        $year = $now->year;
        $month = $now->month;
        if ($month == 1) {
            $month = 'I';
            } elseif($month == 2) {
            $month = 'II'; 
            } elseif($month == 3) {
            $month = 'III'; 
            } elseif($month == 4) {
            $month = 'IV'; 
            } elseif($month == 5) {
            $month = 'V'; 
            } elseif($month == 6) {
            $month = 'VI'; 
            } elseif($month == 7) {
            $month = 'VII'; 
            } elseif($month == 8) {
            $month = 'VIII'; 
            } elseif($month == 9) {
            $month = 'IX'; 
            } elseif($month == 10) {
            $month = 'X'; 
        } elseif($month == 11) {
            $month = 'XI';    
        } else {
            $month = 'XII';
            }

        $parent = Workorder::find($lastInsertedId);
        $parent->parent_wo=$lastInsertedId;
        $wo_alias = "DMM/$lastInsertedId/WO/$month/$year";
        $parent->wo_alias=$wo_alias;
        $parent->update();
        
        $maintenances = Maintenance::find($id);
        $maintenances->workorders_id=$lastInsertedId;
        $maintenances->parent_wo=$lastInsertedId;
        $maintenances->update();

        $packagepartcatalogues = Packagepartcatalogue::where('packages_id',$request['packages_ids'])
        ->orderBy('packagepartcatalogues_id','asc')->get();
        // return($packagepartcatalogues);
        foreach ($packagepartcatalogues as $packagepartcatalogue) {
            $partpackage = new Partpackage;
            $partpackage->workorders_id=$lastInsertedId;
            $partpackage->wo_alias=$wo_alias; 
            $partpackage->created_by=$request['created_by'];
            $partpackage->spareparts_id=$packagepartcatalogue->spareparts_id;
            $partpackage->wo_qty=$packagepartcatalogue->wo_qty;
            $partpackage->save();
        }
                

    }
    public function destroy($id)
    {
        $maintenance = Maintenance::find($id);
        $maintenance->delete();
    }

    public function listmaintenance()
    {
        $fisrtday = new Carbon('first day of January 2019');
        $now = Carbon::today();

        $duelimit = $now->add(6,'day');
        // return($duelimit);
        
        // $maintenances = Maintenance::orderBy('created_at','desc')->get();
        $maintenances = DB::table('maintenances')
            ->leftjoin('packages', 'packages.packages_id', '=', 'maintenances.packages_id')
            ->leftjoin('vehicles', 'vehicles.vehicles_id', '=', 'maintenances.vehicles_id')
            ->where('status','!=','Close')
            ->where('maintenances.due_date','>',$fisrtday)
            ->where('maintenances.due_date','<',$duelimit) // di comment sementara untuk perbaikan WO done oleh elsa
            ->orWhere('vehicles.vehiclemodels_id',2) //Memunculkan semua data Triton
            // ->orWhere('maintenances.problem','=','Munucl') 
            ->orderBy('due_date','asc')
            ->get();
            // return($maintenances);
        $no = 0;
        $data = array();
        foreach($maintenances as $maintenance){
            if ($maintenance->status == 'Open') {
                # code...
                $no++;
                $row=array();
                $row[] = $no;
                $type = Vehiclemodel::where('vehiclemodels_id',$maintenance->vehiclemodels_id)->first();
                $row[] = $type->vehiclemodels_name;
                $row[] = $maintenance->nomor_lambung;
                $row[] = $maintenance->report_date;
                if (!empty($maintenance->last_km)) {
                    # code...
                $row[] = format_uang($maintenance->last_km);

                } else {
                    # code...
                $row[] = $maintenance->last_km;

                }
                
                if (!empty($maintenance->next_km)) {
                    # code...
                $row[] = format_uang($maintenance->next_km);

                } else {
                    # code...
                $row[] = $maintenance->next_km;

                }
                
                $row[] = $maintenance->packages_name;
                $row[] = $maintenance->problem;
                // $row[] = $maintenance->next_km;
                $type = DB::table('packages')->leftJoin('types','types.types_id','=','packages.maintenance_type')->select('types.types_name as types_name')
                ->where('packages.packages_id',$maintenance->packages_id)->first();
                
                // return($type);
                $row[] = $type->types_name;
                // $row[] = '-';
                $row[] = $maintenance->last_date;
                $row[] = $maintenance->due_date;
                // if (!empty($maintenance->schedule_date)) {
                // $row[] = tanggal_indo($maintenance->schedule_date);
                // } else {
                $row[] = $maintenance->schedule_date;
                // }
                $row[] = $maintenance->status;
                if ($maintenance->status == 'Open') {
                    $row[] = '<div>
                        <a onCLick="editForm('.$maintenance->maintenances_id.')" class="btn btn-info"><i class="fa fa-edit">Schedule</i></a>
                        </div>';
                } else {
                    $row[] = '';
                }
                
                // $row[] = '<div>
                //         <a onCLick="editForm('.$maintenance->maintenances_id.')" class="btn btn-info"><i class="fa fa-edit">Schedulek</i></a>
                //         </div>';
                $data[]=$row;
            } else {
                # code...
            }
            
            
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }
}
