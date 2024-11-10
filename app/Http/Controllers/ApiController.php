<?php

namespace App\Http\Controllers;
use App\Vehiclemodel;
use App\Manufacturer;
use App\Package;
use App\Sparepart;
use App\Customer;
use App\Supplier;
use DB;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function listVehicleModel()
    {
        
        $vehiclemodels = Vehiclemodel::orderBy('created_at','desc')->get();
        $no = 0;
        $data = array();
        foreach($vehiclemodels as $vehiclemodel){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $vehiclemodel->vehiclemodels_name;
            $row[] = '<div>
                    <a onCLick="editForm('.$vehiclemodel->vehiclemodels_id.')" class="btn btn-info"><i class="fa fa-edit"></i></a>
                    <a onClick="deleteData('.$vehiclemodel->vehiclemodels_id.')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </div>';
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }

    public function selectVehicleModel(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("vehiclemodels")
            		->select("vehiclemodels_id as id","vehiclemodels_name as text")
            		->where('text','LIKE',"%$search%")
            		->get();
        }
        else{
            $data = DB::table("vehiclemodels")
            		->select("vehiclemodels_id as id","vehiclemodels_name as text")
            		->get();
        }
        
        return response()->json($data);
        
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    public function listManufacturer()
    {
        
        $manufacturers = Manufacturer::orderBy('created_at','desc')->get();
        $no = 0;
        $data = array();
        foreach($manufacturers as $manufacturer){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $manufacturer->manufacturers_name;
            $row[] = $manufacturer->manufacturers_address;
            $row[] = $manufacturer->contact_person;
            $row[] = $manufacturer->phone;
            $row[] = $manufacturer->email;
            $row[] = '<div>
                    <a onCLick="editForm('.$manufacturer->manufacturers_id.')" class="btn btn-info"><i class="fa fa-edit"></i></a>
                    <a onClick="deleteData('.$manufacturer->manufacturers_id.')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </div>';
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }
    public function selectManufacturer(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("manufacturers")
            		->select("manufacturers_id as id","manufacturers_name as text")
            		->where('text','LIKE',"%$search%")
            		->get();
        }
        else{
            $data = DB::table("manufacturers")
            		->select("manufacturers_id as id","manufacturers_name as text")
            		->get();
        }
        
        return response()->json($data);
        
    }


    ////////////////////////////////////////////////////////////
    public function listPackage()
    {
        
        // $packages = Package::orderBy('created_at','desc')->get();
        $packages = DB::table('packages')
            ->leftjoin('vehiclemodels', 'vehiclemodels.vehiclemodels_id', '=', 'packages.vehiclemodels_id')
            ->leftjoin('types', 'types.types_id', '=', 'packages.maintenance_type')
            ->get();
        $no = 0;
        $data = array();
        foreach($packages as $package){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $package->packages_name;
            $row[] = $package->vehiclemodels_name;
            $row[] = $package->types_name;
            $row[] = $package->km;
            $row[] = $package->day;
            if (!empty($package->next_packages_id)) {
                $next=DB::table('packages')
            ->where('packages_id','=',$package->next_packages_id)
            ->first();
            $row[] = $next->packages_name;
            }else{
            $row[] = "-";    
            }

            

            $row[] = '<div>
                    <a onCLick="editForm('.$package->packages_id.')" class="btn btn-info"><i class="fa fa-edit"></i></a>
                    <a onClick="deleteData('.$package->packages_id.')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </div>';
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }

    public function selectPackage(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("packages")
            		->select("packages_id as id","packages_name as text")
            		->where('text','LIKE',"%$search%")
            		->get();
        }
        else{
            $data = DB::table("packages")
            		->select("packages_id as id","packages_name as text")
            		->get();
        }
        
        return response()->json($data);
        
    }

    public function selectPackageType(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("types")
            		->select("types_id as id","types_name as text")
            		->where('text','LIKE',"%$search%")
            		->get();
        }
        else{
            $data = DB::table("types")
            		->select("types_id as id","types_name as text")
            		->get();
        }
        
        return response()->json($data);
        
    }

    ////////////////////////////////////////////////////
    public function listCustomer()
    {
        
        $customers = Customer::orderBy('created_at','desc')->get();
        // $packages = DB::table('packages')
        //     ->leftjoin('vehiclemodels', 'vehiclemodels.vehiclemodels_id', '=', 'packages.vehiclemodels_id')
        //     ->leftjoin('types', 'types.types_id', '=', 'packages.maintenance_type')
        //     ->get();
        $no = 0;
        $data = array();
        foreach($customers as $customer){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $customer->customers_name;
            $row[] = $customer->address;
            $row[] = $customer->contact_person;
            $row[] = $customer->phone;
            $row[] = $customer->email;
            $row[] = $customer->contract_number;
            $row[] = $customer->valid_until;
            $row[] = $customer->department;
            
            $row[] = '<div>
                    <a onCLick="editForm('.$customer->customers_id.')" class="btn btn-info"><i class="fa fa-edit"></i></a>
                    <a onClick="deleteData('.$customer->customers_id.')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </div>';
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }


    public function selectSparepartType(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("parttypes")
            		->select("parttypes_id as id","parttypes_name as text")
            		->where('text','LIKE',"%$search%")
            		->get();
        }
        else{
            $data = DB::table("parttypes")
            		->select("parttypes_id as id","parttypes_name as text")
            		->get();
        }
        
        return response()->json($data);
        
    }

    public function selectstatuspart(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("partstatuses")
            		->select("partstatuses_id as id","partstatuses_name as text")
            		->where('text','LIKE',"%$search%")
            		->get();
        }
        else{
            $data = DB::table("partstatuses")
            		->select("partstatuses_id as id","partstatuses_name as text")
            		->get();
        }
        
        return response()->json($data);
        
    }

    public function selectVehicle(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("vehicles")
            		->select("vehicles_id as id","nomor_lambung as text")
            		->where('text','LIKE',"%$search%")
            		->get();
        }
        else{
            $data = DB::table("vehicles")
            		->select("vehicles_id as id","nomor_lambung as text")
            		->get();
        }
        
        return response()->json($data);
        
    }

    public function selectDriver(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("employees")
                    ->select("employees_id as id","employees_name as text")
                    ->whereNotNull('kimper')
            		->where('text','LIKE',"%$search%")
            		->get();
        }
        else{
            $data = DB::table("employees")
                    ->select("employees_id as id","employees_name as text")
                    ->whereNotNull('kimper')
            		->get();
        }
        
        return response()->json($data);
        
    }

    public function selectEmployee(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("employees")
                    ->select("employees_id as id","employees_name as text")
            		->where('text','LIKE',"%$search%")
            		->get();
        }
        else{
            $data = DB::table("employees")
                    ->select("employees_id as id","employees_name as text")
            		->get();
        }
        
        return response()->json($data);
        
    }

    public function selectMechanic(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("employees")
                    ->select("employees_id as id","employees_name as text")
                    ->whereIn('skills_id',[7,9])
            		->where('text','LIKE',"%$search%")
            		->get();
        }
        else{
            $data = DB::table("employees")
                    ->select("employees_id as id","employees_name as text")
                    ->whereIn('skills_id',[7,9])
            		->get();
        }
        
        return response()->json($data);
        
    }

    public function selectLeadinghead(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("employees")
                    ->select("employees_id as id","employees_name as text")
                    ->where('skills_id','=',9)
            		->where('text','LIKE',"%$search%")
            		->get();
        }
        else{
            $data = DB::table("employees")
                    ->select("employees_id as id","employees_name as text")
                    ->where('skills_id','=',9)
            		->get();
        }
        
        return response()->json($data);
        
    }

    public function selectKoordinator(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("employees")
                    ->select("employees_id as id","employees_name as text")
                    ->where('skills_id','=',8)
            		->where('text','LIKE',"%$search%")
            		->get();
        }
        else{
            $data = DB::table("employees")
                    ->select("employees_id as id","employees_name as text")
                    ->where('skills_id','=',8)
            		->get();
        }
        
        return response()->json($data);
        
    }


    public function selectEquipement(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("equipements")
                    ->select("equipements_id as id","equipements_name as text")
            		->where('text','LIKE',"%$search%")
            		->get();
        }
        else{
            $data = DB::table("equipements")
                    ->select("equipements_id as id","equipements_name as text")
            		->get();
        }
        
        return response()->json($data);
        
    }

    public function selectCondition(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("conditions")
                    ->select("conditions_id as id","conditions_name as text")
            		->where('text','LIKE',"%$search%")
            		->get();
        }
        else{
            $data = DB::table("conditions")
                    ->select("conditions_id as id","conditions_name as text")
            		->get();
        }
        
        return response()->json($data);
        
    }

    public function selectSkill(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("skills")
                    ->select("skills_id as id","skills_name as text")
            		->where('text','LIKE',"%$search%")
            		->get();
        }
        else{
            $data = DB::table("skills")
                    ->select("skills_id as id","skills_name as text")
            		->get();
        }
        
        return response()->json($data);
        
    }

    public function selectSparepart(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("spareparts")
                    ->select("spareparts_id as id","part_number as text")
                    ->where("status",'=',1)
            		->where('text','LIKE',"%$search%")
            		->get();
        }
        else{
            $data = DB::table("spareparts")
                    ->select("spareparts_id as id","part_number as text")
                    ->where("status",'=',1)
            		->get();
        }
        
        return response()->json($data);
        
    }

    public function selectDoctype(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("doctypes")
                    ->select("doctypes_id as id","doctypes_name as text")
            		->where('text','LIKE',"%$search%")
            		->get();
        }
        else{
            $data = DB::table("doctypes")
                    ->select("doctypes_id as id","doctypes_name as text")
            		->get();
        }
        
        return response()->json($data);
        
    }

    public function selectSupplier(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("suppliers")
            		->select("suppliers_id as id","suppliers_name as text")
            		->where('text','LIKE',"%$search%")
            		->get();
        }
        else{
            $data = DB::table("suppliers")
            		->select("suppliers_id as id","suppliers_name as text")
            		->get();
        }
        
        return response()->json($data);
        
    }

    public function selectpo(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("requisitions")
            		->select("po_number as id","po_alias as text")
            		->where('text','LIKE',"%$search%")
            		->get();
        }
        else{
            $data = DB::table("requisitions")
            		->select("po_number as id","po_alias as text")
            		->get();
        }
        
        return response()->json($data);
        
    }


}
