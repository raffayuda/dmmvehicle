<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Sparepart;
use App\Newpr;
use App\Newprdetail;
use Auth;
use App\User;
use Carbon\Carbon;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Mail\SendMailPo;

class NewprController extends Controller
{
    public function index()
    {
        return view('newpr.index');
    }
    public function create()
    {
        // $id = 'bikin';
        $prs_id = 0;
        $part = Sparepart::all();
        return view('newpr.create',compact('id','prs_id','part'));
    }
    public function store(Request $request)
    {
        // return($request);
        $pr = new Newpr;
        $pr->pr_remarks = $request->pr_remarks;
        $pr->pr_status = $request->pr_status;
        $pr->created_by = $request->created_by;
        $pr->save();

        $id = $pr->newprs_id;
        return redirect()->route('newpr.edit', [$id]);
    }
    public function edit($id)
    {

        $pr = Newpr::find($id);
        // return redirect()->route('pr.edit', [$id]);
        return view('newpr.edit',compact('id','pr'));

    }
    public function update(Request $request, $id)
    {   
        $pr = Newpr::find($id);
        $pr->pr_remarks = $request->pr_remarks;
        $pr->update();
        return redirect()->route('newpr.edit', [$id]);

        // return view('pr.editpr',compact('id','pr'));

    }















    public function newprdata()
    {
        // dd('here');
        $prs = DB::table('newprs')
            ->get();
        $no = 0;
        $data = array();
        foreach($prs as $pr){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $pr->pr_alias;
            $row[] = $pr->created_date;
            $row[] = $pr->aknowledge_date;
            $row[] = $pr->approve_date;
            // $row[] = tanggal_indo($pr->created_at);
            $item = Newprdetail::where('newprs_id',$pr->newprs_id)->count();
            // $pr_qty = Newprdetail::where('newprs_id',$pr->newprs_id)->sum('pr_qty');

            $row[] = $item;
            $row[] = $pr->pr_status;
            $row[] = $pr->po_status;
            // $row[] = $pr->pr_qty;
            // $row[] = $pr->po_qty;
            $row[] = '
                    <a href="/dmmvehicle/newpr/'.$pr->newprs_id.'/edit" class="btn btn-info"><i class="fa fa-edit"></i></a>

                    </div>';
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }

    public function submitnewpr($id)
    {
        $pr_qty = Newprdetail::where('newprs_id',$id)->sum('pr_qty');

        $prmax = Newpr::max('pr_number');
        $pr_number = $prmax+1;
        $pr = Newpr::find($id);
        $pr->pr_status = 'Submit';
        $pr->pr_number = $pr_number;
        $pr->pr_qty = $pr_qty;
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

        $pr = Newpr::find($id);
        $pr->pr_alias = $po_alias;
        $pr->created_date = tanggal_db($now);
        $pr->update();
        // return($id);


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
            'message'   =>  'http://156.67.214.243/dmmvehicle/newpr/'.$id.'/edit'
            
        );
        // Mail::to($tos)->cc($ccs)->send(new SendMail($data));
        Mail::to($email)->send(new SendMail($data));
        // Mail::to('andi.ruswandi@gmail.com')->send(new SendMail($data));

        
        
        // return redirect()->route('newpr.edit', [$id]);
        return redirect()->route('newpr.index');

        // return view('pr.editpr',compact('id','pr'));
    }

    public function rejectnewpr($id)
    {
         // return($id);
        $requisition = Newpr::find($id);
        $requisition->pr_status='Rejected';
        $requisition->update();
        // return view('purchase.indexpurchase');
        
        return redirect()->route('newpr.index');
    }
    public function acknowledgenewpr($id)
    {
         // return($id);
        $now = Carbon::today();

        $requisition = Newpr::find($id);
        $requisition->aknowledge_date = tanggal_db($now);
        $requisition->aknowledge_by = Auth::user()->name;

        $requisition->pr_status='Acknowledge';
        $requisition->update();
        // return view('purchase.indexpurchase');
        
        return redirect()->route('newpr.index');
    }

    public function approvenewpr($id)
    {
        $now = Carbon::today();
        
        $pr = Newpr::find($id);
        $pr->pr_status = 'Approve';
        $pr->approve_by = Auth::user()->name;
        $pr->approve_date = tanggal_db($now);
        $pr->po_status = 'Open';
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
            'message'   =>  'http://156.67.214.243/dmmvehicle/newpr/'.$id.'/edit'
            
        );
        // Mail::to($tos)->cc($ccs)->send(new SendMail($data));
        Mail::to($email)->send(new SendMailPo($data));
        // Mail::to('andi.ruswandi@gmail.com')->send(new SendMail($data));

        return redirect()->route('newpr.index');

        // return redirect()->route('newpr.edit', [$id]);

        // return view('pr.editpr',compact('id','pr'));
    }
}
