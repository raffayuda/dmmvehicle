<?php

namespace App\Http\Controllers;
use App\Employee;
use Carbon\Carbon;
use App\Skill;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employee.indexemployee');
    }
        public function store(Request $request)
    {
        $employee = new Employee;
        $employee->id_number=$request['id_number'];
        $employee->employees_name=$request['employees_name'];
        $employee->birth_date=$request['birth_date'];
        $employee->join_date=$request['join_date'];
        $employee->skills_id=$request['skills_id'];
        $employee->position=$request['position'];
        $employee->phone=$request['phone'];
        $employee->kimper=$request['kimper'];
        $employee->sim=$request['sim'];
        $employee->status=$request['status'];

        $employee->created_by=$request['created_by'];



        $employee->save();
    }
    public function edit($id)
    {
        $employee = Employee::find($id);
        echo json_encode($employee);
    }
    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        $employee->id_number=$request['id_number'];
        $employee->employees_name=$request['employees_name'];
        $employee->birth_date=$request['birth_date'];
        $employee->join_date=$request['join_date'];
        $employee->skills_id=$request['skills_id'];
        $employee->position=$request['position'];
        $employee->phone=$request['phone'];
        $employee->kimper=$request['kimper'];
        $employee->sim=$request['sim'];
        $employee->status=$request['status'];

        $employee->created_by=$request['created_by'];



        $employee->update();
    }
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
    }

    public function listemployee()
    {
        
        $employees = Employee::orderBy('created_at','desc')->get();
        $no = 0;
        $date1 = Carbon::today();
        $data = array();
        foreach($employees as $employee){
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $employee->id_number;
            $row[] = $employee->employees_name;
            if(!empty($employee->birth_date) ) {
            $row[] = tanggal_indo($employee->birth_date);

            } else{
            $row[] = '-';

            }
            if(!empty($employee->join_date) ) {
            $row[] = tanggal_indo($employee->join_date);

            } else{
            $row[] = '-';
            }
            $skills_name = Skill::find($employee->skills_id);
            $row[] = $skills_name->skills_name;
            $row[] = $employee->position;
            $row[] = $employee->phone;
            // $row[] = $employee->phone;
            // $row[] = $employee->phone;
            // $row[] = $employee->phone;
            if(!empty($employee->sim) ) {
            $row[] = tanggal_indo($employee->sim);

            } else{
            $row[] = '-';

            }


            $kimper = $date1->diffInDays($employee->kimper,false);

            if (empty($employee->kimper)) {
            $row[] = $employee->kimper;
            $row[] = '<div><button class="btn btn-dark">NA</button></div>';
            }elseif($employee->kimper == '1970-01-01'){
            $row[] = '';            
            $row[] = '<div><button class="btn btn-dark">NA</button></div>';
            }elseif($kimper<=30){    
            $row[] = tanggal_indo($employee->kimper);
            $row[] = '<div><button class="btn btn-danger">URUS</button></div>';
            } else {
            $row[] = tanggal_indo($employee->kimper);
            $row[] =  '<div><button class="btn btn-success">AMAN</button></div>';
            }

            $row[] = $employee->status;

            $row[] = '<div>
                    <a onCLick="editForm('.$employee->employees_id.')" class="btn btn-info"><i class="fa fa-edit"></i></a>
                    </div>';

                    // $row[] = '<div>
                    // <a onCLick="editForm('.$employee->employees_id.')" class="btn btn-info"><i class="fa fa-edit"></i></a>
                    // <a onClick="deleteData('.$employee->employees_id.')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    // </div>';
            $data[]=$row;
        }
        $output = array("data"=>$data);
        return response()->json($output);
    }
}
