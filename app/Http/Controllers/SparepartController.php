<?php

namespace App\Http\Controllers;
use App\Sparepart;
use DB;
use Illuminate\Http\Request;

class SparepartController extends Controller
{
    public function index()
    {
        return view('sparepart.indexsparepart');
    }
        public function store(Request $request)
    {
        $sparepart = new Sparepart;
        $sparepart->spareparts_name=$request['spareparts_name'];
        $sparepart->vehiclemodels_id=$request['vehiclemodels_id'];
        $sparepart->manufacturers_id=$request['manufacturers_id'];
        $sparepart->part_number_group=$request['part_number_group'];
        $sparepart->part_number=$request['part_number'];
        $sparepart->part_type=$request['part_type'];
        $sparepart->min_stock=$request['min_stock'];
        $sparepart->max_stock=$request['max_stock'];
        $sparepart->uom=$request['uom'];
        $sparepart->price=$request['price'];
        $sparepart->price_update=$request['price_update'];
        $sparepart->status=$request['status'];
        $sparepart->created_by=$request['created_by'];


        $sparepart->save();
    }
    public function edit($id)
    {
        $sparepart = Sparepart::find($id);
        echo json_encode($sparepart);
    }
    public function update(Request $request, $id)
    {
        $sparepart = Sparepart::find($id);
        $sparepart->spareparts_name=$request['spareparts_name'];
        $sparepart->vehiclemodels_id=$request['vehiclemodels_id'];
        $sparepart->manufacturers_id=$request['manufacturers_id'];
        $sparepart->part_number_group=$request['part_number_group'];
        $sparepart->part_number=$request['part_number'];
        $sparepart->part_type=$request['part_type'];
        $sparepart->min_stock=$request['min_stock'];
        $sparepart->max_stock=$request['max_stock'];
        $sparepart->uom=$request['uom'];
        $sparepart->price=$request['price'];
        $sparepart->price_update=$request['price_update'];
        $sparepart->status=$request['status'];

        $sparepart->created_by=$request['created_by'];



        $sparepart->update();
    }
    public function destroy($id)
    {
        $sparepart = Sparepart::find($id);
        $sparepart->delete();
    }

    public function listsparepart()
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
            $row[] = $sparepart->min_stock;
            $row[] = $sparepart->max_stock;
            $row[] = $sparepart->uom;
            $row[] = format_uang($sparepart->price);
            $row[] = $sparepart->price_update;
            $row[] = $sparepart->partstatuses_name;


            $row[] = '<div>
                    <a onCLick="editForm('.$sparepart->spareparts_id.')" class="btn btn-info"><i class="fa fa-edit"></i></a>
                    <a onClick="deleteData('.$sparepart->spareparts_id.')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </div>';
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }
}
