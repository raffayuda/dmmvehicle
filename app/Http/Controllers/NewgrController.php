<?php

namespace App\Http\Controllers;

use App\Newpodetail;
use App\Newgrdetail;
use App\Supplier;
use App\Vehiclemodel;
use App\Newpo;
use App\Newgr;
use App\Sparepart;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;


class NewgrController extends Controller
{
    public function index()
    {
    return view('newgr.index');
    }

    public function newgrdata()
    {
        // dd('here');
        $grs = DB::table('newgrs')
        ->orderBy('updated_at','DESC')
            ->get();
        $no = 0;
        $data = array();
        foreach($grs as $gr){
            $no++;
            $row=array();
            $row[] = $no;

            $row[] = $gr->gr_date;
            $row[] = $gr->gr_alias;
            $row[] = $gr->doc_type;
            $row[] = $gr->document_number;
            $row[] = $gr->received_form;
            $row[] = $gr->storeman;
            $row[] = $gr->gr_status;

            
            // if ($po->po_status == 'Submit' OR $po->po_status == 'Cancel') {
            //     # code...
            //     $row[] = '
            //         <a href="/dmmvehicle/viewsubmit/'.$po->newpos_id.'" class="btn btn-info"><i class="fa fa-edit"></i></a>

            //         </div>';
            // } else {
                # code...
                 $row[] = '
                    <a href="/dmmvehicle/newgr/'.$gr->newgrs_id.'/edit" class="btn btn-info"><i class="fa fa-edit"></i></a>

                    </div>';
            // }
            
            $data[]=$row;

           
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }

    public function addgrdata()
    {
        // Nantinya perlu di union dengan WO masih dipikirin...
        $pos = DB::table('newpos')
            ->where('po_status','Submit')
            ->get();
        $no = 0;
        $data = array();
        foreach($pos as $po){
            
            // $prqty = Newprdetail::where('newprs_id',$pr->newprs_id)->sum('pr_qty');
            $poqty = Newpodetail::where('newpos_id',$po->newpos_id)->where('po_status','Submit')->sum('po_qty');
            $grqty = Newgrdetail::where('newpos_id',$po->newpos_id)->sum('gr_qty');

            if ($poqty-$grqty > 0) {
                # code...
                $no++;
                $row=array();
                $row[] = $no;
                $row[] = $po->po_alias;
                $row[] = $po->suppliers_id;
                $row[] = $poqty-$grqty;
                $row[] = '
                        <a href="/dmmvehicle/newgr/'.$po->newpos_id.'/addgr" class="btn btn-info"><i class="fa fa-plus"></i></a>
                        </div>';
                $data[]=$row;
            }
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }

    public function addgr($newpos_id)
    {

        $pos = Newpo::find($newpos_id);
        $no = 0;
        // $prdetails = Newprdetail::where('newprs_id',$newprs_id)->get();
        $podetails = DB::table('newpodetails')
        ->join('spareparts', function ($join) use ($newpos_id){
            $join->on('newpodetails.spareparts_id', '=', 'spareparts.spareparts_id')
                 ->where('newpodetails.newpos_id', $newpos_id);
        })
        ->get();
        $suppliers = Supplier::all();
        $vehicles_model = Vehiclemodel::all();
        return view('newgr.create',compact('id','pos','podetails','no','suppliers','vehicles_model'));
    }

    public function edit($id)
    {

        $gr = Newgr::find($id);
        $newgrs_id = $gr->newgrs_id;
        $newpos_id = $gr->newpos_id;
        $pos =Newpo::find($newpos_id);
        // return($gr);
        $suppliers = Supplier::all();
        $vehicles_model = Vehiclemodel::all();
        $podetails = DB::table('newpodetails')
        ->join('spareparts', function ($join) use ($newpos_id){
            $join->on('newpodetails.spareparts_id', '=', 'spareparts.spareparts_id')
                 ->where('newpodetails.newpos_id', $newpos_id);
        })
        ->get();
        // return($podetails);

        $grdetails = DB::table('newgrdetails')
        ->join('spareparts', function ($join) use ($newgrs_id){
            $join->on('newgrdetails.spareparts_id', '=', 'spareparts.spareparts_id')
                 ->where('newgrdetails.newgrs_id', $newgrs_id);
        })
        ->get();
        $no = 0;

        // return redirect()->route('pr.edit', [$id]);
        return view('newgr.edit',compact('id','gr','pos','suppliers','vehicles_model','podetails','no','grdetails'));

    }

    public function submitnewgr($newgrs_id)
    {
        // $pr_qty = Newprdetail::where('newprs_id',$id)->sum('pr_qty');
        $gr = Newgr::find($newgrs_id);

        if (empty($gr->gr_number)) {
            # code...
            $grmax = Newgr::max('gr_number');
            // return($pomax+1);
            $gr_number = $grmax+1;
        } else {
            # code...
            $gr_number = $gr->gr_number;
        }
       
        $gr->gr_status = 'Submit';
        $gr->gr_number = $gr_number;
        // $pr->pr_qty = $pr_qty;
        $gr->update();

        // return($po->po_number);

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
        $gr_alias = "DMM/$gr_number/GR/$month/$year";

        $gr = Newgr::find($newgrs_id);
        $gr->gr_alias = $gr_alias;
        $gr->submitted_date = tanggal_db($now);
        // $gr->po_date = tanggal_db($now);
        $gr->update();

        $grdetails = Newgrdetail::where('newgrs_id',$newgrs_id)->get();
        // return($grdetails);
        foreach ($grdetails as $grdetail){
            // return($grdetail->spareparts_id);
            $laststock = Sparepart::find($grdetail->spareparts_id)->stock;
            $updatesaldo = Newgrdetail::find($grdetail->newgrdetails_id);
            $updatesaldo->saldo = $grdetail->gr_qty+$laststock;
            $updatesaldo->update();

            $stockupdate=Sparepart::find($grdetail->spareparts_id);
            $stockupdate->stock = $grdetail->gr_qty+$laststock;
            $stockupdate->update();
            
        }

        
        return redirect()->route('newgr.index');
    }
}
