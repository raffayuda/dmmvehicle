<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Sparepart;
use App\Newpr;
use App\Newprdetail;
use Auth;
use App\User;
use Carbon\Carbon;

class NewprdetailController extends Controller
{

    public function addprdetail($id, $spareparts_id)
    {
        // return($sparepart_id);

        $count = DB::table('newprdetails')->where('newprs_id',$id)->where('spareparts_id',$spareparts_id)->count();
        // return($count);
        if ($count >0) {
            # code...
            // dd('here');
            $prdetail = Newprdetail::where('newprs_id',$id)->where('spareparts_id',$spareparts_id)->first();
            $prdetail->pr_qty = $prdetail->pr_qty+1;
            $prdetail->update();

        } else {
            # code...
            // dd('dua');
            $prdetail = new Newprdetail;
            $prdetail->newprs_id = $id;
            $prdetail->spareparts_id = $spareparts_id;
            $prdetail->pr_qty = 1;
            $prdetail->created_by = Auth::user()->name;
            $prdetail->save();
        }
        

        return redirect()->route('newpr.edit', [$id]);
    }

    public function update(Request $request, $id)
        {
            
            $nama_input = "jumlah_".$id;
            $detail = Newprdetail::find($id);
            
            $detail->pr_qty=$request[$nama_input];
            // $detail->total_price=$detail->po_price*$request[$nama_input];

            $detail->update();
        }
    public function destroy($id)
    {
        $detail = Newprdetail::find($id);
        $detail->delete();
    }
    

    public function newprdetaildata($id)
    {
       
        $prinduk=Newpr::find($id);
        $prs = DB::table('newprdetails')
        ->join('spareparts', function ($join) use ($id){
            $join->on('newprdetails.spareparts_id', '=', 'spareparts.spareparts_id')
                 ->where('newprdetails.newprs_id', $id);
        })
        ->get();

        
        // return($prs);
        $no = 0;
        $data = array();
        if ($prinduk->pr_status == 'DRAFT') {
            # code...
            foreach($prs as $pr){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $pr->part_number;
            $row[] = $pr->spareparts_name;
            $row[] = "<input type='number' class='form-control' name='jumlah_$pr->newprdetails_id' value='$pr->pr_qty' onChange='changeQty($pr->newprdetails_id)'>";
            $row[] = $pr->uom;
            $row[] = '
                     <a onClick="deleteData('.$pr->newprdetails_id.')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </div>';
            $data[]=$row;
        }
        } else {
            # code...
            foreach($prs as $pr){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $pr->part_number;
            $row[] = $pr->spareparts_name;
            $row[] = $pr->pr_qty;
            $row[] = $pr->uom;
            $row[] = '';
            $data[]=$row;
        }
        }
        
        
        $output = array("data"=>$data);
        return response()->json($output);
    }

    public function sparepartlist($id)
    {
        // $id=1;
        $parts = Sparepart::orderBy('part_number_group','ASC')->get();
        $no = 0;
        $data = array();
        foreach($parts as $part){
            $no++;
            $row=array();
            $row[] = $part->part_number_group;
            $row[] = $part->part_number;
            $row[] = $part->spareparts_name;
            // $row[] = $part->pr_qty;
            $row[] = $part->uom;
            // $row[] = '
            //         <a href="/dmmvehicle/pr/'.$part->spareparts_id.'/edit" class="btn btn-info"><i class="fa fa-edit"></i></a>

            //         </div>';
            $row[] = '
                    <a href="/dmmvehicle/addprdetail/'.$id.'/'.$part->spareparts_id.'" class="btn btn-info"><i class="fa fa-edit"></i></a>

                    </div>';



            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }
}
