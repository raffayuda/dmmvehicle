<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Sparepart;
use App\Pr;
use App\Prdetail;
use Auth;
use App\Supplier;
use Carbon\Carbon;
use App\Vehiclemodel;
use App\Grn;
use PDF;

class PoController extends Controller
{
    public function index()
    {
        return view('po.indexpo');
    }
    public function podata()
    {
        $prs = DB::table('prs')
            ->where('pr_status','Approve')
            ->get();
        $no = 0;
        $data = array();
        foreach($prs as $pr){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $pr->remarks;
            $row[] = $pr->pr_alias;
            $row[] = $pr->pr_date;
            // $row[] = tanggal_indo($pr->created_at);
            $item = Prdetail::where('prs_id',$pr->prs_id)->count();

            $row[] = $item;

            $row[] = $pr->po_alias;
            $row[] = $pr->pr_status;
            $row[] = $pr->po_status;
            $row[] = $pr->created_by;
            if (empty($pr->po_status) OR $pr->po_status == 'Draft') {
                $row[] = '
                    <a href="/dmmvehicle/po/'.$pr->prs_id.'/edit" class="btn btn-info"><i class="fa fa-edit">Create PO</i></a>

                    </div>';
            } elseif($pr->po_status == 'Submit' OR $pr->po_status == 'Done'){
                $row[] = '
                    <a href="/dmmvehicle/po/'.$pr->prs_id.'/edit" class="btn btn-info"><i class="fa fa-edit"></i></a>
                    <a href="printpo/'.$pr->prs_id.'" target="_blank" class="btn btn-info"><i class="fa fa-print"></i></a>

                    </div>';
            } elseif($pr->po_status == 'Close'){
                $row[] = '
                    <a href="/dmmvehicle/po/'.$pr->prs_id.'/edit" class="btn btn-info"><i class="fa fa-edit"></i></a>
                    <a href="printpo/'.$pr->prs_id.'" target="_blank" class="btn btn-info"><i class="fa fa-print"></i></a>

                    </div>';
            }
            
            else {
                $row[] = '-';
            }
            
            
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }
    public function edit($id)
    {

        $pr = Pr::find($id);
        $supplier = Supplier::all();
        $vehicle = Vehiclemodel::all();
        $total = Prdetail::where('prs_id',$id)->sum('total_price');
        // return redirect()->route('pr.edit', [$id]);

        return view('po.editpo',compact('id','pr','total','supplier','vehicle'));

    }
    public function update(Request $request, $id)
    {   
        // return($request);
        $pr = Pr::find($id);
        $pr->po_top = $request->po_top;
        $pr->po_delivery_instruction = $request->po_delivery_instruction;
        $pr->suppliers_id = $request->suppliers_id;
        $pr->cost_code = $request->cost_code;
        $pr->po_remarks = $request->po_remarks;
        $pr->po_ppn = $request->po_ppn;
        // $pr->created_by = $request->created_by;
        $pr->update();
        return redirect()->route('po.edit', [$id]);

        // return view('pr.editpr',compact('id','pr'));

    }
    public function rejectpo($id)
    {
        // return($id);
        $requisition = Pr::find($id);
        $requisition->po_status='Rejected';
        $requisition->update();
        // return view('purchase.indexpurchase');
        
        return redirect()->route('po.index');


    }
    public function cancelpo($id)
    {
        // return($id);
        $requisition = Pr::find($id);
        $requisition->po_status='Cancel';
        $requisition->update();
        // return view('purchase.indexpurchase');
        
        return redirect()->route('po.index');


    }

    public function donepo($id)
    {
        // return($id);
        $requisition = Pr::find($id);
        $requisition->po_status='Close';
        $requisition->update();
        // return view('purchase.indexpurchase');
        
        return redirect()->route('po.index');


    }
    public function submitpo($id)
    {
        $prmax = Pr::max('po_number');
        $po_number = $prmax+1;
        $pr = Pr::find($id);
        $pr->po_status = 'Submit';
        $pr->po_number = $po_number;
        $pr->update();


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

        $pr = Pr::find($id);
        $pr->po_alias = $po_alias;
        $pr->po_date = tanggal_db($now);
        $pr->update();
        
        return redirect()->route('po.edit', [$id]);

        // return view('pr.editpr',compact('id','pr'));
    }
    public function printpo($id)
    {
        {
            $po = Pr::find($id);
            // $parts = Prdetail::where('prs_id','=',$id)->get();
            $parts = DB::table('prdetails')
            ->leftjoin('spareparts', 'spareparts.spareparts_id', '=', 'prdetails.spareparts_id')
            ->select('prdetails.po_price','prdetails.qty','prdetails.total_price','spareparts.spareparts_name','spareparts.part_number','spareparts.uom')
            ->where('prs_id','=',$id)
            ->get();
            // return($parts);
            // $cost_code = Vehiclemodel::where('vehiclemodels_id','=',$po->cost_code)->first();
            $suppliers = Supplier::where('suppliers_name',$po->suppliers_id)->first();
            // $suppliers = $po->suppliers_id;
            // return($suppliers);
        $total=Prdetail::where('prs_id',$id)->sum('total_price');
        $no = 0;
        $pdf = PDF::loadView('po.printpo',compact('po','suppliers','parts','total','no'));
        $pdf->setPaper('a4','potrait');
        return $pdf->stream($po->po_alias.".pdf");
        }
    }

    public function statuspo()
    {
        DB::select(DB::raw('call pr_report_procedure()'));
        return view('po.postatus');
    }

    public function liststatuspo()
    {
        $prdetails = DB::table('prdetails')
        ->leftJoin('prs','prs.prs_id','=','prdetails.prs_id')
        ->leftJoin('spareparts','spareparts.spareparts_id','=','prdetails.spareparts_id')
            ->where('pr_status','Approve')
            ->get();
        $no = 0;
        $data = array();
        foreach($prdetails as $pr){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $pr->pr_alias;
            $row[] = $pr->pr_date;
            $row[] = $pr->approve_date;
            $row[] = $pr->part_number;
            $row[] = $pr->spareparts_name;
            $row[] = $pr->qty;
            $row[] = $pr->uom;
            $row[] = $pr->po_alias;
            $row[] = $pr->po_date;
            $row[] = $pr->cost_code;
            $row[] = $pr->suppliers_id;
            $row[] = $pr->po_price;
            $row[] = $pr->total_price;
            $grn_qty = Grn::where('prs_id',$pr->prs_id)->where('spareparts_id',$pr->spareparts_id)->sum('qty');
            // $row[] = $grn_qty;
            $row[] = '';
            $row[] = $pr->qty-$grn_qty;
            // $row[] = $pr->pr_status;
            // $row[] = $pr->pr_alias;
            // $row[] = tanggal_indo($pr->pr_date);
            // $row[] = tanggal_indo($pr->created_at);
            // $item = Prdetail::where('prs_id',$pr->prs_id)->count();
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }
    
}
