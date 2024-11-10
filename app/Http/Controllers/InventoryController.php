<?php

namespace App\Http\Controllers;
use App\Inventory;
use App\Sparepart;
use App\Grn;
use App\Vehiclemodel;
use App\Gin;
use App\Newgrdetail;
use DB;
use PDF;

use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        return view('inventory.indexinventory');
    }
        public function store(Request $request)
    {
        $inventory->inventories_name=$request['inventories_name'];
        $inventory->vehiclemodels_id=$request['vehiclemodels_id'];
        $inventory->manufacturers_id=$request['manufacturers_id'];
        $inventory->part_number=$request['part_number'];
        $inventory->part_name=$request['part_name'];
        $inventory->part_type=$request['part_type'];
        $inventory->uom=$request['uom'];
        $inventory->part_price=$request['part_price'];
        $inventory->price_update=$request['price_update'];
        $inventory->stock=$request['stock'];
        $inventory->min_stock=$request['min_stock'];
        $inventory->max_stock=$request['max_stock'];
        $inventory->reserved=$request['reserved'];
        $inventory->created_by=$request['created_by'];



        $inventory->save();
    }
    public function edit($id)
    {
        $inventory = Inventory::find($id);
        echo json_encode($inventory);
    }
    public function update(Request $request, $id)
    {
        $inventory = Inventory::find($id);
        $inventory->inventories_name=$request['inventories_name'];
        $inventory->vehiclemodels_id=$request['vehiclemodels_id'];
        $inventory->manufacturers_id=$request['manufacturers_id'];
        $inventory->part_number=$request['part_number'];
        $inventory->part_name=$request['part_name'];
        $inventory->part_type=$request['part_type'];
        $inventory->uom=$request['uom'];
        $inventory->part_price=$request['part_price'];
        $inventory->price_update=$request['price_update'];
        $inventory->stock=$request['stock'];
        $inventory->min_stock=$request['min_stock'];
        $inventory->max_stock=$request['max_stock'];
        $inventory->reserved=$request['reserved'];
        $inventory->created_by=$request['created_by'];




        $inventory->update();
    }
    public function destroy($id)
    {
        $inventory = Inventory::find($id);
        $inventory->delete();
    }

    public function listinventory()
    {
        
        // $inventorys = Sparepart::orderBy('created_at','desc')->get();
        $inventorys = DB::table('spareparts')
            ->leftjoin('vehiclemodels', 'vehiclemodels.vehiclemodels_id', '=', 'spareparts.vehiclemodels_id')
            ->leftjoin('manufacturers', 'manufacturers.manufacturers_id', '=', 'spareparts.manufacturers_id')
            ->orderBy('group','asc')
            ->get();
            // return($inventorys);
        $no = 0;
        $data = array();
        foreach($inventorys as $inventory){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $inventory->vehiclemodels_name;
            $row[] = $inventory->manufacturers_name;
            $row[] = $inventory->part_number_group;
            $row[] = $inventory->part_number;
            $row[] = $inventory->spareparts_name;
            $row[] = $inventory->part_type;
            $row[] = $inventory->uom;
            $grns = DB::table('grns')
            ->where('spareparts_id','=',$inventory->spareparts_id)
            ->sum('qty');
            $gins = DB::table('gins')
            ->where('spareparts_id','=',$inventory->spareparts_id)
            ->sum('qty');
            $row[] = $inventory->stock;
            $row[] = $inventory->min_stock;
            $row[] = $inventory->max_stock;
            $wo = DB::table('partpackages')
            ->where('spareparts_id','=',$inventory->spareparts_id)
            ->sum('wo_qty');
            $row[] = $wo-$gins;
            $row[] = '<div class="btn-group">
            <a href="printstock/'.$inventory->spareparts_id.'" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-print"></i></a>
            </div>';
            // $row[] = '<div>

            //         <a onCLick="printWo('.$inventory->spareparts_id.')" class="btn btn-info"><i class="fa fa-print"></i></a>
                    
            //         </div>';
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }
    public function printstock($id)
    {
        
        // $datastock = Sparepart::find($id);
        $datastock = DB::table('spareparts')
            ->leftjoin('vehiclemodels', 'vehiclemodels.vehiclemodels_id', '=', 'spareparts.vehiclemodels_id')
            ->where('spareparts.spareparts_id',$id)
            ->first();
        // $datastock = DB::table('spareparts')->where('spareparts.spareparts_id',$id)
        //     ->first();
        
        
        // $datastock = json_encode($datastocks);
        $data = Sparepart::find($id);
        // return($data);

        // $grns = Grn::where('spareparts_id','=',$id)->get();
        // $grns = DB::table('spareparts')
        // ->leftJoin('grns','grns.spareparts_id','=','spareparts.spareparts_id')
        // ->leftJoin('gins','gins.spareparts_id','=','spareparts.spareparts_id')
        // ->where('spareparts.spareparts_id','=',$id)
        // ->select('grns.grns_date as grns_date','grns.grns_date as date','grns.qty as in','gins.qty as out','gins.qty as total','spareparts.uom as uom')
        // ->groupBy('grns_date','in','out','total','uom')        
        // ->get();
        $grns=Newgrdetail::where('spareparts_id','=',$id)
        ->leftJoin('newgrs','newgrs.newgrs_id','=','newgrdetails.newgrs_id')
        ->orderBy('newgrs.gr_date','DESC')
        ->limit('5')
        ->get();
        // return($grns);
        $gins=Gin::where('spareparts_id','=',$id)->get();
        // return($maintenance);
        // $totalstock = Grn::where('spareparts_id','=',$id)->sum('qty') - Gin::where('spareparts_id','=',$id)->sum('qty');
        $totalstock = Sparepart::where('spareparts_id','=',$id)->sum('stock');
        $adjusment = DB::table('stockpname_adjs')->where('spareparts_id','=',$id)->get();
    $no = 1;
    $no = 1;
    $pdf = PDF::loadView('inventory.stockcard',compact('data','datastock','grns','totalstock','gins','adjusment'));
    $pdf->setPaper('a7','potrait');
    return $pdf->stream();
    }

}
