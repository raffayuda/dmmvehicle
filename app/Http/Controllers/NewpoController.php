<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Sparepart;
use App\Newpr;
use App\Newprdetail;
use App\Newpo;
use App\Newpodetail;
use App\Supplier;
use App\Vehiclemodel;
use Auth;
use App\User;
use Carbon\Carbon;
use PDF;


class NewpoController extends Controller
{
    public function index()
    {
    return view('newpo.index');
    }


    public function addpo($newprs_id)
    {
        // return('here');
        $prs = Newpr::find($newprs_id);
        $no = 0;
        // $prdetails = Newprdetail::where('newprs_id',$newprs_id)->get();
        $prdetails = DB::table('newprdetails')
        ->join('spareparts', function ($join) use ($newprs_id){
            $join->on('newprdetails.spareparts_id', '=', 'spareparts.spareparts_id')
                 ->where('newprdetails.newprs_id', $newprs_id);
        })
        ->get();
        $suppliers = Supplier::all();
        $vehicles_model = Vehiclemodel::all();
        return view('newpo.create',compact('id','prs','prdetails','no','suppliers','vehicles_model'));
    }
    // public function create()
    // {
    //     $id = 'bikin';
    //     $pos_id = 0;
    //     $no = 0;
    //     // $part = Sparepart::all();
    //     return view('newpo.create',compact('id','pos_id','no'));
    // }

    public function store(Request $request)
    {
        
        if (!empty($request->rfqdetail)) {
        foreach ($request->rfqdetail as $key) {
            # code...
            $rfqdetail = new Rfqdetail;
            $rfqdetail->partrequests_id=$request->partrequests_id;
            $rfqdetail->suppliers_id=$request['suppliers_id'];
            $rfqdetail->rfq_id=$id;
            $rfqdetail->partrequestdetails_id = $key;
            $rfqdetail->save();
        }
        } 
        
    }

    public function edit($id)
    {

        $po = Newpo::find($id);
        $newpos_id = $po->newpos_id;
        $newprs_id = $po->newprs_id;
        $prs =Newpr::find($newprs_id);
        $suppliers = Supplier::all();
        $vehicles_model = Vehiclemodel::all();
        $prdetails = DB::table('newprdetails')
        ->join('spareparts', function ($join) use ($newprs_id){
            $join->on('newprdetails.spareparts_id', '=', 'spareparts.spareparts_id')
                 ->where('newprdetails.newprs_id', $newprs_id);
        })
        ->get();
        $podetails = DB::table('newpodetails')
        ->join('spareparts', function ($join) use ($newpos_id){
            $join->on('newpodetails.spareparts_id', '=', 'spareparts.spareparts_id')
                 ->where('newpodetails.newpos_id', $newpos_id);
        })
        ->get();
        $no = 0;

        // return redirect()->route('pr.edit', [$id]);
        return view('newpo.edit',compact('id','po','prs','suppliers','vehicles_model','prdetails','no','podetails'));

    }

    public function viewsubmit($newpos_id)
    {
        $po = Newpo::find($newpos_id);
        $totalpo = Newpodetail::where('newpos_id',$newpos_id)->sum('total_price');
        $newpos_id = $po->newpos_id;
        $newprs_id = $po->newprs_id;
        $prs =Newpr::find($newprs_id);
        $suppliers = Supplier::all();
        $vehicles_model = Vehiclemodel::all();
        $prdetails = DB::table('newprdetails')
        ->join('spareparts', function ($join) use ($newprs_id){
            $join->on('newprdetails.spareparts_id', '=', 'spareparts.spareparts_id')
                 ->where('newprdetails.newprs_id', $newprs_id);
        })
        ->get();
        $podetails = DB::table('newpodetails')
        ->join('spareparts', function ($join) use ($newpos_id){
            $join->on('newpodetails.spareparts_id', '=', 'spareparts.spareparts_id')
                 ->where('newpodetails.newpos_id', $newpos_id);
        })
        ->get();
        $no = 0;
        $id = $newpos_id;
        // return redirect()->route('pr.edit', [$id]);
        return view('newpo.submited',compact('id','po','prs','suppliers','vehicles_model','prdetails','no','podetails','totalpo'));
    }

