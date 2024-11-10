<?php

namespace App\Http\Controllers;

use App\Newgr;
use App\Newgrdetail;
use App\Newpodetail;
use App\Sparepart;
use Carbon\Carbon;
use Auth;
use DB;
use Redirect;

use Illuminate\Http\Request;





class NewgrdetailController extends Controller
{
    public function store(Request $request)
    {
            // return($request); DOC Type masih perlu dipikirin
        $now = Carbon::today();
        $gr = new Newgr;
        $gr->newpos_id = $request['newpos_id'];
        $gr->gr_remarks = $request['gr_remarks'];
        
        $gr->gr_date = $request['gr_date'];
        $gr->document_number = $request['po_alias'];
        $gr->received_form = $request['suppliers_id'];
        $gr->gr_status = 'DRAFT';
        $gr->storeman = $request['created_by'];
        $gr->created_by = $request['created_by'];
        // $gr->created_date = tanggal_db($now);
        $gr->save();



// newgrs_id
// gr_number
// gi_number
// newpos_id
// wos_id
// spareparts_id
// gr_qty
// gi_qty
// saldo
// remarks

        $lastinsertedId = $gr->newgrs_id;
        
        if (!empty($request->grdetail)) {
        foreach ($request->grdetail as $key) {
            # code...
            $grdetail = new Newgrdetail;
            $grdetail->gr_qty = $request['po_qty_'.$key];
            $grdetail->spareparts_id = $request['spareparts_id_'.$key];
            // $stock = Sparepart::find($request['spareparts_id_'.$key]);
            $grdetail->newpos_id = $request['newpos_id'];
            $grdetail->newpodetails_id = $key;
            $grdetail->newgrs_id = $lastinsertedId;
            // $grdetail->saldo = $stock->stock + $request['po_qty_'.$key];
            
            $grdetail->created_by=Auth::user()->name;
            $grdetail->save();


        }
        } 
        return redirect()->route('newgr.edit', [$lastinsertedId]);
        
    }


    public function updategrdetail(Request $request, $newgrs_id)
    {
        // return ($request);
            $gr = Newgr::find($newgrs_id);
            $gr->newpos_id = $request['newpos_id'];
            $gr->gr_remarks = $request['gr_remarks'];
            
            $gr->gr_date = $request['gr_date'];
            $gr->document_number = $request['po_alias'];
            $gr->received_form = $request['suppliers_id'];
            $gr->storeman = $request['created_by'];
            $gr->created_by = $request['created_by'];
            $gr->update();


            if (!empty($request->grdetail)) {
            foreach ($request->grdetail as $key) {
            # code...
            $grdetail = Newgrdetail::find($key);
            $grdetail->gr_qty = $request['gr_qty_'.$key];
            $grdetail->spareparts_id = $request['spareparts_id_'.$key];
            $grdetail->newpos_id = $request['newpos_id'];
            // $grdetail->newpodetails_id = $key;
            $grdetail->newgrs_id = $newgrs_id;
            $grdetail->created_by=Auth::user()->name;
            $grdetail->update();
        }
        } 
        return redirect()->route('newgr.edit', [$newgrs_id]);

    }

    public function addgrpartdetaildata($newpos_id,$newgrs_id)
    {
        // return($newpos_id);
        // $newprs_id = 1;
        $grdetails = DB::table('newpodetails')
        ->join('spareparts', function ($join) use($newpos_id){
            $join->on('newpodetails.spareparts_id', '=', 'spareparts.spareparts_id')
                 ->where('newpodetails.newpos_id', $newpos_id);
        })
        ->get();

        // return($podetails);
        $no = 0;
        $newgrs_ids = $newgrs_id;
        $data = array();
        foreach($grdetails as $grdetail){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $grdetail->part_number;
            $row[] = $grdetail->spareparts_name;
            $grqty = Newgrdetail::where('newpos_id',$grdetail->newpos_id)->where('spareparts_id',$grdetail->spareparts_id)->sum('gr_qty');

            $row[] = $grdetail->po_qty - $grqty;
            
            // $row[] = "<input type='checkbox' checked  name='podetail[]' value='".$podetail->newprdetails_id."'>";
            if ($grdetail->po_qty - $grqty <= 0) {
                # code...
                $row[] = '';
            } else {
                # code...
                $row[] = '
                        <a href="/dmmvehicle/newgrdetail/'.$grdetail->newpos_id.'/addgrdetail/'.$newgrs_id.'/'.$grdetail->spareparts_id.'" class="btn btn-info"><i class="fa fa-plus"></i></a>
                        </div>';
            }
            
            
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }


    public function addgrdetail($newpos_id, $newgrs_id,$spareparts_id)
    {
        $posdetail = Newpodetail::where('newpos_id',$newpos_id)->where('spareparts_id',$spareparts_id)->first();
        $grsdetail = Newgrdetail::where('newpos_id',$newpos_id)->get();
        
        $posqty = Newpodetail::where('newpos_id',$newpos_id)->where('spareparts_id',$spareparts_id)->sum('po_qty');
        $grsqty = Newgrdetail::where('newpos_id',$newpos_id)->where('spareparts_id',$spareparts_id)->sum('gr_qty');

        // return($grsqty);

        $grdetail = new Newgrdetail;
        $grdetail->gr_qty = $posqty-$grsqty;
        $grdetail->spareparts_id = $spareparts_id;
        $grdetail->newpos_id = $newpos_id;
        $grdetail->newpodetails_id = $posdetail->newpodetails_id;
        $grdetail->newgrs_id = $newgrs_id;
        $grdetail->created_by=Auth::user()->name;
        $grdetail->save();
        // return red
        return Redirect::back();

    }

    public function destroy($id)
    {
        $grdetail = Newgrdetail::find($id);
        $grdetail->delete();
    }


    
}
