<?php

namespace App\Http\Controllers;
use App\Gin;
use App\Sparepart;
use App\Employee;
use App\Partpackage;
use App\Workorder;
use App\Vehicle;
use DB;
use Illuminate\Http\Request;

class GinController extends Controller
{
    public function index()
    {
        return view('gin.indexgin');
    }
        public function store(Request $request)
    {
        $gin = new Gin;
        $gin->gins_date=$request['gins_date'];
        $gin->spareparts_id=$request['spareparts_id'];
        $gin->part_number=$request['part_number'];
        $gin->part_name=$request['part_name'];
        $gin->manufacture=$request['manufacture'];
        $gin->document=$request['document'];
        $gin->document_number=$request['document_number'];
        $gin->used_for=$request['used_for'];
        $gin->condition=$request['condition'];
        $gin->qty=$request['qty'];
        $gin->uom=$request['uom'];
        $gin->remarks=$request['remarks'];
        $gin->taken_by=$request['taken_by'];
        $gin->store_man=$request['store_man'];
        $gin->approved_by=$request['approved_by'];
        $gin->created_by=$request['created_by'];
        $gin->save();

        // $stock = DB::table('spareparts')->where('spareparts_id','=',$request['spareparts_id']);
        // $stock->decrement('stock', $request['qty']);
    }
    public function edit($id)
    {
        $gin = Gin::find($id);
        echo json_encode($gin);
    }
    public function update(Request $request, $id)
    {
        $gin = Gin::find($id);
        $gin->gins_date=$request['gins_date'];
        $gin->spareparts_id=$request['spareparts_id'];
        $gin->part_number=$request['part_number'];
        $gin->part_name=$request['part_name'];
        $gin->manufacture=$request['manufacture'];
        $gin->document=$request['document'];
        $gin->document_number=$request['document_number'];
        $gin->used_for=$request['used_for'];
        $gin->condition=$request['condition'];
        $gin->qty=$request['qty'];
        $gin->uom=$request['uom'];
        $gin->remarks=$request['remarks'];
        $gin->taken_by=$request['taken_by'];
        $gin->store_man=$request['store_man'];
        $gin->approved_by=$request['approved_by'];
        $gin->created_by=$request['created_by'];


        $gin->update();
    }
    public function destroy($id)
    {
        $gin = Gin::find($id);
        $gin->delete();
    }

