<?php

namespace App\Http\Controllers;
use App\Workorder;
use App\Maintenance;
use App\Sparepart;
use App\Vehicle;
use App\Employee;
use App\Partpackage;
use App\Prdetail;
use Auth;
use Carbon\Carbon;
use App\Package;

use DB;
use PDF;
use Illuminate\Http\Request;

class WorkorderController extends Controller
{
    public function index()
    {
        return view('workorder.indexworkorder');
    }
        public function store(Request $request)
    {
        $workorder = new Workorder;
        $workorder->schedule_date=$request['schedule_date'];
        $workorder->vehicles_id=$request['vehicles_id'];
        $workorder->packages_id=17;
        $workorder->problem=$request['problem'];
        $workorder->status='Scheduled';
        $workorder->merged='0';
        $workorder->created_by=$request['created_by'];
        $workorder->save();
        $lastInsertedId = $workorder->workorders_id;

        

        $parent = Workorder::find($lastInsertedId);
        $parent->parent_wo=$lastInsertedId;
        $parent->update();

        $parentman = new Maintenance;
        $parentman->workorders_id=$lastInsertedId;
        $parentman->parent_wo=$lastInsertedId;
        $parentman->vehicles_id=$request['vehicles_id'];
        $parentman->packages_id=17;
        $parentman->report_date=$request['schedule_date'];
        $parentman->last_date=$request['schedule_date'];
        $parentman->due_date=$request['schedule_date'];
        $parentman->status='Scheduled';
        $parentman->created_by=Auth::user()->name;
        $parentman->save();
        
    }
    public function edit($id)
    {

        // $workorder = Workorder::find($id);
        $workorder = DB::table('workorders')
            ->leftjoin('vehicles', 'vehicles.vehicles_id', '=', 'workorders.vehicles_id')
            ->where('workorders_id','=',$id)
            ->first();

        $maintenance = Maintenance::where('maintenances.vehicles_id','=',  $workorder->vehicles_id)
            ->join('vehicles', 'vehicles.vehicles_id','=','maintenances.vehicles_id')
            ->where('parent_wo','!=',$workorder->parent_wo)
            ->where('status','!=','Done')
            ->get();
        $sparepart = Sparepart::all();
        $no=1;
        // echo json_encode($workorder);
        return view('workorder.formwo',compact('workorder','id','maintenance','no','sparepart'));
    }
    public function update(Request $request, $id)
    {
        $workorder = Workorder::find($id);
        $workorder->workorders_date=$request['workorders_date'];
        $workorder->spareparts_id=$request['spareparts_id'];
        $workorder->manufacture=$request['manufacture'];
        $workorder->document=$request['document'];
        $workorder->document_number=$request['document_number'];
        $workorder->receipt_from=$request['receipt_from'];
        $workorder->condition=$request['condition'];
        $workorder->qty=$request['qty'];
        $workorder->uom=$request['uom'];
        $workorder->remarks=$request['remarks'];
        $workorder->taken_by=$request['taken_by'];
        $workorder->store_man=$request['store_man'];
        $workorder->approved_by=$request['approved_by'];
        $workorder->created_by=$request['created_by'];




        $workorder->update();
    }
    public function destroy($id)
    {
        $workorder = Workorder::find($id);
        $workorder->delete();
    }
    

