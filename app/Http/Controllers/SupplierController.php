<?php

namespace App\Http\Controllers;
use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        return view('supplier.indexsupplier');
    }
        public function store(Request $request)
    {
        $supplier = new Supplier;
        $supplier->suppliers_name=$request['suppliers_name'];
        $supplier->address=$request['address'];
        $supplier->owner=$request['owner'];
        $supplier->bank_account=$request['bank_account'];
        $supplier->contact_person=$request['contact_person'];
        $supplier->phone=$request['phone'];
        $supplier->fax=$request['fax'];
        $supplier->email=$request['email'];
        $supplier->vendor_of=$request['vendor_of'];
        $supplier->created_by=$request['created_by'];
        $supplier->save();
    }
    public function edit($id)
    {
        $supplier = Supplier::find($id);
        echo json_encode($supplier);
    }
    public function update(Request $request, $id)
    {
        $supplier = Supplier::find($id);
        $supplier->suppliers_name=$request['suppliers_name'];
        $supplier->address=$request['address'];
        $supplier->owner=$request['owner'];
        $supplier->bank_account=$request['bank_account'];
        $supplier->contact_person=$request['contact_person'];
        $supplier->phone=$request['phone'];
        $supplier->fax=$request['fax'];
        $supplier->email=$request['email'];
        $supplier->vendor_of=$request['vendor_of'];
        $supplier->created_by=$request['created_by'];
        $supplier->update();
    }
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
    }

    public function listsupplier()
    {
        
        $suppliers = Supplier::orderBy('created_at','desc')->get();
        $no = 0;
        $data = array();
        foreach($suppliers as $supplier){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $supplier->suppliers_name;
            $row[] = $supplier->address;
            $row[] = $supplier->owner;
            $row[] = $supplier->bank_account;
            $row[] = $supplier->contact_person;
            $row[] = $supplier->phone;
            $row[] = $supplier->fax;
            $row[] = $supplier->email;
            $row[] = $supplier->vendor_of;

            $row[] = '<div>
                    <a onCLick="editForm('.$supplier->suppliers_id.')" class="btn btn-info"><i class="fa fa-edit"></i></a>
                    <a onClick="deleteData('.$supplier->suppliers_id.')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </div>';
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }
}
