<?php

namespace App\Http\Controllers;
use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customer.indexcustomer');
    }
        public function store(Request $request)
    {
        $customer = new Customer;
        $customer->created_by=$request['created_by'];
        $customer->customers_name=$request['customers_name'];
        $customer->address=$request['address'];
        $customer->contact_person=$request['contact_person'];
        $customer->phone=$request['phone'];
        $customer->email=$request['email'];
        $customer->contract_number=$request['contract_number'];
        $customer->valid_until=$request['valid_until'];
        $customer->department=$request['department'];

        $customer->save();
    }
    public function edit($id)
    {
        $customer = Customer::find($id);
        echo json_encode($customer);
    }
    public function update(Request $request, $id)
    {
        // return ($request);
        $customer = Customer::find($id);
        $customer->created_by=$request['created_by'];
        $customer->customers_name=$request['customers_name'];
        $customer->address=$request['address'];
        $customer->contact_person=$request['contact_person'];
        $customer->phone=$request['phone'];
        $customer->email=$request['email'];
        $customer->contract_number=$request['contract_number'];
        $customer->valid_until=$request['valid_until'];
        $customer->department=$request['department'];
        $customer->update();
    }
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
    }
}
