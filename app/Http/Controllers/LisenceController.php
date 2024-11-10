<?php

namespace App\Http\Controllers;
use App\Lisence;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LisenceController extends Controller
{
    public function index()
    {
        return view('lisence.indexlisence');
    }
        public function store(Request $request)
    {
        $lisence = new Lisence;
        $lisence->vehicles_id=$request['vehicles_id'];
        $lisence->stnk=$request['stnk'];
        $lisence->pajak_tahunan=$request['pajak_tahunan'];
        $lisence->izin_lapor=$request['izin_lapor'];
        $lisence->kir=$request['kir'];
        $lisence->commisioning=$request['commisioning'];
        $lisence->fuel_issue=$request['fuel_issue'];
        $lisence->road_i=$request['road_i'];
        $lisence->created_by=$request['created_by'];
        $lisence->save();
    }
    public function edit($id)
    {
        // $lisence = Lisence::find($id);
        $lisence = DB::table('lisences')
            ->leftjoin('vehicles', 'vehicles.vehicles_id', '=', 'lisences.vehicles_id')
            ->where('lisences_id','=',$id)
            ->first();
        echo json_encode($lisence);
    }
    public function update(Request $request, $id)
    {
        
        $lisence = Lisence::find($id);
        // $lisence->vehicles_id=$request['vehicles_id'];
        $lisence->stnk=$request['stnk'];
        $lisence->pajak_tahunan=$request['pajak_tahunan'];
        $lisence->izin_lapor=$request['izin_lapor'];
        $lisence->kir=$request['kir'];
        $lisence->commisioning=$request['commisioning'];
        $lisence->fuel_issue=$request['fuel_issue'];
        $lisence->road_i=$request['road_i'];
        $lisence->created_by=$request['created_by'];
        $lisence->update();

    }
    public function destroy($id)
    {
        $lisence = Lisence::find($id);
        $lisence->delete();
    }

    public function listlisence()
    {
        
        // $lisences = Lisence::orderBy('created_at','desc')->get();
        $lisences = DB::table('lisences')
            ->leftjoin('vehicles', 'vehicles.vehicles_id', '=', 'lisences.vehicles_id')
            ->get();
            // return($lisences);
        $no = 0;
        $date1 = Carbon::today();
        $data = array();
        foreach($lisences as $lisence){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $lisence->nomor_lambung;

            $stnk = $date1->diffInDays($lisence->stnk,false);
            if (empty($lisence->stnk)) {
            $row[] = $lisence->stnk;            
            $row[] = '<div><button class="btn btn-dark">NA</button></div>';
            }elseif($lisence->stnk == '1970-01-01'){
            $row[] = '';            
            $row[] = '<div><button class="btn btn-dark">NA</button></div>';
            }elseif($stnk<=30){   
            $row[] = tanggal_indo($lisence->stnk);
            $row[] = '<div><button class="btn btn-danger">URUS</button></div>';
            } else {
            $row[] = tanggal_indo($lisence->stnk);
            
            $row[] =  '<div><button class="btn btn-success">AMAN</button></div>';
            }


            
            $pajak_tahunan = $date1->diffInDays($lisence->pajak_tahunan,false);
            if (empty($lisence->pajak_tahunan)) {
            $row[] = $lisence->pajak_tahunan;
            $row[] = '<div><button class="btn btn-dark">NA</button></div>';
            }elseif($lisence->pajak_tahunan == '1970-01-01'){
            $row[] = '';            
            $row[] = '<div><button class="btn btn-dark">NA</button></div>';
            }elseif($pajak_tahunan<=30){    
            $row[] = tanggal_indo($lisence->pajak_tahunan);
            $row[] = '<div><button class="btn btn-danger">URUS</button></div>';
            } else {
            $row[] = tanggal_indo($lisence->pajak_tahunan);
            $row[] =  '<div><button class="btn btn-success">AMAN</button></div>';
            }



            $izin_lapor = $date1->diffInDays($lisence->izin_lapor,false);
            if (empty($lisence->izin_lapor)) {
            $row[] = $lisence->izin_lapor;
            $row[] = '<div><button class="btn btn-dark">NA</button></div>';
            }elseif($lisence->izin_lapor == '1970-01-01'){
            $row[] = '';            
            $row[] = '<div><button class="btn btn-dark">NA</button></div>';
            }elseif($izin_lapor<=30){    
            $row[] = tanggal_indo($lisence->izin_lapor);
            $row[] = '<div><button class="btn btn-danger">URUS</button></div>';
            } else {
            $row[] = tanggal_indo($lisence->izin_lapor);
            $row[] =  '<div><button class="btn btn-success">AMAN</button></div>';
            }


            $kir = $date1->diffInDays($lisence->kir,false);
            if (empty($lisence->kir)) {
            $row[] = $lisence->kir;
            $row[] = '<div><button class="btn btn-dark">NA</button></div>';
            }elseif($lisence->kir == '1970-01-01'){
            $row[] = '';            
            $row[] = '<div><button class="btn btn-dark">NA</button></div>';
            } else {
            $row[] = tanggal_indo($lisence->kir);
            $row[] =  '<div><button class="btn btn-success">AMAN</button></div>';
            }

            $commisioning = $date1->diffInDays($lisence->commisioning,false);
            if (empty($lisence->commisioning)) {
            $row[] = $lisence->commisioning;
            $row[] = '<div><button class="btn btn-dark">NA</button></div>';
            }elseif($lisence->commisioning == '1970-01-01'){
            $row[] = '';            
            $row[] = '<div><button class="btn btn-dark">NA</button></div>';
            }elseif($commisioning<=30){    
            $row[] = tanggal_indo($lisence->commisioning);
            $row[] = '<div><button class="btn btn-danger">URUS</button></div>';
            } else {
            $row[] = tanggal_indo($lisence->commisioning);
            $row[] =  '<div><button class="btn btn-success">AMAN</button></div>';
            }

            $fuel_issue = $date1->diffInDays($lisence->fuel_issue,false);
            if (empty($lisence->fuel_issue)) {
            $row[] = $lisence->fuel_issue;
            $row[] = '<div><button class="btn btn-dark">NA</button></div>';
            }elseif($lisence->fuel_issue == '1970-01-01'){
            $row[] = '';            
            $row[] = '<div><button class="btn btn-dark">NA</button></div>';
         
            }elseif($fuel_issue<=30){    
            $row[] = tanggal_indo($lisence->fuel_issue);
            $row[] = '<div><button class="btn btn-danger">URUS</button></div>';
            } else {
            $row[] = tanggal_indo($lisence->fuel_issue);
            $row[] =  '<div><button class="btn btn-success">AMAN</button></div>';
            }
                        
            $road_i = $date1->diffInDays($lisence->road_i,false);
            if (empty($lisence->road_i)) {
            $row[] = $lisence->road_i;
            $row[] = '<div><button class="btn btn-dark">NA</button></div>';
            }elseif($lisence->road_i == '1970-01-01'){
            $row[] = '';            
            $row[] = '<div><button class="btn btn-dark">NA</button></div>';
            }elseif($road_i<=30){
            $row[] = tanggal_indo($lisence->road_i);    
            $row[] = '<div><button class="btn btn-danger">URUS</button></div>';
            } else {
            $row[] = tanggal_indo($lisence->road_i);
            $row[] =  '<div><button class="btn btn-success">AMAN</button></div>';
            }


            $row[] = '<div>
                    <a onCLick="editForm('.$lisence->lisences_id.')" class="btn btn-info"><i class="fa fa-edit"></i></a>
                    
                    </div>';
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }
}