    public function newpodata()
    {
        // dd('here');
        $pos = DB::table('newpos')
            ->get();
        $no = 0;
        $data = array();
        foreach($pos as $po){
            $no++;
            $row=array();
            $row[] = $no;
            $newpr = Newpr::find($po->newprs_id);
            $row[] = $newpr->pr_alias;
            $row[] = $newpr->approve_date;
            $row[] = $po->po_alias;
            $newpodetail = Newpodetail::where('newpos_id',$po->newpos_id)->count();
            $row[] = $newpodetail;
            $row[] = $newpr->pr_status;
            $row[] = $po->po_status;
            
            if ($po->po_status == 'Submit' OR $po->po_status == 'Cancel') {
                # code...
                $row[] = '
                    <a href="/dmmvehicle/viewsubmit/'.$po->newpos_id.'" class="btn btn-info"><i class="fa fa-edit"></i></a>

                    </div>';
            } else {
                # code...
                 $row[] = '
                    <a href="/dmmvehicle/newpo/'.$po->newpos_id.'/edit" class="btn btn-info"><i class="fa fa-edit"></i></a>

                    </div>';
            }
            
            $data[]=$row;

           
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }

    public function addpodata()
    {
        $prs = DB::table('newprs')
            ->where('pr_status','Approve')
            ->where('po_status','!=','Close')
            ->where('po_status','!=','Rejected')
            ->get();
        $no = 0;
        $data = array();
        foreach($prs as $pr){
            
            $prqty = Newprdetail::where('newprs_id',$pr->newprs_id)->sum('pr_qty');
            $poqty = Newpodetail::where('newprs_id',$pr->newprs_id)->whereIn('po_status',['Submit','Draft'])->sum('po_qty');
            if ($prqty-$poqty > 0) {
                # code...
                $no++;
                $row=array();
                $row[] = $no;
                $row[] = $pr->pr_alias;
                $row[] = $pr->approve_date;
                $row[] = $prqty-$poqty;
                $row[] = '
                        <a href="/dmmvehicle/newpo/'.$pr->newprs_id.'/addpo" class="btn btn-info"><i class="fa fa-plus"></i></a>
                        </div>';
                $data[]=$row;
            }
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }

    public function submitnewpo($newpos_id)
    {
        // $pr_qty = Newprdetail::where('newprs_id',$id)->sum('pr_qty');
        $po = Newpo::find($newpos_id);

        if (empty($po->po_number)) {
            # code...
            $pomax = Newpo::max('po_number');
            // return($pomax+1);
            $po_number = $pomax+1;
        } else {
            # code...
            $po_number = $po->po_number;
        }
       
        $po->po_status = 'Submit';
        $po->po_number = $po_number;
        // $pr->pr_qty = $pr_qty;
        $po->update();

        // return($po->po_number);

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

        $po = Newpo::find($newpos_id);
        $po->po_alias = $po_alias;
        $po->submitted_date = tanggal_db($now);
        $po->po_date = tanggal_db($now);
        $po->update();
        
        return redirect()->route('newpo.index');
    }


    public function printnewpo($newpos_id)
    {
        

        $po = Newpo::find($newpos_id);
        // return($po);
        $totalpo = Newpodetail::where('newpos_id',$newpos_id)->sum('total_price');
        $newpos_id = $po->newpos_id;
        $newprs_id = $po->newprs_id;
        $prs =Newpr::find($newprs_id);
        $suppliers = Supplier::all();
        $vehicles_model = Vehiclemodel::all();
        $prdetails = DB::table('newprdetails')
        ->join('spareparts', function ($join) use ($newprs_id){
            $join->on('newprdetails.spareparts_id', '=', 'spareparts.spareparts_id')
                 ->where('newprdetails.newprs_id', $newprs_id);
        })
        ->get();
        $podetails = DB::table('newpodetails')
        ->join('spareparts', function ($join) use ($newpos_id){
            $join->on('newpodetails.spareparts_id', '=', 'spareparts.spareparts_id')
                 ->where('newpodetails.newpos_id', $newpos_id);
        })
        ->get();
        $no = 0;
        $id = $newpos_id;

        $no = 0;
        $pdf = PDF::loadView('newpo.printpo',compact('po','suppliers','parts','totalpo','no','podetails','prs'));
        $pdf->setPaper('f4','potrait');
        return $pdf->stream($po->po_alias.".pdf");
        
    }

    public function editnewpo($newpos_id)
    {
        $po = Newpo::find($newpos_id);
        $po->po_status = 'DRAFT';
        // $po->po_number = $po_number;
        // $pr->pr_qty = $pr_qty;
        $po->update();
        $po = Newpo::find($newpos_id);
        $newpos_id = $po->newpos_id;
        $newprs_id = $po->newprs_id;
        $prs =Newpr::find($newprs_id);
        $suppliers = Supplier::all();
        $vehicles_model = Vehiclemodel::all();
        $prdetails = DB::table('newprdetails')
        ->join('spareparts', function ($join) use ($newprs_id){
            $join->on('newprdetails.spareparts_id', '=', 'spareparts.spareparts_id')
                 ->where('newprdetails.newprs_id', $newprs_id);
        })
        ->get();
        $podetails = DB::table('newpodetails')
        ->join('spareparts', function ($join) use ($newpos_id){
            $join->on('newpodetails.spareparts_id', '=', 'spareparts.spareparts_id')
                 ->where('newpodetails.newpos_id', $newpos_id);
        })
        ->get();
        $no = 0;

        // return redirect()->route('pr.edit', [$id]);
        return view('newpo.edit',compact('id','po','prs','suppliers','vehicles_model','prdetails','no','podetails'));
    }

    public function cancelnewpo($newpos_id)
    {
        // return($newpos_id);
        $newpos = Newpo::find($newpos_id);
        $newpos->po_status = 'Cancel';
        $newpos->update();

        // MyModel::where('confirmed', '=', 0)->update(['confirmed' => 1])
        // $newpodetails = 
        Newpodetail::where('newpos_id',$newpos_id)->update(['po_status' => 'Cancel']);
        // return($newpodetails);
        // $newpodetails->update(['po_status' => 'Cancel']);

        return view('newpo.index');

        
    }

    public function donenewpo($newpos_id)
    {
        // return($newpos_id);
        $newpos = Newpo::find($newpos_id);
        $newpos->po_status = 'Done';
        $newpos->update();

        // MyModel::where('confirmed', '=', 0)->update(['confirmed' => 1])
        // $newpodetails = 
        // Newpodetail::where('newpos_id',$newpos_id)->update(['po_status' => 'Cancel']);
        // return($newpodetails);
        // $newpodetails->update(['po_status' => 'Cancel']);

        return view('newpo.index');

        
    }

    public function rejectnewpo($newprs_id)
    {
        // return($newpos_id);
        $newprs = Newpr::find($newprs_id);
        $newprs->po_status = 'Rejected';
        $newprs->update();

        // MyModel::where('confirmed', '=', 0)->update(['confirmed' => 1])
        // $newpodetails = 
        // Newpodetail::where('newpos_id',$newpos_id)->update(['po_status' => 'Reject']);
        // return($newpodetails);
        // $newpodetails->update(['po_status' => 'Cancel']);

        return view('newpo.index');

        
    }


    //PO Report 

    public function liststatusnewpo()
    {
        // $newprdetails = DB::table('newprdetails')
        // ->leftJoin('prs','prs.prs_id','=','prdetails.prs_id')
        // ->leftJoin('spareparts','spareparts.spareparts_id','=','prdetails.spareparts_id')
        //     ->where('pr_status','Approve')
        //     ->get();
        // $newposdetails = DB::table('newprs')
        // ->leftjoin('newpodetails','newpodetails.newprs_id','=','newprs.newprs_id')
        // ->get();
        // return($newposdetails);

        // $newprsdetails = DB::table('newprs')
        // ->leftJoin('newprs','newprs.newprs_id','=','newprdetails.newprs_id')
        // ->leftJoin('spareparts','spareparts.spareparts_id','=','newprdetails.spareparts_id')
        // ->leftjoin('newpos','newpos.newprs_id','=','newprs.newprs_id')
        // ->leftJoin('newpos','newpos.newprs_id','=','newprdetails.newprs_id')
        // ->where('newpodetails.po_status','==','Submit')
        // ->get();
        // return($newprsdetails);
        $newprsdetails = DB::table('pr_report_pro')->get();
        // return($newprsdetails);
        $no = 0;
        $data = array();
        foreach($newprsdetails as $newprsdetail){
            $no++;
            $row=array();
            $row[] = $no;
            // $newprs = Newpr::find($newprsdetail->newprs_id);
            // if (!empty($newprs)) {
                # code...
                $row[] = $newprsdetail->pr_alias;
                $row[] = $newprsdetail->created_date;
                $row[] = $newprsdetail->approve_date;
                $row[] = $newprsdetail->part_number;
                $row[] = $newprsdetail->spareparts_name;
            // } else {
            //     # code...
            //     $row[] = '-';
            //     $row[] = '-';
            //     $row[] = '-';
            // }

            
           
            
            $row[] = $newprsdetail->pr_qty;
            $row[] = $newprsdetail->uom;
         
            $row[] = $newprsdetail->po_alias;
            $row[] = $newprsdetail->po_date;
            $row[] = $newprsdetail->cost_code;
            $row[] = $newprsdetail->suppliers_id;


            $row[] = $newprsdetail->po_price;
            $row[] = $newprsdetail->total_price;
            $row[] = '-';      
            $row[] = '-';      
            $row[] = '-';      

            // $podetails = Newpodetail::where('newprs_id',$newprsdetail->newprs_id)->where('spareparts_id',$newprsdetail->spareparts_id)->where('po_status','Submit')->sum('po_qty');
            // $outstanding = $newprsdetail->pr_qty - $podetails;
            // $podetails = Newpodetail::where('newprs_id',$newprsdetail->newprs_id)->first();
            // $row[] = $podetails;     
            // $row[] = $newprsdetail->pr_qty-$newprsdetail->po_qty;
            // $row[] = $newprsdetail->newpos_id;
            
            
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }
}
