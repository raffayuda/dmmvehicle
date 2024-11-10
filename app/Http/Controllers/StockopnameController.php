<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Sparepart;
use App\StockpnameAdj;
use Auth;
class StockopnameController extends Controller
{
    public function index()
    {
        return view('stockopname.indexstockopname');
    }

    public function listsparepartopname ()
    {
        
        // $spareparts = Sparepart::orderBy('created_at','desc')->get();
        $spareparts = DB::table('spareparts')
            ->leftjoin('vehiclemodels', 'vehiclemodels.vehiclemodels_id', '=', 'spareparts.vehiclemodels_id')
            ->leftjoin('manufacturers', 'manufacturers.manufacturers_id', '=', 'spareparts.manufacturers_id')
            ->leftjoin('parttypes', 'parttypes.parttypes_id', '=', 'spareparts.part_type')
            ->leftjoin('partstatuses', 'partstatuses.partstatuses_id', '=', 'spareparts.status')
            ->orderBy('group','asc')
            ->get();
            // return($spareparts);
        $no = 0;
        $data = array();
        foreach($spareparts as $sparepart){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $sparepart->spareparts_name;
            $row[] = $sparepart->vehiclemodels_name;
            $row[] = $sparepart->manufacturers_name;
            $row[] = $sparepart->part_number_group;
            $row[] = $sparepart->part_number;
            $row[] = $sparepart->parttypes_name;
            $row[] = $sparepart->stock;
            $row[] = $sparepart->uom;
            $row[] = '<div>
                    <a onCLick="editForm('.$sparepart->spareparts_id.')" class="btn btn-info"><i class="fa fa-edit"></i></a>
                    <a href="adjustment/'.$sparepart->spareparts_id.'" class="btn btn-info"><i class="fa fa-eye"></i></a>
                    </div>';
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }


    public function update(Request $request, $id)
    {
        // return($request);
        // error_log('Some message here.');
        $sparepart = Sparepart::find($id);
        $sparepart->stock=$request['new_stock'];
        $sparepart->created_by=$request['created_by'];
        $sparepart->update();



        $sparepartadj = new StockpnameAdj;
        $sparepartadj->spareparts_id=$id;
        $sparepartadj->last_stock=$request['last_stock'];
        $sparepartadj->new_stock=$request['new_stock'];
        $sparepartadj->note=$request['note'];
        $sparepartadj->created_by=Auth::user()->name;
        $sparepartadj->save();

    }
    public function adjustment($id)
    {
        $id = $id;
        return view('stockopname.adjustment',compact('id'));
    }
    public function listadjustment ($id)
    {
        
        // $spareparts = Sparepart::orderBy('created_at','desc')->get();
        // $spareparts = DB::table('spareparts')
        //     ->leftjoin('vehiclemodels', 'vehiclemodels.vehiclemodels_id', '=', 'spareparts.vehiclemodels_id')
        //     ->leftjoin('manufacturers', 'manufacturers.manufacturers_id', '=', 'spareparts.manufacturers_id')
        //     ->leftjoin('parttypes', 'parttypes.parttypes_id', '=', 'spareparts.part_type')
        //     ->leftjoin('partstatuses', 'partstatuses.partstatuses_id', '=', 'spareparts.status')
        //     ->orderBy('group','asc')
        //     ->get();
        $adjustments = DB::table('stockpname_adjs')
            ->leftjoin('spareparts','stockpname_adjs.spareparts_id','=','spareparts.spareparts_id')
            ->where('stockpname_adjs.spareparts_id',$id)
            ->select('spareparts.spareparts_name as spareparts_name', 'spareparts.part_number as part_number','stockpname_adjs.last_stock as last_stock','stockpname_adjs.new_stock as new_stock',
            'spareparts.uom as uom','stockpname_adjs.note as note','stockpname_adjs.created_by as created_by','stockpname_adjs.updated_at as updated_at')
            ->orderBy('stockpname_adjs.updated_at','desc')
            ->get();
            // return($spareparts);
        $no = 0;
        $data = array();
        foreach($adjustments as $adjustment){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $adjustment->spareparts_name;
            $row[] = $adjustment->part_number;
            $row[] = $adjustment->last_stock;
            $row[] = $adjustment->new_stock;
            $row[] = $adjustment->uom;
            $row[] = $adjustment->note;
            $row[] = $adjustment->created_by;
            $row[] = $adjustment->updated_at;
            // $row[] = '<div>
            //         <a onCLick="editForm('.$sparepart->spareparts_id.')" class="btn btn-info"><i class="fa fa-edit"></i></a>
            //         <a href="adjustment/'.$sparepart->spareparts_id.'" class="btn btn-info"><i class="fa fa-eye"></i></a>
            //         </div>';
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }

}
