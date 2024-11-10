<?php

namespace App\Http\Controllers;
use App\Requisition;
use App\Requested;
use Carbon\Carbon;
use DB;
use Auth;
use Illuminate\Http\Request;

class RequisitionController extends Controller
{
    public function index()
    {
        $idmaxs = DB::table('requisitions')->max('requisitions_id');
        $idmax = $idmaxs+1;
        // $price = DB::table('orders')->max('price');
        return view('requisition.indexrequisition',compact('idmax'));
    }
    public function create()
    {
        $requisition = new Requisition;

        $requisition->created_by=Auth::user()->name;
        $requisition->status='Draft';
        
        $requisition->save();

        $lastInsertedId = $requisition->requisitions_id;
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
        $spr_alias = "DMM/$lastInsertedId/SPR/$month/$year";
        // return($spr_alias);
        $updatespr = Requisition::find($lastInsertedId);
        $updatespr->spr_alias=$spr_alias;
        $updatespr->update();
        return redirect()->route('requisition.show', [$lastInsertedId]);

       
    }

    public function createspr(Request $request)
    {
        $requisition = new Requisition;

        $requisition->created_by=Auth::user()->name;
        $requisition->status='Draft';
        $requisition->procurement_method=$request['procurement_method'];
        $requisition->remarks=$request['remarks'];
        $requisition->save();
        $lastInsertedId = $requisition->requisitions_id;
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
        $spr_alias = "DMM/$lastInsertedId/SPR/$month/$year";
        // return($spr_alias);
        $updatespr = Requisition::find($lastInsertedId);
        $updatespr->spr_alias=$spr_alias;
        $updatespr->update();
        return redirect()->route('requisition.show', [$lastInsertedId]);

       
    }
    public function show($id)
    {
        $lastInsertedId = $id;
        $count = Requested::where('requisitions_id', $lastInsertedId)->count();
        $status = Requisition::find($lastInsertedId);
        
        return view('requisition.formrequisition',compact('lastInsertedId','count','status'));
    }
        public function store(Request $request)
    {
        $requisition = new Requisition;
        $requisition->requisitions_id=$request['requisitions_id'];
        $requisition->spareparts_id=$request['spareparts_id'];
        $requisition->spareparts_name=$request['spareparts_name'];
        $requisition->qty=$request['qty'];
        $requisition->po_number=$request['po_number'];
        $requisition->status=$request['status'];
        $requisition->created_by=$request['created_by'];
        // $requisition->procurement_method=$request['procurement_method'];
        // $requisition->remarks=$request['remarks'];

        $requisition->save();
        // return('aku');
    }
    public function edit($id)
    {
        $requisition = Requisition::find($id);
        echo json_encode($requisition);
    }
    public function update(Request $request, $id)
    {
        $requisition = Requisition::find($id);
        $requisition->requisitions_id=$request['requisitions_id'];
        $requisition->spareparts_id=$request['spareparts_id'];
        $requisition->spareparts_name=$request['spareparts_name'];
        $requisition->qty=$request['qty'];
        $requisition->po_number=$request['po_number'];
        $requisition->status=$request['status'];
        $requisition->created_by=$request['created_by'];



        $requisition->update();
    }
    

    public function destroy($id)
    {
        $requisition = Requisition::find($id);
        $requisition->delete();
    }

    public function listrequisition()
    {
        
        $requisitions = Requisition::orderBy('created_at','desc')->get();

        
        $no = 0;
        $data = array();
        foreach($requisitions as $requisition){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $requisition->spr_alias;
            // $row[] = sprintf("%'.09d\n",$requisition->requisitions_id);
            $row[] = tanggal_indo($requisition->created_at);
            $count = Requested::where('requisitions_id', $requisition->requisitions_id)->count();
            $row[] = $count;
            $row[] = $requisition->po_alias;
            $row[] = $requisition->status;
            $row[] = $requisition->created_by;
            $row[] = '<div>

                    <a href="requisition/'.$requisition->requisitions_id.'" class="btn btn-info"><i class="fa fa-edit"></i></a>
                    </div>';
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }
    public function requisitionsend($id)
    {
        // return($id);
        $requisition = Requisition::find($id);
        $requisition->status='Submitted';
        $requisition->update();
        // return($requisition);
        return redirect()->route('requisition.index');

    }
    public function requisitionacknowledge($id)
    {
        // return($id);
        $requisition = Requisition::find($id);
        $requisition->status='Acknowledge';
        $now = Carbon::now();

        $requisition->acknowledge_by=Auth::user()->name;
        $requisition->acknowledge_date=$now;
        $requisition->update();
        // return($requisition);
        return redirect()->route('requisition.index');

    }
    public function requisitionapprove($id)
    {
        $requisition = Requisition::find($id);
        $requisition->status='Approved';
        $now = Carbon::now();

        $requisition->approved_by=Auth::user()->name;
        $requisition->approved_date=$now;
        $requisition->update();
        return redirect()->route('requisition.index');

    }
    function sendSubmit(Request $request)
    {
    //  $this->validate($request, [
    //   'name'     =>  'required',
    //   'email'  =>  'required|email',
    //   'message' =>  'required'
    //  ]);
return($request);
        $data = array(
            'name'      =>  $request->name,
            'message'   =>   $request->message
        );

     Mail::to('andi.ruswandi@gmail.com')->send(new SendMail($data));
     return back()->with('success', 'Thanks for contacting us!');

    }
}
