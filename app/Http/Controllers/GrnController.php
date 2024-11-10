<?php

namespace App\Http\Controllers;
use App\Grn;
use App\Sparepart;
use App\Supplier;
use App\Employee;
use App\Requested;
use App\Manufacturer;
use App\Requisition;
use App\Suplier;
use App\Prdetail;
use App\Pr;
use App\Partpackage;
use App\Workorder;
use App\Vehicle;
use Carbon\Carbon;
use Auth;

use DB;
use Illuminate\Http\Request;

class GrnController extends Controller
{
    public function index()
    {
        return view('grn.indexgrn');
    }
        public function store(Request $request)
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
        $gr_alias = "DMM/$po_number/GR/$month/$year";
        return($gr_alias);

        $grn = new Grn;
        $grn->grns_date=$request['grns_date'];
        $grn->gr_alias=$request['gr_alias'];
        $grn->spareparts_id=$request['spareparts_id'];
        $grn->supplier=$request['supplier'];
        $grn->document=$request['document'];
        $grn->document_number=$request['document_number'];
        $grn->receipt_from=$request['receipt_from'];
        $grn->condition=$request['condition'];
        $grn->qty=$request['qty'];
        $grn->uom=$request['uom'];
        $grn->remarks=$request['remarks'];
        // $grn->taken_by=$request['taken_by'];
        $grn->store_man=Auth::user()->name;
        // $grn->approved_by=$request['approved_by'];
        $grn->created_by=$request['created_by'];
        $grn->save();

        // $stock = DB::table('spareparts')->where('spareparts_id','=',$request['spareparts_id']);
        // $stock->increment('stock', $request['qty']);
        

