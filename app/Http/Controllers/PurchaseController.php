<?php

namespace App\Http\Controllers;
use App\Requisition;
use App\Requested;
use App\Sparepart;
use App\Vehiclemodel;
use Carbon\Carbon;
use App\Supplier;
use App\Grn;
use DB;
use PDF;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        return view('purchase.indexpurchase');
    }
    public function create()
    {
        $requisition = new Requisition;

        $requisition->created_by=Auth::user()->name;
        $requisition->save();
        $lastInsertedId = $requisition->requisitions_id;
        return redirect()->route('requisition.show', [$lastInsertedId]);

       
    }
    public function show($id)
    {
        // dd('here');
        $lastInsertedId = $id;
        // return($id);
        $requesteds = DB::table('requesteds')
            ->leftjoin('spareparts', 'spareparts.spareparts_id', '=', 'requesteds.spareparts_id')
            
            ->where('requisitions_id','=',$id)
            
            ->get();
        $total = 0;
        $no = 0;
        $requisition=Requisition::find($id);
        if ($requisition->status != 'PO Created') {
            # code...
            $po_number =DB::table('requisitions')->max('po_number');
            $po_number = $po_number + 1;

        } else {
            $po_number = $requisition->po_number; 
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
        $po_alias = "DMM/$po_number/PO/$month/$year";
        return view('purchase.formpurchase',compact('requisition','lastInsertedId','requesteds','total','no','po_number','po_alias','date'));
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

        $requisition->save();
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
    public function submitpurchase($id)
    {
        // return($id);
        $requisition = Requisition::find($id);
        $requisition->status='PO Submitted';
        $requisition->update();
        // return view('purchase.indexpurchase');
        
        return redirect()->route('purchase.index');


    }
    public function rejectpurchase($id)
    {
        // return($id);
        $requisition = Requisition::find($id);
        $requisition->status='Rejected';
        $requisition->update();
        // return view('purchase.indexpurchase');
        
        return redirect()->route('purchase.index');


    }
    public function destroy($id)
    {
        $requisition = Requisition::find($id);
        $requisition->delete();
    }

    public function listpurchase()
    {
        
        $requisitions = Requisition::whereIn('status',['Approved','PO Created','PO Submitted'])->orderBy('created_at','desc')
        ->where('status','!=','New')
        ->get();
        
        $no = 0;
        $data = array();
        foreach($requisitions as $requisition){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $requisition->spr_alias;
            $count = Requested::where('requisitions_id', $requisition->requisitions_id)->count();
            $row[] = $count;
            // $row[] = sprintf("%'.09d\n",$requisition->requisitions_id);
            $row[] = tanggal_indo($requisition->created_at);
            if (!empty($requisition->approved_date)) {
            $row[] = tanggal_indo($requisition->approved_date);
            } else {
            $row[] = '';
            }
            $row[] = $requisition->po_alias;
            if (!empty($requisition->po_date)) {
            $row[] = tanggal_indo($requisition->po_date);
            } else {
            $row[] = '';
            }
            $row[] = $requisition->status;
            $remarks = Requested::where('requisitions_id', $requisition->requisitions_id)->get();
            
            
                $datafoll = array();
                $ni = 0;
                foreach($remarks as $remark){
                $remarkf=array();
                // $remarko[] = $remark->report_date;
                // if ($ni++==0) {
                    // $remarkf[] = $action_follow_up->date ;
                    $remarkf[] = $remark->remarks;
                // } else {
                    // $remarkf[] = "<br />".$action_follow_up->date ;
                    // $remarkf[] = " ".$remark->remarks;
                // }                
                $datafoll[]=$remarkf;
                }      
            $row[] = $datafoll;
            
            $row[] = $requisition->created_by;

            if ($requisition->status == 'Approved') {

            $row[] = '<div>

                    <a href="purchase/'.$requisition->requisitions_id.'" class="btn btn-info"><i class="fa fa-edit">Create PO</i></a>
                    </div>';
            } elseif ($requisition->status == 'PO Created'){
                $row[] = '<div>

                    <a href="editpurchase/'.$requisition->requisitions_id.'" class="btn btn-info"><i class="fa fa-edit">Edit PO</i></a>
                    </div>';
            }elseif ($requisition->status == 'PO Submitted'){

                $row[] = '<div>
                    <a href="printpurchase/'.$requisition->requisitions_id.'" target="_blank" class="btn btn-info"><i class="fa fa-print">Print PO</i></a>
                    </div>';
            
            }else{

                $row[] = '<div>

                    </div>';
            }
            
            
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }
    public function savepurchase(Request $request){
            // return($request);

        $requesteds = Requested::where('requisitions_id','=',$request->requisitions_id)->get();
        

        foreach ($requesteds as $requested) {
            // $price=$request->price;
            // return($price);
            $price = Sparepart::find($requested->spareparts_id);
            $requested = Requested::find($requested->requesteds_id);
            $requested->po_number=$request->po_number;
            $requested->po_alias=$request->po_alias;
            $requested->top=$request->top;
            $requested->cost_code=$request->cost_code;
            $requested->delivery_point=$request->delivery_point;
            $requested->po_date=tanggal_db($request->po_date);
            $requested->suppliers_id=$request->suppliers_id;
            $requested->price=$price->price;
            $requested->total=$price->price * $requested->qty;
            $requested->update();
        }
        $requisition = Requisition::find($request->requisitions_id);
        $requisition->po_number=$request->po_number;
        $requisition->po_alias=$request->po_alias;
        $requisition->delivery_point=$request->delivery_point;
        $requisition->top=$request->top;
        $requisition->cost_code=$request->cost_code;
        $requisition->suppliers_id=$request->suppliers_id;
        $requisition->status='PO Created';
        $requisition->update();
        // return($requesteds);
        // return redirect()->route('purchase.index');

        $lastInsertedId = $request->requisitions_id;
        $requesteds = DB::table('requesteds')
            ->leftjoin('spareparts', 'spareparts.spareparts_id', '=', 'requesteds.spareparts_id')
            ->select('requesteds.requesteds_id as requesteds_id','requesteds.qty as qty','requesteds.price as price', 'spareparts.spareparts_name as spareparts_name','spareparts.part_number as part_number','spareparts.uom as uom')
            ->where('requisitions_id','=',$lastInsertedId)
            
            ->get();
        $total = 0;
        $no = 0;
        $requisition=Requisition::find($lastInsertedId);
        if ($requisition->status == 'PO Created') {
            $po_number = $requisition->po_number; 
        } else {
            $po_number =DB::table('requisitions')->max('po_number');
            $po_number = $po_number + 1;
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
        $po_alias = "DMM/$po_number/PO/$month/$year";
        $requisition = Requisition::find($lastInsertedId);
        $cost_code = Vehiclemodel::find($requisition->cost_code);
        $suppliers = Supplier::find($requisition->suppliers_id);
        // return view('purchase.formpurchaseedit',compact('suppliers','cost_code','requisition','lastInsertedId','requesteds','total','no','po_number','po_alias','date'));

        return redirect()->route('editpurchase',$request->requisitions_id);

        // return view('purchase.indexpurchase');

    }
    public function editpurchase($id)
    {
        $lastInsertedId = $id;
        $requesteds = DB::table('requesteds')
            ->leftjoin('spareparts', 'spareparts.spareparts_id', '=', 'requesteds.spareparts_id')
            ->select('requesteds.requesteds_id as requesteds_id','requesteds.qty as qty','requesteds.price as price', 'spareparts.spareparts_name as spareparts_name','spareparts.part_number as part_number','spareparts.uom as uom')
            ->where('requisitions_id','=',$id)
            
            ->get();
        $total = 0;
        $no = 0;
        $requisition=Requisition::find($id);
        if ($requisition->status == 'PO Created') {
            $po_number = $requisition->po_number; 
        } else {
            $po_number =DB::table('requisitions')->max('po_number');
            $po_number = $po_number + 1;
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
        $po_alias = "DMM/$po_number/PO/$month/$year";
        $requisition = Requisition::find($id);
        $cost_code = Vehiclemodel::find($requisition->cost_code);
        $suppliers = Supplier::find($requisition->suppliers_id);
        // return ($cost_code);

        return view('purchase.formpurchaseedit',compact('id','suppliers','cost_code','requisition','lastInsertedId','requesteds','total','no','po_number','po_alias','date'));
    }
    public function printpurchase($id)
    {
        {
            $po = Requisition::find($id);
            // $parts = Requested::where('po_number','=',$po->po_number)->get();
            $parts = DB::table('requesteds')
            ->leftjoin('spareparts', 'spareparts.spareparts_id', '=', 'requesteds.spareparts_id')
            ->select('requesteds.price','requesteds.qty','requesteds.total','spareparts.spareparts_name','spareparts.uom')
            ->where('requisitions_id','=',$id)
            ->get();
            // return($parts);
            $cost_code = Vehiclemodel::where('vehiclemodels_id','=',$po->cost_code)->first();
            $suppliers = Supplier::where('suppliers_id','=',$po->suppliers_id)->first();
            // return($part);
        $total=0;
        $no = 0;
        $pdf = PDF::loadView('purchase.formpo',compact('total','po','parts','cost_code','suppliers','no'));
        $pdf->setPaper('a4','potrait');
        return $pdf->stream($po->po_alias.".pdf");
        }
    }
    public function listpurchasereport()
    {
        
        $requesteds = Requested::orderBy('created_at','desc')
        ->get();
        
        $no = 0;
        $data = array();
        foreach($requesteds as $requested){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $requested->spr_alias;
            $requisition = Requisition::find($requested->requisitions_id);
            $row[] = tanggal_indo($requisition->created_at);
            // if(!empty($requisition->approved_date))
            if (!empty($requisition->approved_date)) {
            $row[] = tanggal_indo($requisition->approved_date);
                
            } else {
            $row[] = '';
            }
            
            $part = Sparepart::find($requested->spareparts_id);
            $row[] = $part->part_number;

            $row[] = $part->spareparts_name;
            
            $row[] = $requested->qty;
            $row[] = $part->uom;
            $row[] = $requested->po_alias;
            if(!empty($requested->suppliers_id) ){
            $vendor = Supplier::find($requested->suppliers_id);
            $row[] = $vendor->suppliers_name;
            }else{
            $row[] = $requested->suppliers_id;
            }
            $row[] = $requested->price;
            $row[] = $requested->total;
            // $grns = Grn::where('spareparts_id','=',103)->first();
            $grns = Grn::where('spareparts_id',$requested->spareparts_id)
            ->where('po_number',$requested->po_number)
            // ->whereNotNull('po_number')
            ->sum('qty');
            // return($grns->grns_id->count());
            if (empty($grns)) {
                $row[] = 0;
                $row[] = $requested->qty;

            } else {
                $row[] = $grns;
                $row[] = $requested->qty - $grns;


            }
            
            // return($grns);
            
            $row[] = 0;
            $row[] = $requested->qty;
            
            
            
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }
    public function purchasereport()
    {
        return view('purchase.indexpurchasereport');
    }
    public function poprice(Request $request, $id)
    {
        // dd('here');
        // return($request)
        $priceupdate = Requested::find($id);
        $priceupdate->price=$request['price'];
        $priceupdate->total=$request['price']*$request['qty'];
        $priceupdate->update();
        return back();
        // return redirect()->route('editpurchase', [$id]);

        // return view('purchase.formpurchaseedit',compact('suppliers','cost_code','requisition','lastInsertedId','requesteds','total','no','po_number','po_alias','date'));

    }
    
}
