<?php

namespace App\Http\Controllers;
use App\Kategori;
use App\Vehicle;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        return view('kategori.indexkategori');
    }
        public function store(Request $request)
    {
        $kategori = new Kategori;
        $kategori->kategori_name = $request['kategori_name'];
        $kategori->save();
        // dd('store');
        // return($request);
        // $no = 3;
        // foreach($request->hobby as $hobby){
        //     $kategori = new Kategori;
        //     // $kategori->kategori_name = $request['kategori_name'];
        //     // $kategori->created_by = $request['created_by'];
        //     $kategori->kategori_name = $request['cekcek_name'];
        //     $kategori->hobby = $hobby;
        //     $kategori->created_by = $request['created_by'];
        //     $kategori->save();

            // $vehicle = Vehicle::find($no++);
            // $vehicle->status = 'progress';
            // $vehicle->update();
        // }
        
    }
    public function edit($id)
    {
        $kategori = Kategori::find($id);
        echo json_encode($kategori);
    }
    public function update(Request $request, $id)
    {
        // return ($request);
        $kategori = Kategori::find($id);
        $kategori->kategori_name = $request['kategori_name']; 
        $kategori->created_by = $request['created_by'];
        $kategori->update();
    }
    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();
    }
    public function listKategori()
    {
        $kategories = Kategori::orderBy('kategori_id','desc')->get();
        $no = 0;
        $data = array();
        foreach($kategories as $kategori){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $kategori->kategori_name;
            // $row[] = '<a href="" data-toggle="modal" data-target="#employeeModal'.$employee->id.'" data-whatever="@mdo">'.$employee->employee_name.'</a>';
            $row[] = '<div>
                    <a onCLick="editForm('.$kategori->kategori_id.')" class="btn btn-info"><i class="fa fa-edit"></i></a>
                    <a onClick="deleteData('.$kategori->kategori_id.')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </div>';
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }
}