    public function listgin()
    {
        
        // $gins = Gin::orderBy('created_at','desc')->get();
        $gins = DB::table('gins')
            ->leftjoin('spareparts', 'spareparts.spareparts_id', '=', 'gins.spareparts_id')
            ->leftjoin('manufacturers', 'manufacturers.manufacturers_id', '=', 'gins.manufacture')
            // ->leftjoin('doctypes', 'doctypes.doctypes_id', '=', 'gins.document')
            // ->leftjoin('employees', 'employees.employees_id', '=', 'gins.taken_by')
	->orderBy('gins.gins_id','DESC')
           ->limit('1000')
            ->get();
            // return($gins);
        $no = 0;
        $data = array();
        foreach($gins as $gin){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $gin->gins_date;
            $part_name = Sparepart::find($gin->spareparts_id);
            $row[] = $part_name->part_number;
            $row[] = $part_name->spareparts_name;
            $row[] = $gin->used_for;
            $row[] = $gin->manufacturers_name;
            $row[] = $gin->document;
            $row[] = $gin->document_number_alias;
            $row[] = $gin->condition;
            $row[] = $gin->qty;
            $row[] = $gin->uom;
            $row[] = $gin->remarks;
            $taken = Employee::find($gin->taken_by);
            if (!empty($taken)) {
                # code...
            $row[] = $taken->employees_name;

            } else {
                # code...
            $row[] = '-';

            }
                        
            $store = Employee::find($gin->store_man);
            if (!empty($store)) {
                # code...
            $row[] = $store->employees_name;

            } else {
                # code...
            $row[] = '-';

            }
            
            $approved_by = Employee::find($gin->approved_by);
            if (!empty($approved_by)) {
                # code...
            $row[] = $approved_by->employees_name;

            } else {
                # code...
            $row[] = '-';

            }
            

            $row[] = '-';




            // $row[] = '<div>
            //         <a onCLick="editForm('.$gin->gins_id.')" class="btn btn-info"><i class="fa fa-edit"></i></a>
            //         <a onClick="deleteData('.$gin->gins_id.')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            //         </div>';
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }
    public function listrequestedgin()
    {
        // $requesteds = Requested::orderBy('created_at','desc')
        // ->where('requisitions_id','=',$id)
        // ->get();
        $requesteds = DB::table('partpackages')
            ->leftjoin('spareparts', 'spareparts.spareparts_id', '=', 'partpackages.spareparts_id')
            // ->leftjoin('grns','grns.po_number','=','requesteds.po_number')
            // ->leftJoin('grns', function($join) use ($param1, $param2)
            // {
            //     $join->on('grns.po_numbe', '=', 'requesteds.po_number');
            //     $join->on('arrival','=',DB::raw("'".$param1."'"));
            //     $join->on('arrival','=',DB::raw("'".$param2."'"));

            // })
            ->leftJoin('gins', function($join){
                $join->on('gins.workorders_id', '=', 'partpackages.workorders_id');
                $join->on('gins.spareparts_id', '=', 'partpackages.spareparts_id');
            })
            // ->where('requesteds.po_number','>',0)
            // ->where('grns.spareparts_id','=',)
            ->groupBy('spareparts.spareparts_id','partpackages.workorders_id','partpackages.partpackages_id','partpackages.wo_alias','spareparts.uom','partpackages.wo_qty','spareparts.spareparts_name','spareparts.part_number')
            ->select('spareparts.spareparts_id','partpackages.workorders_id as wo_number','partpackages.partpackages_id as partpackages_id','partpackages.wo_alias as wo_alias','spareparts.uom as uom','partpackages.wo_qty as qty','spareparts.spareparts_name as spareparts_name','spareparts.part_number as part_number',
            DB::raw('SUM(gins.qty) as total_gin'))
            // ->havingRaw('SUM(grns.qty) < ?', ['requesteds.qty'])
            ->get();
            // return($requesteds);

        // $orders = DB::table('orders')
        //         ->select('department', DB::raw('SUM(price) as total_sales'))
        //         ->groupBy('department')
        //         ->havingRaw('SUM(price) > ?', [2500])
        //         ->get();
        $no = 0;
        $data = array();
        $totals = 0;
        foreach($requesteds as $requested){
            $workorder = Workorder::find($requested->wo_number);
            // return($workorder);
            if ($requested->total_gin >= $requested->qty OR $workorder->packages_id == 17) {
                # code...
            } else {
                # code...
                $no++;
                $row=array();
                $row[] = $no;
                $row[] = $requested->wo_alias;
                $row[] = $requested->part_number;
                $row[] = $requested->spareparts_name;
                $row[] = $requested->qty;
                $row[] = $requested->total_gin;
                $stock = Sparepart::find($requested->spareparts_id);
                $row[] = $stock->stock;

                $row[] = $requested->uom;
                if ($requested->qty <= $stock->stock) {
                    # code...
                    $row[] = '<div>
                        <a href="addgin/'.$requested->partpackages_id.'" class="btn btn-info"><i class="fa fa-plus"></i></a>

                        </div>';
                } else {
                    # code...
                    $row[]='Out of Stock';
                }
                
                
                

                
                $data[]=$row;
                // $totals += $total;
            }
            
            

        }
            // $data[]=array("<span class='hide total'>$totals</span>");

        $output = array("data"=>$data);
        return response()->json($output);
    }
    public function addgin($id)
    {
        // dd($id);
        $requested = Partpackage::find($id);
        $sparepart = Sparepart::find($requested->spareparts_id);
        $spareparts_name = $sparepart->spareparts_name;
        $part_number = $sparepart->part_number;
        $uom = $sparepart->uom;
        $workorder=Workorder::find($requested->workorders_id);
        $vehicles_id=Vehicle::find($workorder->vehicles_id);
        $nomor_lambung=$vehicles_id->nomor_lambung;
        $manufacture = $sparepart->manufacturers_id;
        // $gin = Gin::where('workorders_id','=',$requested->workorders_id)->where()->sum('qty');
        $gin = Gin::where('workorders_id','=',$requested->workorders_id)->where('spareparts_id','=',$requested->spareparts_id)->sum('qty');

        $pending = $requested->wo_qty - $gin;
        // return($);
        return view('gin.formgin',compact('nomor_lambung','spareparts_name','pending','id','requested','sparepart','part_number','manufacture','uom'));
    }
    public function savegin(Request $request)
    {
        // return($request);
        $gin = new Gin;
        $gin->gins_date=$request['gins_date'];
        $gin->spareparts_id=$request['spareparts_id'];
        $gin->part_number=$request['spareparts_ids'];
        $gin->part_name=$request['part_name'];
        // $gin->manufacture=$request['manufacture'];
        $gin->document=$request['documents'];
        $gin->document_number_alias=$request['document_number_alias'];
        $gin->workorders_id=$request['wo_number'];
        $gin->used_for=$request['nomor_lambung'];
        // $gin->condition=$request['condition'];
        $gin->qty=$request['qty'];
        $gin->uom=$request['uom'];
        $gin->remarks=$request['remarks'];
        $gin->taken_by=$request['taken_by'];
        $gin->store_man=$request['store_man'];
        $gin->approved_by=$request['approved_by'];
        $gin->created_by=$request['created_by'];

        $gin->save();
        
        $laststock = Sparepart::find($request['spareparts_id'])->stock;
            // $updatesaldo = Newgrdetail::find($grdetail->newgrdetails_id);
            // $updatesaldo->saldo = $grdetail->gr_qty+$laststock;
            // $updatesaldo->update();

            $stockupdate=Sparepart::find($request['spareparts_id']);
            $stockupdate->stock = $laststock-$request['qty'];
            $stockupdate->update();

        return redirect()->route('gin.index');
        
    }
}
