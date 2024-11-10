<?php

namespace App\Http\Controllers;
use App\Sparepart;
use App\Partpackage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Http\Request;

class PartpackageController extends Controller
{
    public function index()
    {
        
    }
    public function listpartpackageselect($id)
    {
        
        // $spareparts = Sparepart::orderBy('created_at','desc')->get();
        $partpackages = DB::table('partpackages')
            ->leftjoin('spareparts', 'spareparts.spareparts_id', '=', 'partpackages.spareparts_id')
            // ->leftjoin('manufacturers', 'manufacturers.manufacturers_id', '=', 'spareparts.manufacturers_id')
            // ->leftjoin('parttypes', 'parttypes.parttypes_id', '=', 'spareparts.part_type')
            ->select('partpackages.partpackages_id as partpackages_id','spareparts.part_number as part_number','spareparts.spareparts_name as spareparts_name','partpackages.wo_qty as wo_qty','partpackages.created_by as created_by','spareparts.stock as stock','spareparts.uom as uom')
            ->where('partpackages.workorders_id','=',$id)
            ->get();
            // return($spareparts);
        $no = 0;
        $data = array();
        foreach($partpackages as $partpackage){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $partpackage->part_number;
            $row[] = $partpackage->spareparts_name;
            $row[] = $partpackage->wo_qty;
            $row[] = $partpackage->stock;
            $row[] = $partpackage->uom;
            $row[] = $partpackage->created_by;

            $row[] = '<div>
                    <a href="/dmmvehicle/editpart/'.$partpackage->partpackages_id.'/'.$id.'" class="btn btn-info"><i class="fa fa-edit"></i></a>

                    <a onClick="deleteDatapart('.$partpackage->partpackages_id.')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    
                    </div>';
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }

    public function listpartpackage($id)
    {
        
        // $spareparts = Sparepart::orderBy('created_at','desc')->get();
        $spareparts = DB::table('spareparts')
            ->leftjoin('vehiclemodels', 'vehiclemodels.vehiclemodels_id', '=', 'spareparts.vehiclemodels_id')
            ->leftjoin('manufacturers', 'manufacturers.manufacturers_id', '=', 'spareparts.manufacturers_id')
            ->leftjoin('parttypes', 'parttypes.parttypes_id', '=', 'spareparts.part_type')
            // ->where('spareparts.vehiclemodels_id','=',2)
            // ->orWhere('spareparts.vehiclemodels_id','=',5)
            ->get();
            // return($spareparts);
        $no = 0;
        $data = array();
        foreach($spareparts as $sparepart){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $sparepart->vehiclemodels_name;
            $row[] = $sparepart->part_number_group;
            $row[] = $sparepart->part_number;
            $row[] = $sparepart->spareparts_name;
            $row[] = $sparepart->stock;
            $row[] = $sparepart->uom;



            $row[] = '<div>
                    <a href="/dmmvehicle/addpart/'.$sparepart->spareparts_id.'/'.$id.'" class="btn btn-info"><i class="fa fa-plus"></i></a>

                    </div>';
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }
    public function addpart(Request $request, $part, $work)
    {
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
        $wo_alias = "DMM/$work/WO/$month/$year";
        // return($wo_alias);
        $addpart = New Partpackage;
        $addpart->workorders_id=$work;
        $addpart->spareparts_id=$part;
        $addpart->wo_alias=$wo_alias;
        $addpart->wo_qty=1;
        $addpart->created_by=Auth::user()->name;

        $addpart->save();
        return redirect()->route('workorder.edit', [$work]);

        // return back();

    }
    public function destroy($id)
    {
        $partpackage = Partpackage::find($id);
        $partpackage->delete();
    }
    public function show($id)
    {
        return($id);
    }
    public function edit($id)
    {
        return($id);

        $partpackage = Partpackage::find($id);
        return($partpackage);
    }
    public function editpart($id,$work)
    {
        // dd('here');
        // return($work);
        $partpackage = Partpackage::find($id);
        $sparepart = Sparepart::find($partpackage->spareparts_id);
        $sparepart_name = $sparepart->spareparts_name;
        // return($sparepart);
        return view('workorder.editpart',compact('partpackage','id','sparepart_name','work'));
    }
    public function updatepart(Request $request, $id)
    {
        // return($request);
        $partpackage = Partpackage::find($id);
        $partpackage->wo_qty=$request['wo_qty'];
        $partpackage->update();
        return redirect()->route('workorder.edit', $request['work']);
        
        // return($request);
        // dd('here');
    }
}
