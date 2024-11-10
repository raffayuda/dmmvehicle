<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prdetail;
use App\Sparepart;
use App\Pr;
use DB;
use Auth;
class PrdetailController extends Controller
{
    public function addprdetail($spareparts_id,$id)
        {
            $spareparts = Sparepart::find($spareparts_id);
            $price = $spareparts->price;
            //cek sparepart sama

            $prcek = Prdetail::where('prs_id',$id)->where('spareparts_id',$spareparts_id)->count();
            if ($prcek > 0) {
                # code...
                $detail = Prdetail::where('prs_id',$id)->where('spareparts_id',$spareparts_id)->first();
            // $spareparts = Sparepart::find($detail->spareparts_id);
            // $price = $spareparts->price;
            // $detail->jumlah = $request[$nama_input];
            // $detail->jumlah = $request['jumlah_12'];
            // $detail->sub_total = $detail->harga_beli * $request[$nama_input];
                $totalqty = $detail->qty+1;
                $detail->qty = $detail->qty+1;

                $detail->total_price=$detail->po_price*$totalqty;

                $detail->update();
                // dd('here');
            } else {
                # code...
                $prpart = new Prdetail;
                $prpart->prs_id=$id;
                $prpart->spareparts_id=$spareparts_id;
                $prpart->po_price=$price;
                $prpart->total_price=$price;
                $prpart->qty=1;
                $prpart->created_by=Auth::user()->name;
                $prpart->save();
            }
                $pr = Pr::find($id);
            
            
            return redirect()->route('pr.edit', $pr);
            
        }
    public function listdetailpr($id)
    {
        $prdetais = DB::table('prdetails')
            ->leftjoin('spareparts', 'spareparts.spareparts_id', '=', 'prdetails.spareparts_id')
            ->where('prdetails.prs_id','=',$id)
            ->get();
        $prstatus = Pr::find($id);
        $no = 0;
        $data = array();
        foreach($prdetais as $prdetai){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $prdetai->part_number;
            $row[] = $prdetai->spareparts_name;
            if ($prstatus->pr_status == 'Draft') {
                # code...
            $row[] = "<input type='number' class='form-control' name='jumlah_$prdetai->prdetails_id' value='$prdetai->qty' onChange='changeQty($prdetai->prdetails_id)'>";

            } else {
                # code...
            $row[] = $prdetai->qty;

            }
            
            $row[] = $prdetai->uom;

            if ($prstatus->pr_status == 'Draft') {
                $row[] = '<div>
                    <a onClick="deleteData('.$prdetai->prdetails_id.')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </div>';
            } else {
                $row[] = '-';
            }
            

            
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }
    public function update(Request $request, $id)
        {
            
            $nama_input = "jumlah_".$id;
            $detail = Prdetail::find($id);
            // $spareparts = Sparepart::find($detail->spareparts_id);
            // $price = $spareparts->price;
            // $detail->jumlah = $request[$nama_input];
            // $detail->jumlah = $request['jumlah_12'];
            // $detail->sub_total = $detail->harga_beli * $request[$nama_input];
            $detail->qty=$request[$nama_input];
            $detail->total_price=$detail->po_price*$request[$nama_input];

            $detail->update();
        }
    public function destroy($id)
    {
        $detail = Prdetail::find($id);
        $detail->delete();
    }
}
