<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Sparepart;
use App\Newpr;
use App\Newprdetail;
use App\Newpo;
use App\Newpodetail;
use Auth;
use App\User;
use Carbon\Carbon;
use Redirect;

class NewpodetailController extends Controller
{
    public function addpodetaildata()
    {
        $podetails = DB::table('newprdetails')
        ->join('spareparts', function ($join){
            $join->on('newprdetails.spareparts_id', '=', 'spareparts.spareparts_id');
                //  ->where('newprdetails.newprs_id', $id);
        })
        ->get();
        $no = 0;
        $data = array();
        foreach($podetails as $podetail){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $podetail->part_number;
            $row[] = $podetail->spareparts_name;
            $row[] = "<input type='hidden' name='spareparts_id_".$podetail->newprdetails_id."' value='".$podetail->spareparts_id."'>
            <div class='form-group'>
            <div class='controls'>
            <input type='number' min='0' max='".$podetail->pr_qty."' name='pr_qty_".$podetail->newprdetails_id."' value='".$podetail->pr_qty."' >
            </div>
            </div>";
            $row[] = '<div class="form-group">
                    <div class="controls">
                    <input type="text" min="0" max="'.$podetail->pr_qty.'" name="pr_qty'.$podetail->newprdetails_id.'" value="'.$podetail->pr_qty.'" >
                    </div>
                    </div>';
            // $row[] = $podetail->uom;
            $row[] = "<input type='checkbox' checked  name='podetail[]' value='".$podetail->newprdetails_id."'>";
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }

    public function store(Request $request)
    {
            // return($request);
        $now = Carbon::today();

        $po = new Newpo;
        $po->newprs_id = $request['newprs_id'];
        $po->po_remarks = $request['po_remarks'];
        $po->po_status = $request['po_status'];
        $po->cost_code = $request['cost_code'];
        $po->suppliers_id = $request['suppliers_id'];
        $po->top = $request['top'];
        $po->delivery_point = $request['delivery_point'];
        $po->po_ppn = $request['po_ppn'];
        $po->created_by = $request['created_by'];
        $po->created_date = tanggal_db($now);

        $po->save();

        $lastinsertedId = $po->newpos_id;
        
        if (!empty($request->podetail)) {
        foreach ($request->podetail as $key) {
            # code...
            $podetail = new Newpodetail;
            $podetail->po_qty = $request['pr_qty_'.$key];
            $podetail->spareparts_id = $request['spareparts_id_'.$key];
            $podetail->po_price = $request['po_price_'.$key];
            $podetail->total_price = $request['po_price_'.$key]*$request['pr_qty_'.$key];
            $podetail->newprs_id = $request['newprs_id'];
            $podetail->newprdetails_id = $key;
            $podetail->newpos_id = $lastinsertedId;
            $podetail->created_by=Auth::user()->name;
            $podetail->save();
        }
        } 
        return redirect()->route('newpo.edit', [$lastinsertedId]);
        
    }


    public function updatepodetail(Request $request, $newpos_id)
    {
        // return ($request);
            $po = Newpo::find($newpos_id);
            $po->newprs_id = $request['newprs_id'];
            $po->po_remarks = $request['po_remarks'];
            $po->po_status = $request['po_status'];
            $po->cost_code = $request['cost_code'];
            $po->suppliers_id = $request['suppliers_id'];
            $po->top = $request['top'];
            $po->delivery_point = $request['delivery_point'];
            $po->po_ppn = $request['po_ppn'];
            $po->created_by = $request['created_by'];

            $po->update();


            if (!empty($request->podetail)) {
            foreach ($request->podetail as $key) {
            # code...
            $podetail = Newpodetail::find($key);
            $podetail->po_qty = $request['pr_qty_'.$key];
            $podetail->spareparts_id = $request['spareparts_id_'.$key];
            $podetail->po_price = $request['po_price_'.$key];
            $podetail->total_price = $request['po_price_'.$key]*$request['pr_qty_'.$key];
            $podetail->newprs_id = $request['newprs_id'];
            $podetail->newprdetails_id = $key;
            $podetail->created_by=Auth::user()->name;
            $podetail->update();
        }
        } 
        return redirect()->route('newpo.edit', [$newpos_id]);

    }



    public function addpopartdetaildata($newprs_id,$newpos_id)
    {
        // return($newpos_id);
        // $newprs_id = 1;
        $podetails = DB::table('newprdetails')
        ->join('spareparts', function ($join) use($newprs_id){
            $join->on('newprdetails.spareparts_id', '=', 'spareparts.spareparts_id')
                 ->where('newprdetails.newprs_id', $newprs_id);
        })
        ->get();

        // return($podetails);
        $no = 0;
        $newpos_ids = $newpos_id;
        $data = array();
        foreach($podetails as $podetail){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $podetail->part_number;
            $row[] = $podetail->spareparts_name;
            $poqty = Newpodetail::where('newprs_id',$podetail->newprs_id)->where('spareparts_id',$podetail->spareparts_id)->where('po_status','Submit')->sum('po_qty');

            $row[] = $podetail->pr_qty - $poqty;
            
            // $row[] = "<input type='checkbox' checked  name='podetail[]' value='".$podetail->newprdetails_id."'>";
            if ($podetail->pr_qty - $poqty <= 0) {
                # code...
                $row[] = '';
            } else {
                # code...
                $row[] = '
                        <a href="/dmmvehicle/newpodetail/'.$podetail->newprs_id.'/addpodetail/'.$newpos_id.'/'.$podetail->spareparts_id.'" class="btn btn-info"><i class="fa fa-plus"></i></a>
                        </div>';
            }
            
            
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }


    public function addpodetail($newprs_id, $newpos_id,$spareparts_id)
    {
        $prsdetail = Newprdetail::where('newprs_id',$newprs_id)->where('spareparts_id',$spareparts_id)->first();
        $posdetail = Newpodetail::where('newprs_id',$newprs_id)->get();
        
        $prsqty = Newprdetail::where('newprs_id',$newprs_id)->where('spareparts_id',$spareparts_id)->sum('pr_qty');
        $posqty = Newpodetail::where('newprs_id',$newprs_id)->where('spareparts_id',$spareparts_id)->where('po_status','Submit')->sum('po_qty');

        // return($posqty);

        $podetail = new Newpodetail;
        $podetail->po_qty = $prsqty-$posqty;
        $podetail->spareparts_id = $spareparts_id;
        $podetail->newprs_id = $newprs_id;
        $podetail->newprdetails_id = $prsdetail->newprdetails_id;
        $podetail->newpos_id = $newpos_id;
        $podetail->created_by=Auth::user()->name;
        $podetail->save();
        // return red
        return Redirect::back();

    }
    public function destroy($id)
    {
        $podetail = Newpodetail::find($id);
        $podetail->delete();
    }
}