        // ->where('spareparts_id','=',$request['spareparts_id'])
        

    }
    public function edit($id)
    {
        $grn = Grn::find($id);
        echo json_encode($grn);
    }
    public function update(Request $request, $id)
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
        $gr_alias = "DMM/$po_number/GR/$month/$year";
        return($gr_alias);
        $grn = new Grn;
        $grn = Grn::find($id);
        $grn->grns_date=$request['grns_date'];
        $grn->gr_alias=$request['gr_alias'];
        $grn->spareparts_id=$request['spareparts_id'];
        $grn->supplier=$request['supplier'];
        $grn->document=$request['document'];
        $grn->document_number=$request['document_number'];
        $grn->receipt_from=$request['receipt_from'];
        $grn->condition=$request['condition'];
        $grn->qty=$request['qty'];
        $grn->uom=$request['uom'];
        $grn->remarks=$request['remarks'];
        $grn->taken_by=$request['taken_by'];
        $grn->store_man=$request['store_man'];
        $grn->approved_by=$request['approved_by'];
        $grn->created_by=$request['created_by'];




        $grn->update();
    }
    public function destroy($id)
    {
        $grn = Grn::find($id);
        $grn->delete();
    }

    public function listgrn()
    {
        // $grns = Grn::orderBy('created_at','desc')->get();
        $grns = DB::table('grns')
            ->leftjoin('spareparts', 'spareparts.spareparts_id', '=', 'grns.spareparts_id')
            // ->leftjoin('manufacturers', 'manufacturers.manufacturers_id', '=', 'grns.manufacture')
            ->leftjoin('doctypes', 'doctypes.doctypes_id', '=', 'grns.document')
            ->where('grns.document_number','!=','INIT001')
            ->get();
            // return($grns);
        $no = 0;
        $data = array();
        foreach($grns as $grn){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $grn->grns_date;
            $row[] = $grn->gr_alias;

            $row[] = $grn->part_number;
            $row[] = $grn->spareparts_name;
            $row[] = $grn->doctypes_name;
            $row[] = $grn->document_number;
            // $supplier = Supplier::find($grn->receipt_from);
            $row[] = $grn->supplier;
            $row[] = $grn->condition;
            $row[] = $grn->qty;
            $row[] = $grn->uom;
            $row[] = $grn->remarks;
            $row[] = $grn->store_man;
            // $store = Employee::find($grn->store_man);
            // $row[] = $store->employees_name;
            // $approved_by = Employee::find($grn->approved_by);
            // $row[] = $approved_by->employees_name;

            // $row[] = '<div>
            //         <a onCLick="editForm('.$grn->grns_id.')" class="btn btn-info"><i class="fa fa-edit"></i></a>
            //         <a onClick="deleteData('.$grn->grns_id.')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            //         </div>';
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }

    public function listrequestedgrn()
    {
        
        // $requesteds = Requested::orderBy('created_at','desc')
        // ->where('requisitions_id','=',$id)
        // ->get();
        ///////////////GA ADA WO


        // $requesteds = DB::table('prdetails')
        //     ->leftjoin('spareparts', 'spareparts.spareparts_id', '=', 'prdetails.spareparts_id')
        //     ->leftJoin('prs','prs.prs_id','=','prdetails.prs_id')
        //     ->where('prs.po_status','=','Submit')
        //     ->leftJoin('grns', function($join){
        //         $join->on('grns.prs_id', '=', 'prdetails.prs_id');
        //         $join->on('grns.spareparts_id', '=', 'prdetails.spareparts_id');
        //     })
            
        //     ->groupBy('spareparts.spareparts_id','prdetails.prs_id','prdetails.prdetails_id','prs.po_alias','spareparts.uom','prdetails.qty','spareparts.spareparts_name','spareparts.part_number')
        //     ->select('prdetails.prs_id as prs_id','prdetails.prdetails_id as prdetails_id','prs.po_alias as po_alias','spareparts.uom as uom','prdetails.qty as qty','spareparts.spareparts_name as spareparts_name',
        //     'spareparts.part_number as part_number',
        //     DB::raw('SUM(grns.qty) as total_grn', DB::raw('SUM(prdetails.qty) as qty')))
        //     ->get();


            // return($requesteds);
       


        // $no = 0;
        // $data = array();
        // $totals = 0;
        // foreach($requesteds as $requested){
            
            
        //     if ($requested->total_grn >= $requested->qty) {
            
        //     } else {
        //     $no++;
        //     $row=array();
        //     $row[] = $no;
        //     $row[] = $requested->po_alias;
        //     $row[] = $requested->part_number;
        //     $row[] = $requested->spareparts_name;
        //     $row[] = $requested->qty;
        //     $row[] = $requested->total_grn;
        //     $row[] = $requested->uom;
        //     $row[] = '<div>
        //             <a href="addgrn/'.$requested->prdetails_id.'" class="btn btn-info"><i class="fa fa-plus"></i></a>

        //             </div>';
        //     $data[]=$row;
            
        //     }
            
        ///////////////GA ADA WO
        

        $requesteds = DB::table('prdetails')->get();


            // $totals += $total;

        $no = 0;
        $data = array();
        $totals = 0;
        foreach($requesteds as $requested){
            
            if (!empty($requested->prs_id)){
            //PO
                $prs=Pr::find($requested->prs_id);
                $part=Sparepart::find($requested->spareparts_id);
                $total_grn=Grn::where('document',$requested->prs_id)->where('spareparts_id',$requested->spareparts_id)->sum('qty');
                
                if ($total_grn >= $requested->qty OR $prs->po_status != 'Submit') {
            
                } else {
                $no++;
                $row=array();
                $row[] = $no;
                
                $row[] = $prs->po_alias;
                $row[] = $part->part_number;
                $row[] = $part->spareparts_name;
                $row[] = $requested->qty;
                $row[] = $total_grn;
                $row[] = $part->uom;
                $row[] = '<div>
                        <a href="addgrn/'.$requested->prdetails_id.'" class="btn btn-info"><i class="fa fa-plus"></i></a>

                        </div>';
                $data[]=$row;
                
                }

            } else {
            //WO
                $wo=Partpackage::where('workorders_id',$requested->workorders_id)->where('spareparts_id',$requested->spareparts_id)->first();
                // $wo=Partpackage::where('workorders_id',$requested->workorders_id)   ->first();
                // return($wo);
                $part=Sparepart::find($requested->spareparts_id);
                $total_grn=Grn::where('document',$wo->workorders_id)->where('spareparts_id',$wo->spareparts_id)->sum('qty');
                if ($total_grn >= $wo->wo_qty) {
                // $row[] = 'Anu';
            
                } else {
                $no++;
                $row=array();
                $row[] = $no;
                
                $row[] = $wo->wo_alias;
                $row[] = $part->part_number;
                $row[] = $part->spareparts_name;
                $row[] = $requested->qty;
                $row[] = $total_grn;
                $row[] = $part->uom;
                $row[] = '<div>
                        <a href="addgrn/'.$requested->prdetails_id.'" class="btn btn-info"><i class="fa fa-plus"></i></a>

                        </div>';
                $data[]=$row;
                
                }

            }

           

        }
            // $data[]=array("<span class='hide total'>$totals</span>");

        $output = array("data"=>$data);
        return response()->json($output);
    }
    public function addgrn($id)
    {
       
        $requested = Prdetail::find($id);
        $requisition = Pr::find($requested->prs_id);
        $wo=Partpackage::find($requested->prs_id);
        $sparepart = Sparepart::find($requested->spareparts_id);
        $spareparts_name = $sparepart->spareparts_name;
        $part_number = $sparepart->part_number;
        $uom = $sparepart->uom;
        // $vendor = Supplier::find($requisition->suppliers_id);
        // $manufacture_id = $sparepart->manufacturers_id;
        // $manufactured_id = Manufacturer::find($manufacture_id);

        if (!empty( $requisition->suppliers_id)) {
            # code...
        $supplier = $requisition->suppliers_id;
        $document_number_alias = $requisition->po_alias;
        } else {
            # code...
        $workorder = Workorder::find($requested->workorders_id);
        $vehicles_id = $workorder->vehicles_id;
        $nomor_lambung = Vehicle::where('vehicles_id',$vehicles_id)->first();
        $supplier = $nomor_lambung->nomor_lambung;

        $document_number_alias = $workorder->wo_alias;

        }
        

        $grn = Grn::where('prs_id','=',$requested->prs_id)->where('spareparts_id','=',$requested->spareparts_id)->sum('qty');
        // return($requested->qty);
        $pending = $requested->qty - $grn;
        
        
        return view('grn.formgrn',compact('pending','id','requested','sparepart','part_number','supplier','uom','requisition','document_number_alias'));
    }
    public function savegrn(Request $request)
    {
        // $price = DB::table('orders')->max('price');
        
        $gr_number=DB::table('grns')->max('gr_number');

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
        $number=$gr_number+1;
        $gr_alias = "DMM/$number/GR/$month/$year";
        // // return($gr_alias);
        // $gralias = Grn::find($lastInsertedId);
        // $gralias->gr_alias=$gr_alias;
        // $gralias->update();
        
        $grn = new Grn;
        $grn->grns_date=$request['grns_date'];
        $grn->gr_number=$gr_number+1;
        $grn->gr_alias=$gr_alias;
        $grn->spareparts_id=$request['spareparts_id'];
        $grn->po_number=$request['po_number'];
        $grn->prs_id=$request['prs_id'];
        $grn->supplier=$request['supplier'];
        $grn->document=$request['document'];
        $grn->document_number=$request['document_number_alias'];
        $grn->receipt_from=$request['receipt_from'];
        $grn->condition=$request['condition'];
        $grn->qty=$request['qty'];
        $grn->uom=$request['uom'];
        $grn->remarks=$request['remarks'];
        // $grn->taken_by=$request['taken_by'];
        $grn->store_man=Auth::user()->name;
        // $grn->approved_by=$request['approved_by'];
        $grn->created_by=$request['created_by'];
        $grn->save();
        $lastInsertedId = $grn->grns_id;
        
        $prs=Prdetail::where('prs_id','=', $request->prs_id)->get();
        // return($prs);
        $total_qty_pr = Prdetail::where('prs_id','=', $request->prs_id)->sum('qty');
        $total_qty_gr = Grn::where('prs_id','=', $request->prs_id)->sum('qty');
        if (!empty($prs->prs_id)) {
            # code...
            if ($total_qty_gr >= $total_qty_pr) {
                # code...
            // return($total_qty_gr);
                $prs = Pr::find($request->prs_id);
                $prs->po_status = 'Close';
                $prs->update();
            }
        } 

        

        // return($request);
        
        return redirect()->route('grn.index');
        
    }
}
