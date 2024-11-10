<?php

namespace App\Http\Controllers;
use DB;
use App\Sparepart;
use App\Pr;
use App\Prdetail;
use Auth;
use App\User;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Mail\SendMailPo;

class PrController extends Controller
{
    public function index()
    {
        return view('pr.indexpr');
    }
    public function create()
    {
        $id = 'bikin';
        $prs_id = 0;
        $part = Sparepart::all();
        return view('pr.createpr',compact('id','prs_id','part'));
    }

// Memilih Part pada Modal
    public function addpartdata($id)
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
            $row[] = $sparepart->part_number_group;
            $row[] = $sparepart->part_number;
            $row[] = $sparepart->spareparts_name;
            $row[] = $sparepart->uom;
            $row[] = '
                    <a href="/dmmvehicle/prdetail/'.$sparepart->spareparts_id.'/'.$id.'" class="btn btn-info"><i class="fa fa-plus"></i></a>

                    </div>';
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }

//List PR pada form Index

    public function prdata()
    {
        $prs = DB::table('prs')
            ->get();
        $no = 0;
        $data = array();
        foreach($prs as $pr){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $pr->remarks;
            $row[] = $pr->pr_alias;
            $row[] = $pr->pr_date;
            // $row[] = tanggal_indo($pr->created_at);
            $item = Prdetail::where('prs_id',$pr->prs_id)->count();

            $row[] = $item;

            $row[] = $pr->po_alias;
            $row[] = $pr->pr_status;
            $row[] = $pr->po_status;
            $row[] = $pr->created_by;
            $row[] = '
                    <a href="/dmmvehicle/pr/'.$pr->prs_id.'/edit" class="btn btn-info"><i class="fa fa-edit"></i></a>

                    </div>';
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }
//Simpan remarks
    public function store(Request $request)

    {
        $pr = new Pr;
        $pr->remarks = $request->remarks;
        $pr->pr_status = 'Draft';
        $pr->created_by = $request->created_by;
        $pr->save();
        $id = $pr->prs_id;
        return redirect()->route('pr.edit', [$id]);

    }
    public function edit($id)
    {

        $pr = Pr::find($id);
        // return redirect()->route('pr.edit', [$id]);
        return view('pr.editpr',compact('id','pr'));

    }
    public function update(Request $request, $id)
    {   
        $pr = Pr::find($id);
        $pr->remarks = $request->remarks;
        $pr->created_by = $request->created_by;
        $pr->update();
        return redirect()->route('pr.edit', [$id]);

        // return view('pr.editpr',compact('id','pr'));

    }
    public function submitpr($id)
    {
        $prmax = Pr::max('pr_number');
        $pr_number = $prmax+1;
        $pr = Pr::find($id);
        $pr->pr_status = 'Submit';
        $pr->pr_number = $pr_number;
        $pr->update();


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
        $po_alias = "DMM/$pr_number/PR/$month/$year";

        $pr = Pr::find($id);
        $pr->pr_alias = $po_alias;
        $pr->pr_date = tanggal_db($now);
        $pr->update();


        // $this->validate($request, [
        //     'name'     =>  'required',
        //     'email'  =>  'required|email',
        //     'message' =>  'required'
        //     ]);

        //         $data = array(
        //             'name'      =>  'All',
        //             'message'   =>   $po_alias
        //         );

        // Mail::to('andi.ruswandi@gmail.com')->send(new SendMail($data));

        $email = User::whereIn('approve_spr', [1, 2])->select('email')->get();
        // $cc = $ioms->iom_cc;
        // return($email);

        // $to = $email->name;
        // return($to);

        // $iom_cc = explode(',', (array)$iom->iom_cc);
        // $ccs = explode(",", $cc);
        // $tos = explode(",", $to);
        // return($pieces);
        $data = array(
            // 'name'      =>  $request->name,
            // 'message'   =>   $request->message
            // 'name'      =>  'email CC'.$id,
            'name'      =>  $po_alias,
            'message'   =>  'http://156.67.214.243/dmmvehicle/pr/'.$id.'/edit'
            
        );
        // Mail::to($tos)->cc($ccs)->send(new SendMail($data));
        Mail::to($email)->send(new SendMail($data));
        // Mail::to('andi.ruswandi@gmail.com')->send(new SendMail($data));

        
        
        return redirect()->route('pr.edit', [$id]);

        // return view('pr.editpr',compact('id','pr'));
    }
    
    public function acknowledgepr($id)
    {
        $now = Carbon::today();
        
        $pr = Pr::find($id);
        $pr->pr_status = 'Acknowledge';
        $pr->acknowledge_by = Auth::user()->name;
        $pr->acknowledge_date = tanggal_db($now);
        $pr->update();

        return redirect()->route('pr.edit', [$id]);

        // return view('pr.editpr',compact('id','pr'));
    }   
    public function approvepr($id)
    {
        $now = Carbon::today();
        
        $pr = Pr::find($id);
        $pr->pr_status = 'Approve';
        $pr->approve_by = Auth::user()->name;
        $pr->approve_date = tanggal_db($now);
        $pr->po_status = 'Draft';
        $pr->update();

         $email = User::where('approve_spr','=',4)->select('email')->get();
        // $cc = $ioms->iom_cc;
        // return($email);

        // $to = $email->name;
        // return($to);

        // $iom_cc = explode(',', (array)$iom->iom_cc);
        // $ccs = explode(",", $cc);
        // $tos = explode(",", $to);
        // return($pieces);
        $data = array(
            // 'name'      =>  $request->name,
            // 'message'   =>   $request->message
            // 'name'      =>  'email CC'.$id,
            'name'      =>  $pr->pr_alias,
            'message'   =>  'http://156.67.214.243/dmmvehicle/pr/'.$id.'/edit'
            
        );
        // Mail::to($tos)->cc($ccs)->send(new SendMail($data));
        Mail::to($email)->send(new SendMailPo($data));
        // Mail::to('andi.ruswandi@gmail.com')->send(new SendMail($data));


        return redirect()->route('pr.edit', [$id]);

        // return view('pr.editpr',compact('id','pr'));
    }
    public function rejectpr($id)
    {
        // return($id);
        $requisition = Pr::find($id);
        $requisition->pr_status='Rejected';
        $requisition->update();
        // return view('purchase.indexpurchase');
        
        return redirect()->route('pr.index');


    }   
}