    public function listworkorder()
    {
        
        // $workorders = Workorder::orderBy('created_at','desc')->get();
        $workorders = DB::table('workorders')
            ->leftjoin('packages', 'packages.packages_id', '=', 'workorders.packages_id')
            ->leftjoin('vehicles', 'vehicles.vehicles_id', '=', 'workorders.vehicles_id')
        //     ->leftjoin('manufacturers', 'manufacturers.manufacturers_id', '=', 'workorders.manufacture')
        //     ->leftjoin('doctypes', 'doctypes.doctypes_id', '=', 'workorders.document')
        //     ->leftjoin('suppliers', 'suppliers.suppliers_id', '=', 'workorders.receipt_from')
        //     ->leftjoin('employees', 'employees.employees_id', '=', 'workorders.store_man')
            ->where('workorders.merged','!=',1)
            ->where('workorders.status','!=','Done')
            ->get();
            // return($workorders);
        $no = 0;
        $data = array();
        foreach($workorders as $workorder){
            if ($workorder->status == 'Done') {
                # code...
            }
            if ($workorder->status == 'Hide') {
                # code...
            } else {
                # code...
                $no++;
            $row=array();
            $row[] = $no;
            $row[] = $workorder->schedule_date;
            $row[] = $workorder->time;
            $row[] = $workorder->wo_date;
            $row[] = $workorder->wo_alias;
            $row[] = $workorder->packages_name;
            $row[] = $workorder->odo;
            $row[] = $workorder->nomor_lambung;
            $row[] = $workorder->location;
            $row[] = $workorder->note;
            $row[] = $workorder->problem;
            $row[] = $workorder->mechanic;
            $row[] = $workorder->leading_head;
            $row[] = $workorder->coordinator;
            $row[] = $workorder->status;

            if ($workorder->status != 'Done') {
                # code...
                $row[] = '<div>
                    <a href="workorder/'.$workorder->workorders_id.'/edit" class="btn btn-info"><i class="fa fa-edit"></i></a>
                    </div>';
            } else {
                # code...
                $row[] = '-';
            }
            
            

            // $row[] = '<div>
            //         <a onCLick="editForm('.$workorder->workorders_id.')" class="btn btn-info"><i class="fa fa-edit"></i></a>
            //         <a onClick="deleteData('.$workorder->workorders_id.')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            //         </div>';
            $data[]=$row;
            }
            
            
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }
    public function savewo(Request $request)
    {

        $mechanic = Employee::find($request->mechanic);

        if (!empty($mechanic)) {
            $mechanic = $mechanic->employees_name;
        } else {
            $mechanic = $request->mechanic;
        }
        
        $leading_head = Employee::find($request->leading_head);
        if (!empty($leading_head)) {
            $leading_head = $leading_head->employees_name;
        } else {
            $leading_head = $request->leading_head;
        }
        // return($leading_head);
        $coordinator = Employee::find($request->coordinator);
        if (!empty($coordinator)) {
            $coordinator = $coordinator->employees_name;
        } else {
            $coordinator = $request->coordinator;
        }
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
        $wo_alias = "DMM/$request->id/WO/$month/$year";
        // return($request->id);
        Workorder::where('parent_wo', '=', $request->id)
        ->update([
            'wo_date' => $request->wo_date,
            'wo_alias' => $wo_alias,
            'odo' => $request->odo,
            'time' => $request->time,
            'note' => $request->note,
            'mechanic' => $mechanic,
            'location' => $request->location,
            'leading_head' => $leading_head,
            'coordinator' => $coordinator,
            'status' => 'Created'
        ]);
        Maintenance::where('parent_wo', '=', $request->id)
        ->update([
            'parent_wo' => $request->id,
        ]);

        return back();

    }
    public function history()
    {
        return view('workorder.history');
    }
    public function listhistory()
    {
        $historys = Workorder::orderBy('updated_at','desc')
        ->orderBy('vehicles_id','asc')
        ->where('status','=','Done')
	->limit(1200)
	->get();
        $no = 0;
        $data = array();
        foreach($historys as $history){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $history->wo_date;
            $row[] = $history->wo_alias;
            
            $vehicle = Vehicle::find($history->vehicles_id);
            $row[] = $vehicle->nomor_lambung;
            $row[] = $vehicle->nomor_polisi;
            $package = Package::find($history->packages_id);
            $row[] = $package->packages_name;
            $row[] = $history->odo;
            $row[] = $history->in_progress_date;
            $row[] = $history->done_date;
            $row[] = $history->problem;
            $row[] = $history->result;
            $parts = DB::table('partpackages')
                ->select('spareparts_id','wo_qty')
                ->where('workorders_id', '=', $history->workorders_id)
                // ->whereNotNull('action_follow_up')
                ->orderBy('updated_at','desc')
                ->get();
                $datafoll = array();
                $ni = 0;
                foreach($parts as $part){
                $remarkf=array();
                // $remarko[] = $remark->report_date;
                if ($ni++==0) {
                    // $remarkf[] = $action_follow_up->date ;
                    $partname=Sparepart::find($part->spareparts_id);

                    $remarkf[] = str_replace(',','',$partname->spareparts_name);
                    // $remarkf[] = '='.preg_replace('/[,]/','aaa',$part->wo_qty);
                    $remarkf[] = '='.str_replace(',','',$part->wo_qty);


                    // str_replace('_', ' ', $str)
                } else {
                    // $remarkf[] = "<br />".$action_follow_up->date ;
                    $partname=Sparepart::find($part->spareparts_id);

                    $remarkf[] = "<br />".str_replace(',','',$partname->spareparts_name);
                    $remarkf[] = '='.str_replace('','',$part->wo_qty)."<br />";
                    // $remarkf[] = 'andi';

                }                
                $datafoll[]=str_replace('','',$remarkf);
                }      
            $row[] = $datafoll;
            // $part=Partpackage::where('workorders_id',$history->workorders_id)->get();
            // $row[] = $part;
            $row[] = $history->deferred_item;
            $row[] = $history->mechanic;
            $row[] = $history->status;


            // $row[] = '<div>
            //         <a href="workorder/'.$history->workorders_id.'/edit" class="btn btn-info"><i class="fa fa-edit"></i></a>
            //         </div>';

            // $row[] = '<div>
            //         <a onCLick="editForm('.$workorder->workorders_id.')" class="btn btn-info"><i class="fa fa-edit"></i></a>
            //         <a onClick="deleteData('.$workorder->workorders_id.')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            //         </div>';
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }
    public function printwo($id)
    {
        // $datastock = Sparepart::find($id);
        // // $datastock = DB::table('spareparts')
        // //     ->leftjoin('vehiclemodels', 'vehiclemodels.vehiclemodels_id', '=', 'spareparts.vehiclemodels_id')
        // //     ->where('spareparts.spareparts_id',$id)
        // //     ->first();
        
        
        // // $datastock = json_encode($datastocks);
        // $data = Sparepart::find($id);
        // // return($data);

        // // $grns = Grn::where('spareparts_id','=',$id)->get();
        // $grns = DB::table('spareparts')
        // ->leftJoin('grns','grns.spareparts_id','=','spareparts.spareparts_id')
        // ->leftJoin('gins','gins.spareparts_id','=','spareparts.spareparts_id')
        // ->where('spareparts.spareparts_id','=',$id)
        // ->select('grns.grns_date as date','grns.qty as in','gins.qty as out','gins.qty as total','spareparts.uom as oum')
        // ->get();
        // return($maintenance);
        $workorderparent = Workorder::find($id);
        $vehicle = Vehicle::find($workorderparent->vehicles_id);


        $workorders = DB::table('workorders')
            ->leftjoin('packages', 'packages.packages_id', '=', 'workorders.packages_id')
            ->where('parent_wo',$id)
            ->get();

         $partpackages = DB::table('partpackages')
            ->leftjoin('spareparts', 'spareparts.spareparts_id', '=', 'partpackages.spareparts_id')
            ->where('workorders_id',$id)
            ->get();
        // return($workorderparent);
        $no = 0;
        $noo = 0;
        $nooo = 0;
        $pdf = PDF::loadView('workorder.printwo',compact('partpackages','vehicle','id','nooo','noo','no','workorders','workorderparent'));
        $pdf->setPaper('legal','potrait');
        return $pdf->stream();
    }

    public function inprogress($id)
    {
        Workorder::where('parent_wo', '=', $id)
        ->update([
            'status' => 'In Progress',
        ]);
        Maintenance::where('parent_wo', '=', $id)
        ->update([
            'status' => 'In Progress',
        ]);
        // $workorder=Maintenance::find($id);
        // $workorder->status='In Progress';
        // $workorder->update();
        return back();
    }

    public function pending($id)
    {
        // $workorder=Workorder::find($id);
        // $workorder->status='Pending';
        // $workorder->update();

        Workorder::where('parent_wo', '=', $id)
        ->update([
            'status' => 'Pending',
        ]);
        Maintenance::where('parent_wo', '=', $id)
        ->update([
            'status' => 'Pending',
        ]);
        // $workorder=Maintenance::find($id);
        // $workorder->status='In Progress';
        // $workorder->update();
        return back();
    }

    public function wodone($id)
    {
        $workorder = DB::table('workorders')
            ->leftjoin('vehicles', 'vehicles.vehicles_id', '=', 'workorders.vehicles_id')
            ->where('workorders_id','=',$id)
            ->first();
        $nows = Carbon::today();
        $now = tanggal_db($nows);
        return view('workorder.formwodone',compact('workorder','id','maintenance','no','sparepart','now'));


    }

    public function done(Request $request, $id)
    {
        Maintenance::where('parent_wo', '=', $id)
        ->update([
            'status' => 'Done',
        ]);
        Workorder::where('parent_wo', '=', $id)
        ->update([
            'done_date' => $request->done_date,
            'result' => $request->result,
            'deferred_item' => $request->deferred_item,
            'status' => 'Done',
        ]);
        $maintenances = Maintenance::where('parent_wo', '=', $id)->get();
                    // return($maintenances);


        foreach($maintenances as $maintenance){
            if ($maintenance->packages_id == 1) {
                # code...
        // return($maintenance);

                $done_date=$request->done_date;
                $done_dates=Carbon::parse($done_date);
                $next_packages = Package::find($maintenance->packages_id);
                $next_package = $next_packages->next_packages_id;
                $next_dates = $done_dates->add($next_packages->day,'day');
                $next_date = tanggal_db($next_dates);


                $maintenanced = new Maintenance;
                $maintenanced->vehicles_id=$maintenance->vehicles_id;
                $maintenanced->packages_id=$next_package;
                $maintenanced->report_date=$done_date;
                $maintenanced->last_date=$done_date;
                $maintenanced->due_date=$next_date;
                $maintenanced->status='Open';
                $maintenanced->created_by=Auth::user()->name;
                $maintenanced->save();

                // $maintenance->save();
            // return($next_date);
                

            } elseif ($maintenance->packages_id == 17) {
                    # code...
                    //  return('robbing');

                    $partdetails = Partpackage::where('workorders_id',$id)->get();
                    // return($partdetails);

                    foreach ($partdetails as $partdetail) {
                        # code...
                        $prdetail = new Prdetail;
                        $prdetail->workorders_id = $id;
                        $prdetail->spareparts_id = $partdetail->spareparts_id;
                        $prdetail->spareparts_id = $partdetail->wo_qty;
                        $prdetail->created_by = Auth::user()->name;
                        $prdetail->save();
                    }
            } elseif ($maintenance->packages_id == 2) {
                    # code...
                

                   
            } elseif ($maintenance->packages_id == 3) {
                    # code...
                
            } elseif ($maintenance->packages_id == 16) {
                    # code...
                
            } elseif ($maintenance->packages_id == 17) {
                                # code...
                            

                    
            } else{
                    $done_date=$request->done_date;
                    $done_dates=Carbon::parse($done_date);
                        // Carbon::parse($date);
                    $next_packages = Package::find($maintenance->packages_id);
                    $next_package = $next_packages->next_packages_id;
                    $estimation = $next_packages->km/200;
                    $next_dates = $done_dates->add($estimation,'day');
                    $next_date = tanggal_db($next_dates);

                    // if(!empty($next_packages)){
                        $maintenanced = new Maintenance;
                        $maintenanced->vehicles_id=$maintenance->vehicles_id;
                        $maintenanced->packages_id=$next_package;
                        $maintenanced->report_date=$done_date;
                        $maintenanced->last_date=$done_date;
                        $maintenanced->due_date=$next_date;
                        $maintenanced->last_km=$maintenance->next_km; //nanti di update dengan WO ODO
                        $maintenanced->next_km=$maintenance->next_km + $next_packages->km;
                        $maintenanced->status='Open';
                        $maintenanced->created_by=Auth::user()->name;
                        $maintenanced->save();
                    // }
                    
            }
                
            
            }
            
       
        return redirect()->route('history');
    }
}