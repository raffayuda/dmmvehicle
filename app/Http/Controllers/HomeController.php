<?php

namespace App\Http\Controllers;
// use App\Vehicle;
use App\Inventory;
use Carbon\Carbon;
use App\Package;
use App\Vehicle;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $date1 = Carbon::now();
        $date2 = new Carbon('first day of January');
        $date3 = new Carbon('last day of december');
        $hari_ini = $date1->diffInDays($date2);
        $setahun = $date2->diffInDays($date3) +1;
//Katergori Severe :
        // Kuning 1 hari
        // Orange 1 minggu
        // Merah 2 minggu
        // $today = Carbon::now()->toDateString();
        $today = Carbon::now()->add(+1,'day')->toDateString();
        $kuning = Carbon::now()->add(-2,'day')->toDateString();
        $orange = Carbon::now()->add(-7,'day')->toDateString();
        $merah = Carbon::now()->add(-14,'day')->toDateString();
        // return($kuning);
        // $year = Carbon::now()->toYearString();
        $year = Carbon::createFromFormat('Y-m-d', $today)->format('Y');
        // return view('dashboard.indexdashboard');
        // $vehicle = Vehicle::count();
        // $inoperation = Vehicle::where('status','=','active')-> count();
        // $maintenance = Vehicle::where('status','=','due')-> count();
        // $breakdown = Vehicle::where('status','=','progress')-> count();
        // $yellow = Vehicle::where('status','=','breakdown')-> count(); //dalam 24 jam
        // $orange = Vehicle::where('status','=','breakdown')-> count(); // 24 jam s/d 7 hari
        // $red = Vehicle::where('status','=','breakdown')-> count(); //lebih dari 7 hari

    $vehicle = DB::table('vehicles')
    // ->where('status', '=', 'In Progress')
    // ->where('stock','<','min_stock')
    ->count();
    // 99;

    $yellowmain = DB::table('maintenances')
    // ->where('status', '=', 'Open')
    ->wherein('status', ['In Progress'])

    ->where('packages_id','!=',16)
    ->where('due_date', '<=', $today)
    ->where('due_date', '>', $orange)
    ->count();

    $orangemain = DB::table('maintenances')
    // ->where('status', '=', 'Open')
    ->wherein('status', ['In Progress'])

    ->where('packages_id','!=',16)
    ->where('due_date', '<=', $orange)
    ->where('due_date', '>', $merah)
    ->count();

    $redmain =DB::table('maintenances')
    ->wherein('status', ['In Progress'])
    // ->orWhere('status', '=', 'Scheduled')
    ->where('packages_id','!=',16)
    ->where('due_date', '<=', $merah)
    ->count();
