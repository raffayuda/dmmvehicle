<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Coba;
class CobaController extends Controller
{
    public function index()
    {
        return view('coba.indexcoba');
    }
        public function store(Request $request)
    {
        // return($request);
        $coba = new Coba;
        $coba->coba=$request['coba'];
        $coba->save();

        // $stock = DB::table('spareparts')->where('spareparts_id','=',$request['spareparts_id']);
        // $stock->increment('stock', $request['qty']);
        

        // ->where('spareparts_id','=',$request['spareparts_id'])
        

    }
    public function edit($id)
    {
        $coba = Coba::find($id);
        echo json_encode($coba);
    }
    public function update(Request $request, $id)
    {
        $coba = Coba::find($id);
        $coba->coba=$request['coba'];
        $coba->update();
    }
    public function destroy($id)
    {
        $coba = Coba::find($id);
        $coba->delete();
    }

    public function listcoba()
    {
        $cobas = Coba::orderBy('created_at','desc')->get();
        // $cobas = DB::table('cobas')
        //     ->leftjoin('spareparts', 'spareparts.spareparts_id', '=', 'cobas.spareparts_id')
        //     ->leftjoin('manufacturers', 'manufacturers.manufacturers_id', '=', 'cobas.manufacture')
        //     ->leftjoin('doctypes', 'doctypes.doctypes_id', '=', 'cobas.document')
        //     ->where('cobas.document_number','!=','INIT001')
        //     ->get();
        //     // return($cobas);
        $no = 0;
        $data = array();
        foreach($cobas as $coba){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $coba->coba;
            

            $row[] = '<div>
                    <a onCLick="editForm('.$coba->id.')" class="btn btn-info"><i class="fa fa-edit"></i></a>
                    <a onClick="deleteData('.$coba->id.')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </div>';
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }
}
