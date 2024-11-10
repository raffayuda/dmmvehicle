<?php

namespace App\Http\Controllers;
use App\Requested;
use App\Sparepart;
use App\Requisition;
use DB;
use Illuminate\Http\Request;

class RequestedController extends Controller
{
    public function index()
    {
        return view('requisition.formrequisition',compact('lastInsertedId'));
        // return view('requested.indexrequested');
    }
        public function store(Request $request)
    {
        // return($request);
        // dd($request);
        $requested = new Requested;
        $requested->requisitions_id=$request['requisitions_id'];
        $requested->spareparts_id=$request['spareparts_id'];
        $requested->qty=$request['qty'];
        $requested->spr_alias=$request['spr_alias'];
        $requested->remarks=$request['remarks'];
        $requested->procurement_method=$request['procurement_method'];
        $requested->created_by=$request['created_by'];
        $requested->save();

        // $requisition = Requisition::find(1);
        // $requisition->remarks=$request['remarks'];
        // $requisition->update();
        

    }
    // public function create($id)
    // {
    //     // return view
    //     $lastInsertedId = $id;
    //     return view('requisition.formrequisition',compact('lastInsertedId'));

    // }
    public function edit($id)
    {
        $requested = Requested::find($id);
        echo json_encode($requested);
    }
    public function update(Request $request, $id)
    {
        $requested = Requested::find($id);
        $requested->requisitions_id=$request['requisitions_id'];
        $requested->spareparts_id=$request['spareparts_id'];
        $requested->qty=$request['qty'];
        $requested->procurement_method=$request['procurement_method'];
        $requested->created_by=$request['created_by'];
        $requested->update();
    }
    public function destroy($id)
    {
        $requested = Requested::find($id);
        $requested->delete();
    }

    public function listrequested($id)
    {
        
        // $requesteds = Requested::orderBy('created_at','desc')
        // ->where('requisitions_id','=',$id)
        // ->get();
        $requesteds = DB::table('requesteds')
            ->leftjoin('spareparts', 'spareparts.spareparts_id', '=', 'requesteds.spareparts_id')
            
            ->where('requisitions_id','=',$id)
            
            ->get();
            // return($requesteds);
        $no = 0;
        $data = array();
        $totals = 0;
        foreach($requesteds as $requested){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $requested->part_number;
            $row[] = $requested->spareparts_name;
            $row[] = $requested->qty;
            $row[] = $requested->uom;
            // $row[] = $requested->procurement_method;
            $status = Requisition::find($id);
            // $status=$status->status;
            if ($status->status != 'Draft') {
                $row[] = '-';
               
            } else {
                 $row[] = '<div>
                    
                    <a onClick="deleteData('.$requested->requesteds_id.')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </div>';
            }
            
            
            $data[]=$row;
            // $totals += $total;

        }
            // $data[]=array("<span class='hide total'>$totals</span>");

        $output = array("data"=>$data);
        return response()->json($output);
    }
}