// return($redmain);

    // return($yellowmain);
    $maintenance = DB::table('workorders')
    ->where('status', '=', 'In Progress')
    // ->where('stock','<','min_stock')
    ->count();
    // $maintenance = 4;
    
    $yellow = DB::table('maintenances')
    // ->where('status', '=', 'Open')
    ->wherein('status', ['Open','Scheduled','In Progress'])

    ->where('packages_id','=',16)
    ->where('due_date', '<=', $today)
    ->where('due_date', '>', $orange)
    ->count();
    $yellowget = DB::table('maintenances')
    // ->where('status', '=', 'Open')
    ->wherein('status', ['Open','Scheduled','In Progress'])
    ->where('packages_id','=',16)
    ->where('due_date', '<=', $today)
    ->where('due_date', '>', $orange)
    ->get();
    // return($yellow);
    $orange = DB::table('maintenances')
    // ->where('status', '=', 'Open')
    ->wherein('status', ['Open','Scheduled','In Progress'])

    ->where('packages_id','=',16)
    ->where('due_date', '<=', $orange)
    ->where('due_date', '>', $merah)
    ->count();
    $red =DB::table('maintenances')
    ->wherein('status', ['Open','Scheduled','In Progress'])
    // ->orWhere('status', '=', 'Scheduled')
    ->where('packages_id','=',16)
    ->where('due_date', '<=', $merah)
    ->count();
    $breakdown = $yellow + $orange + $red;
    $inporgress = DB::table('maintenances')
    ->where('status', '=','In Progress')
    ->where('packages_id','!=',16)
    
    // ->where('stock','<','min_stock')
    ->count();
    $inoperation = $vehicle - $inporgress - $breakdown;
    
    $alert = DB::table('spareparts')
    // ->leftJoin('grns','grns.spareparts_id','=','spareparts.spareparts_id')
    ->where('stock', '<', DB::raw('min_stock'))
    
    // ->where('stock','<','min_stock')
    ->count();

    $no=1;
    $maintenances = DB::table('maintenances')
            ->leftjoin('packages', 'packages.packages_id', '=', 'maintenances.packages_id')
            ->leftjoin('vehicles', 'vehicles.vehicles_id', '=', 'maintenances.vehicles_id')
            ->where('status','!=','Open')
            ->where('status','!=','Close')
            ->where('status','!=','Done')
            ->where('status','!=','Cancel')
            ->where('status','!=','Hide')
            
            ->where('status','!=','')
            ->where('due_date', '<=', $today)

            // ->where(Carbon::parse('due_date')->format('Y-m-d'),'=',$date1)
            ->get();
    

    $noo=1;
    $breakdowns = DB::table('maintenances')
            ->leftjoin('packages', 'packages.packages_id', '=', 'maintenances.packages_id')
            ->leftjoin('vehicles', 'vehicles.vehicles_id', '=', 'maintenances.vehicles_id')
            // ->where('status','=','Open')
            ->wherein('status', ['Open','Scheduled','In Progress'])

            ->where('maintenances.packages_id','=',16)
            // ->where(Carbon::parse('due_date')->format('Y-m-d'),'=',$date1)
            ->get();

        return view('dashboard.indexdashboard',compact('inporgress','no','noo','breakdowns','maintenances','date1','vehicle','inoperation','maintenance','breakdown','yellow','orange','red','yellowmain','orangemain','redmain','alert'));
        // return view('dashboard.indexdashboard');    
        //Katergori Severe :
        // Kuning 1 hari
        // Orange 1 minggu
        // Merah 2 minggu
    }
    public function listmaintenancedue()
    {
    // $date1 = Carbon::today();
    $date1 = Carbon::today();

    // $izin_lapor = $date1->diffInDays($lisence->izin_lapor,false);
    
    $maintenances = DB::table('maintenances')
            // ->where(Carbon::parse('due_date')->format('Y-m-d'),'=',$date1)
            ->get();
            // return($lisences);
        $no = 0;
        $data = array();
        foreach($maintenances as $maintenance){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $maintenance->vehicles_id;
            $row[] = '<div>
                    <a onCLick="editForm('.$maintenance->maintenances_id.')" class="btn btn-info"><i class="fa fa-edit"></i></a>
                    
                    </div>';
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }
    public function listalert()
    {
        $alerts = DB::table('spareparts')
        ->where('stock', '<', DB::raw('min_stock'))
        // ->where('stock','<','min_stock')
        ->get();

        // $alerts = Vehiclemodel::orderBy('created_at','desc')->get();
        $no = 0;
        $data = array();
        foreach($alerts as $alert){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $alert->spareparts_name;
            $row[] = $alert->part_number;
            $row[] = $alert->stock;
            $row[] = $alert->min_stock;
            
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }

    public function listyellow()
    {
        // $alerts = DB::table('spareparts')
        // ->where('stock', '<', DB::raw('min_stock'))
        // // ->where('stock','<','min_stock')
        // ->get();
        $date1 = Carbon::now();
        $date2 = new Carbon('first day of January');
        $date3 = new Carbon('last day of december');
        $hari_ini = $date1->diffInDays($date2);
        $setahun = $date2->diffInDays($date3) +1;
//Katergori Severe :
        // Kuning 1 hari
        // Orange 1 minggu
        // Merah 2 minggu
        // $today = Carbon::now()->toDateString();
        $today = Carbon::now()->add(+1,'day')->toDateString();
        $kuning = Carbon::now()->add(-2,'day')->toDateString();
        $orange = Carbon::now()->add(-7,'day')->toDateString();
        $merah = Carbon::now()->add(-14,'day')->toDateString();
        // return($kuning);
        // $year = Carbon::now()->toYearString();
        $year = Carbon::createFromFormat('Y-m-d', $today)->format('Y');

        $yellow = DB::table('maintenances')
            ->wherein('status', ['Open','Scheduled','In Progress'])
            ->where('packages_id','=',16)
            ->where('due_date', '<=', $today)
            ->where('due_date', '>', $orange)
            ->get();

        // $alerts = Vehiclemodel::orderBy('created_at','desc')->get();
        $no = 0;
        $data = array();
        foreach($yellow as $alert){
            $no++;
            $row=array();
            $row[] = $no;
            $package = Package::find($alert->packages_id);
            $row[] = $package->packages_name;
            $vehicle = Vehicle::find($alert->vehicles_id);
            $row[] = $vehicle->nomor_lambung;
            $row[] = $alert->problem;
            $row[] = $alert->status;
            $row[] = $alert->due_date;
            
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }

    public function listyellowmain()
    {
        // $alerts = DB::table('spareparts')
        // ->where('stock', '<', DB::raw('min_stock'))
        // // ->where('stock','<','min_stock')
        // ->get();
        $date1 = Carbon::now();
        $date2 = new Carbon('first day of January');
        $date3 = new Carbon('last day of december');
        $hari_ini = $date1->diffInDays($date2);
        $setahun = $date2->diffInDays($date3) +1;
//Katergori Severe :
        // Kuning 1 hari
        // Orange 1 minggu
        // Merah 2 minggu
        // $today = Carbon::now()->toDateString();
        $today = Carbon::now()->add(+1,'day')->toDateString();
        $kuning = Carbon::now()->add(-2,'day')->toDateString();
        $orange = Carbon::now()->add(-7,'day')->toDateString();
        $merah = Carbon::now()->add(-14,'day')->toDateString();
        // return($kuning);
        // $year = Carbon::now()->toYearString();
        $year = Carbon::createFromFormat('Y-m-d', $today)->format('Y');

        $yellow = DB::table('maintenances')
            ->wherein('status', ['In Progress'])
            ->where('packages_id','!=',16)
            ->where('due_date', '<=', $today)
            ->where('due_date', '>', $orange)
            ->get();

        // $alerts = Vehiclemodel::orderBy('created_at','desc')->get();
        $no = 0;
        $data = array();
        foreach($yellow as $alert){
            $no++;
            $row=array();
            $row[] = $no;
            $package = Package::find($alert->packages_id);
            $row[] = $package->packages_name;
            $vehicle = Vehicle::find($alert->vehicles_id);
            $row[] = $vehicle->nomor_lambung;
            $row[] = $alert->problem;
            $row[] = $alert->status;
            $row[] = $alert->due_date;
            
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }

    public function listorange()
    {
        
        $date1 = Carbon::now();
        $date2 = new Carbon('first day of January');
        $date3 = new Carbon('last day of december');
        $hari_ini = $date1->diffInDays($date2);
        $setahun = $date2->diffInDays($date3) +1;
//Katergori Severe :
        // Kuning 1 hari
        // Orange 1 minggu
        // Merah 2 minggu
        $today = Carbon::now()->toDateString();
        $kuning = Carbon::now()->add(-2,'day')->toDateString();
        $orange = Carbon::now()->add(-7,'day')->toDateString();
        $merah = Carbon::now()->add(-14,'day')->toDateString();
        // return($kuning);
        // $year = Carbon::now()->toYearString();
        $year = Carbon::createFromFormat('Y-m-d', $today)->format('Y');
        $orange = DB::table('maintenances')
    // ->where('status', '=', 'Open')
            ->wherein('status', ['Open','Scheduled','In Progress'])

            ->where('packages_id','=',16)
            ->where('due_date', '<=', $orange)
            ->where('due_date', '>', $merah)
            ->get();

        // $alerts = Vehiclemodel::orderBy('created_at','desc')->get();
        $no = 0;
        $data = array();
        foreach($orange as $alert){
            $no++;
            $row=array();
            $row[] = $no;
            $package = Package::find($alert->packages_id);
            $row[] = $package->packages_name;
            $vehicle = Vehicle::find($alert->vehicles_id);
            $row[] = $vehicle->nomor_lambung;
            $row[] = $alert->problem;
            $row[] = $alert->status;
            $row[] = $alert->due_date;
            
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }

    public function listorangemain()
    {
        
        $date1 = Carbon::now();
        $date2 = new Carbon('first day of January');
        $date3 = new Carbon('last day of december');
        $hari_ini = $date1->diffInDays($date2);
        $setahun = $date2->diffInDays($date3) +1;
//Katergori Severe :
        // Kuning 1 hari
        // Orange 1 minggu
        // Merah 2 minggu
        $today = Carbon::now()->toDateString();
        $kuning = Carbon::now()->add(-2,'day')->toDateString();
        $orange = Carbon::now()->add(-7,'day')->toDateString();
        $merah = Carbon::now()->add(-14,'day')->toDateString();
        // return($kuning);
        // $year = Carbon::now()->toYearString();
        $year = Carbon::createFromFormat('Y-m-d', $today)->format('Y');
        $orange = DB::table('maintenances')
    // ->where('status', '=', 'Open')
            ->wherein('status', ['In Progress'])

            ->where('packages_id','!=',16)
            ->where('due_date', '<=', $orange)
            ->where('due_date', '>', $merah)
            ->get();

        // $alerts = Vehiclemodel::orderBy('created_at','desc')->get();
        $no = 0;
        $data = array();
        foreach($orange as $alert){
            $no++;
            $row=array();
            $row[] = $no;
            $package = Package::find($alert->packages_id);
            $row[] = $package->packages_name;
            $vehicle = Vehicle::find($alert->vehicles_id);
            $row[] = $vehicle->nomor_lambung;
            $row[] = $alert->problem;
            $row[] = $alert->status;
            $row[] = $alert->due_date;
            
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }

    public function listred()
    {
        // $alerts = DB::table('spareparts')
        // ->where('stock', '<', DB::raw('min_stock'))
        // // ->where('stock','<','min_stock')
        // ->get();
        $date1 = Carbon::now();
        $date2 = new Carbon('first day of January');
        $date3 = new Carbon('last day of december');
        $hari_ini = $date1->diffInDays($date2);
        $setahun = $date2->diffInDays($date3) +1;
//Katergori Severe :
        // Kuning 1 hari
        // Orange 1 minggu
        // Merah 2 minggu
        $today = Carbon::now()->toDateString();
        $kuning = Carbon::now()->add(-2,'day')->toDateString();
        $orange = Carbon::now()->add(-7,'day')->toDateString();
        $merah = Carbon::now()->add(-14,'day')->toDateString();
        // return($kuning);
        // $year = Carbon::now()->toYearString();
        $year = Carbon::createFromFormat('Y-m-d', $today)->format('Y');

    //     $yellow = DB::table('maintenances')
    // // ->where('status', '=', 'Open')
    //         ->wherein('status', ['Open','Scheduled','In Progress'])
    //         ->where('packages_id','=',16)
    //         ->where('due_date', '<=', $today)
    //         ->where('due_date', '>', $orange)
    //         ->get();
        $red =DB::table('maintenances')
    ->wherein('status', ['Open','Scheduled','In Progress'])
    // ->orWhere('status', '=', 'Scheduled')
    ->where('packages_id','=',16)
    ->where('due_date', '<=', $merah)
    ->get();

        // $alerts = Vehiclemodel::orderBy('created_at','desc')->get();
        $no = 0;
        $data = array();
        foreach($red as $alert){
            $no++;
            $row=array();
            $row[] = $no;
            $package = Package::find($alert->packages_id);
            $row[] = $package->packages_name;
            $vehicle = Vehicle::find($alert->vehicles_id);
            $row[] = $vehicle->nomor_lambung;
            $row[] = $alert->problem;
            $row[] = $alert->status;
            $row[] = $alert->due_date;
            
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }

    public function listredmain()
    {
        // $alerts = DB::table('spareparts')
        // ->where('stock', '<', DB::raw('min_stock'))
        // // ->where('stock','<','min_stock')
        // ->get();
        $date1 = Carbon::now();
        $date2 = new Carbon('first day of January');
        $date3 = new Carbon('last day of december');
        $hari_ini = $date1->diffInDays($date2);
        $setahun = $date2->diffInDays($date3) +1;
//Katergori Severe :
        // Kuning 1 hari
        // Orange 1 minggu
        // Merah 2 minggu
        $today = Carbon::now()->toDateString();
        $kuning = Carbon::now()->add(-2,'day')->toDateString();
        $orange = Carbon::now()->add(-7,'day')->toDateString();
        $merah = Carbon::now()->add(-14,'day')->toDateString();
        // return($kuning);
        // $year = Carbon::now()->toYearString();
        $year = Carbon::createFromFormat('Y-m-d', $today)->format('Y');

    //     $yellow = DB::table('maintenances')
    // // ->where('status', '=', 'Open')
    //         ->wherein('status', ['Open','Scheduled','In Progress'])
    //         ->where('packages_id','=',16)
    //         ->where('due_date', '<=', $today)
    //         ->where('due_date', '>', $orange)
    //         ->get();
        $red =DB::table('maintenances')
    ->wherein('status', ['In Progress'])
    // ->orWhere('status', '=', 'Scheduled')
    ->where('packages_id','!=',16)
    ->where('due_date', '<=', $merah)
    ->get();

        // $alerts = Vehiclemodel::orderBy('created_at','desc')->get();
        $no = 0;
        $data = array();
        foreach($red as $alert){
            $no++;
            $row=array();
            $row[] = $no;
            $package = Package::find($alert->packages_id);
            $row[] = $package->packages_name;
            $vehicle = Vehicle::find($alert->vehicles_id);
            $row[] = $vehicle->nomor_lambung;
            $row[] = $alert->problem;
            $row[] = $alert->status;
            $row[] = $alert->due_date;
            
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }

}
