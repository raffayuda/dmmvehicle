<?php

namespace App\Http\Controllers;
use App\Workorder;
use App\Maintenance;
use App\Sparepart;
use App\Vehicle;
use DB;
use Illuminate\Http\Request;

class WorkorderpackageController extends Controller
{
    public function index()
    {
        // return view('workorderpackage.indexworkorderpackage');
    }
        public function store(Request $request)
    {
        
        // $workorderpackage = new workorderpackage;
        $workorderpackage->workorderpackages_date=$request['workorderpackages_date'];
        $workorderpackage->spareparts_id=$request['spareparts_id'];
        $workorderpackage->manufacture=$request['manufacture'];
        $workorderpackage->document=$request['document'];
        $workorderpackage->document_number=$request['document_number'];
        $workorderpackage->receipt_from=$request['receipt_from'];
        $workorderpackage->condition=$request['condition'];
        $workorderpackage->qty=$request['qty'];
        $workorderpackage->uom=$request['uom'];
        $workorderpackage->remarks=$request['remarks'];
        $workorderpackage->taken_by=$request['taken_by'];
        $workorderpackage->store_man=$request['store_man'];
        $workorderpackage->approved_by=$request['approved_by'];
        $workorderpackage->created_by=$request['created_by'];
        $workorderpackage->save();

        // $stock = DB::table('spareparts')->where('spareparts_id','=',$request['spareparts_id']);
        // $stock->increment('stock', $request['qty']);
        

        // ->where('spareparts_id','=',$request['spareparts_id'])
        

    }
    public function edit($id)
    {
        // $workorderpackage = workorderpackage::find($id);
        echo json_encode($workorderpackage);
    }
    public function update(Request $request, $id)
    {
        // $workorderpackage = workorderpackage::find($id);
        $workorderpackage->workorderpackages_date=$request['workorderpackages_date'];
        $workorderpackage->spareparts_id=$request['spareparts_id'];
        $workorderpackage->manufacture=$request['manufacture'];
        $workorderpackage->document=$request['document'];
        $workorderpackage->document_number=$request['document_number'];
        $workorderpackage->receipt_from=$request['receipt_from'];
        $workorderpackage->condition=$request['condition'];
        $workorderpackage->qty=$request['qty'];
        $workorderpackage->uom=$request['uom'];
        $workorderpackage->remarks=$request['remarks'];
        $workorderpackage->taken_by=$request['taken_by'];
        $workorderpackage->store_man=$request['store_man'];
        $workorderpackage->approved_by=$request['approved_by'];
        $workorderpackage->created_by=$request['created_by'];
        $workorderpackage->update();
    }
    public function destroy($id)
    {
        // $workorderpackage = workorderpackage::find($id);
        $workorderpackage->delete();
    }

    public function listworkorderpackage($id)
    {
        // $workorders = Workorder::orderBy('created_at','desc')->get();
        $workorders = DB::table('workorders')
            ->leftjoin('packages', 'packages.packages_id', '=', 'workorders.packages_id')
            ->leftjoin('vehicles', 'vehicles.vehicles_id', '=', 'workorders.vehicles_id')
        //     ->leftjoin('manufacturers', 'manufacturers.manufacturers_id', '=', 'workorders.manufacture')
        //     ->leftjoin('doctypes', 'doctypes.doctypes_id', '=', 'workorders.document')
        //     ->leftjoin('suppliers', 'suppliers.suppliers_id', '=', 'workorders.receipt_from')
        //     ->leftjoin('employees', 'employees.employees_id', '=', 'workorders.store_man')
            ->where('parent_wo','=',$id)
            ->get();
        $no = 0;
        $data = array();
        foreach($workorders as $workorder){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $workorder->nomor_lambung;
            $row[] = $workorder->packages_name;
            $row[] = $workorder->schedule_date;
            $row[] = $workorder->odo;
            $row[] = $workorder->problem;
            // $row[] = $workorder->status;

            if ($workorder->status != 'Done') {
                # code...
                $row[] = '<div>
                    <a href="/dmmvehicle/delpackage/'.$workorder->workorders_id.'" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
        $output = array("data"=>$data);
        return response()->json($output);
    }

    public function listworkorderpackageselect($vehicles_id,$work)
    {
        // $workorders = Workorder::orderBy('created_at','desc')->get();
        $workorders = DB::table('workorders')
            ->leftjoin('packages', 'packages.packages_id', '=', 'workorders.packages_id')
            ->leftjoin('vehicles', 'vehicles.vehicles_id', '=', 'workorders.vehicles_id')
        //     ->leftjoin('manufacturers', 'manufacturers.manufacturers_id', '=', 'workorders.manufacture')
        //     ->leftjoin('doctypes', 'doctypes.doctypes_id', '=', 'workorders.document')
        //     ->leftjoin('suppliers', 'suppliers.suppliers_id', '=', 'workorders.receipt_from')
        //     ->leftjoin('employees', 'employees.employees_id', '=', 'workorders.store_man')
            // ->where('workorders.parent_wo','!=','workorders.workorders_id')
            // ->whereColumn('workorders.parent_wo', 'workorders.workorders_id')
            // ->whereRaw('workorders.parent_wo = workorders.workorders_id')
            ->where('parent_wo','!=',$work)

            ->where('workorders.vehicles_id','=',$vehicles_id)
            ->where('status','!=','Done')
            ->get();
        $no = 0;
        $data = array();
        foreach($workorders as $workorder){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $workorder->nomor_lambung;
            $row[] = $workorder->packages_name;
            $row[] = $workorder->schedule_date;
            $row[] = $workorder->odo;
            $row[] = $workorder->problem;


            $row[] = '<div>
                    <a href="/dmmvehicle/addpackage/'.$workorder->workorders_id.'/'.$work.'" class="btn btn-info"><i class="fa fa-plus"></i></a>
                    </div>';

            // $row[] = '<div>
            //         <a onCLick="editForm('.$workorder->workorders_id.')" class="btn btn-info"><i class="fa fa-edit"></i></a>
            //         <a onClick="deleteData('.$workorder->workorders_id.')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            //         </div>';
            $data[]=$row;
        
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }
    public function addpackage(Request $request, $id, $work)
    {
        $addpackage = Workorder::find($id);
        $addpackage->parent_wo=$work;
        $addpackage->merged='1';
              
        $addpackage->update();

        $mainpack = Maintenance::where('workorders_id',$id)->first();
        $mainpack->parent_wo=$work;
        $mainpack->update();

        return back();
    }

    public function delpackage(Request $request, $id)
    {

        $addpackage = Workorder::find($id);
        $addpackage->parent_wo=$id;
        $addpackage->time='';
        $addpackage->mechanic='';
        $addpackage->leading_head='';
        $addpackage->coordinator='';
        $addpackage->note='';
        $addpackage->status='Scheduled';
        $addpackage->merged='0';

        $addpackage->update();
        $mainpack = Maintenance::where('workorders_id',$id)->first();
        $mainpack->parent_wo=$id;
        $mainpack->update();
        return back();
    }
}
