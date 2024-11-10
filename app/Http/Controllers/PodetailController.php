<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prdetail;
use App\Pr;
use DB;
use Auth;

class PodetailController extends Controller
{
    public function listdetailpo($id)
    {
        $prdetais = DB::table('prdetails')
            ->leftjoin('spareparts', 'spareparts.spareparts_id', '=', 'prdetails.spareparts_id')
            ->where('prdetails.prs_id','=',$id)
            ->get();
        $prstatus = Pr::find($id);
        if (empty($prstatus->po_status) OR $prstatus->po_status == 'Draft') {
            # code...
            $no = 0;
        $data = array();
        foreach($prdetais as $prdetai){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $prdetai->part_number;
            $row[] = $prdetai->spareparts_name;
            $row[] = "<input type='number' class='form-control' name='jumlah_$prdetai->prdetails_id' value='$prdetai->qty' onChange='changeQty($prdetai->prdetails_id)'>";
            $row[] = $prdetai->uom;
            $row[] = "<input type='number' class='form-control' name='harga_$prdetai->prdetails_id' value='$prdetai->po_price' onChange='changePrice($prdetai->prdetails_id)'>";
            // $row[] = $prdetai->po_price;
            $row[] ='<div style="text-align:right;">'.format_uang($prdetai->qty*$prdetai->po_price).'</div>';

            // if ($prstatus->pr_status == 'Draft') {
            //     $row[] = '<div>
            //         <a onClick="deleteData('.$prdetai->prdetails_id.')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            //         </div>';
            // } else {
            //     $row[] = '-';
            // }
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
        } else {
             $no = 0;
        $data = array();
        foreach($prdetais as $prdetai){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $prdetai->part_number;
            $row[] = $prdetai->spareparts_name;
            $row[] = format_uang($prdetai->qty);
            $row[] = $prdetai->uom;
            $row[] = format_uang($prdetai->po_price);
            $row[] =format_uang($prdetai->qty*$prdetai->po_price);
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
        }
        
        
    }
    public function update(Request $request, $id)
        {
            
            $nama_input = "harga_".$id;
            $detail = Prdetail::find($id);
            // $spareparts = Sparepart::find($detail->spareparts_id);
            // $price = $spareparts->price;
            // $detail->jumlah = $request[$nama_input];
            // $detail->jumlah = $request['jumlah_12'];
            // $detail->sub_total = $detail->harga_beli * $request[$nama_input];
            $detail->po_price=$request[$nama_input];
            $detail->total_price=$detail->qty*$request[$nama_input];

            $detail->update();
        }
}
