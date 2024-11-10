<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Print WO {{$id}} - {{$vehicle->nomor_lambung}}</title>
    <meta name="csrf-token" content=" {{csrf_token()}} ">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    {{-- <link rel="icon" type="image/ico" sizes="16x16" href="{{asset('public/favicon.ico')}}"> --}}
    <!-- Bootstrap 3.3.7 -->
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
    {{-- <link rel="stylesheet" href="{{asset('public/admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}"> --}}
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('public/admin/bower_components/font-awesome/css/font-awesome.min.css')}}">

    <!-- Theme style -->
    {{-- <link rel="stylesheet" href="{{asset('public/admin/dist/css/AdminLTE.min.css')}}"> --}}

    {{-- <link rel="shortcut icon" href="{{ asset('public/favicon.png') }}"> --}}
<style>

.page-break {
    page-break-after: always;
}

#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 0px solid #ddd;
  padding: 8px;
  width: 20px
}

#customers tr:nth-child(even){background-color: #fff;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}

#judul {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#judul td, #customers th {
  border: 1px solid #ddd;
  font-size: 9px;
  padding: 8px;
}

#judul tr:nth-child(even){background-color: #f2f2f2;}

#judul tr:hover {background-color: #ddd;}

#judul th {
  padding-top: 12px;
  font-size: 9px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #bbb;
  color: white;
}

.rotate7 .container {
    position: relative;
    overflow: visible;
  }
  .rotate7 .content:after {
    width: 150px; height: 150px;
    overflow: visible;
    content: "07-08";
    transform: rotate(-90deg);
    transform-origin: center center;
    position: absolute; left: -265px; top: -275px;
  }
  .rotate8 .container {
    position: relative;
    overflow: visible;
  }
  .rotate8 .content:after {
    width: 150px; height: 150px;
    overflow: visible;
    content: "08-09";
    transform: rotate(-90deg);
    transform-origin: center center;
    position: absolute; left: -265px; top: -275px;
  }

  #tabelstock {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#tabelstock td, #customers th {
  border: 1px solid #ddd;
  font-size: 9px;
  padding: 8px;
}

#tabelstock tr:nth-child(even){background-color: #f2f2f2;}

#tabelstock tr:hover {background-color: #ddd;}

#tabelstock th {
  padding-top: 12px;
  font-size: 9px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #bbb;
  color: white;
}

.rotate7 .container {
    position: relative;
    overflow: visible;
  }
  .rotate7 .content:after {
    width: 150px; height: 150px;
    overflow: visible;
    content: "07-08";
    transform: rotate(-90deg);
    transform-origin: center center;
    position: absolute; left: -265px; top: -275px;
  }
  .rotate8 .container {
    position: relative;
    overflow: visible;
  }
  .rotate8 .content:after {
    width: 150px; height: 150px;
    overflow: visible;
    content: "08-09";
    transform: rotate(-90deg);
    transform-origin: center center;
    position: absolute; left: -265px; top: -275px;
  }
</style>
</head>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">

            </div>
            <div class="box-body">
                <input type="hidden" id="id" name="id">
                <input type="hidden" id="created_by" name="created_by" value="{{Auth::user()->name}}">
{{-- {{dd($datagrn)}} --}}

{{-- {{$partByDate = $dataproduk;}}

@foreach ($partByDate as $date => $dataproduk) 
 <h2>{{$date}}</h2>
 <ul>
   @foreach ($dataproduk as $dataprodu) 
     echo "<li>".{{$dataprodu->qty_out}}."</li>";
   @endforeach
</ul>

@endforeach --}}
{{-- {{$datastock}} --}}
                {{-- <div class="row">
                    <div class="col-xs-12">
                        <img src="{{asset('public/images/logoprosma.png')}}" alt="">
                    </div>
                </div> --}}
                {{-- {{dd($datastock)}} --}}
                {{-- @foreach ($workorder as $data) --}}
                    {{-- {{$workorder->vehicles_id}} --}}
                    <h2>WORK ORDER</h2>
                    <table class="table" style="text-align: left;  font-size: 9px;">
                        <tr>
                            <td>Work Order Number</td>
                            <td>: {{$workorderparent->wo_alias}}</td>
                        </tr>
                        <tr>
                            <td>Schedule Date</td>
                            <td>: {{tanggal_indo($workorderparent->schedule_date)}}</td>
                        </tr>
                        <tr>
                            <td>Nomor Lambung</td>
                            <td>: {{$vehicle->nomor_lambung}}</td>
                        </tr>
                        <tr>
                            <td>Nomor Polisi</td>
                            <td>: {{$vehicle->nomor_polisi}}</td>
                        </tr>
                        <tr>
                            <td>ODO</td>
                            <td>: {{format_uang($workorderparent->odo)}} KM</td>
                        </tr>
                        <tr>
                            <td>Note</td>
                            <td>: {{$workorderparent->note}}</td>
                        </tr>
                        <tr>
                            <td>WO Created By</td>
                            <td>: {{$workorderparent->created_by}}</td>
                        </tr>
                        <tr>
                            <td>WO Printed By</td>
                            <td>: {{Auth::user()->name}}</td>
                        </tr>
                    </table>
                    <h4>Work Package</h4>
                    <table class="table" style="text-align: left;  font-size: 9px;" id="judul">
                        <tr>
                                    <th>No</th>
                                    <th>PACKAGE NAME</th>
                                    <th>PROBLEM</th>
                                    <th>REMARKS</th>

                                </tr>
                                
                                @foreach ($workorders as $workorder)
                                    <tr>
                                      <td>{{++$no}}</td>
                                      <td>{{$workorder->packages_name}}</td>
                                      <td>{{$workorder->problem}}</td>
                                      <td></td>
                                    </tr>
                                @endforeach
                                
                    </table>
                    <h4>Material and Part</h4>
                    {{-- {{$partpackages}} --}}
                    <table class="table" style="text-align: left;  font-size: 9px;" id="judul">
                        <tr>
                                    <th>No</th>
                                    <th>PART NUMBER</th>
                                    <th>PART NAME</th>
                                    <th>QTY</th>
                                    <th>UOM</th>
                                    <th>RREMARKS</th>
                                </tr>
                                @foreach ($partpackages as $partpackage)
                                    <tr>
                                      <td>{{++$noo}}</td>
                                      <td>{{$partpackage->part_number}} </td>
                                      <td>{{$partpackage->spareparts_name}} </td>
                                      <td>{{$partpackage->wo_qty}} </td>
                                      <td>{{$partpackage->uom}} </td>
                                      <td></td>
                                    </tr>
                                @endforeach
                                
                    </table>
                    <hr>
                    <table class="table" style="text-align: left;  font-size: 9px;" id="judul">
                      <tr>
                        <td style="text-align: center;">MECHANIC</td>
                        <td style="text-align: center;">LEADING HEAD</td>
                        <td style="text-align: center;">COORDINATOR</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td style="height:45px;"></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td style="text-align: center;">{{$workorderparent->mechanic}}</td>
                        <td style="text-align: center;">{{$workorderparent->leading_head}}</td>
                        <td style="text-align: center;">{{$workorderparent->coordinator}}</td>
                      </tr>
                    </table>
                    
<p style="page-break-after: always;"></p>

@foreach ($workorders as $workorder)
    @if ($workorder->packages_id == 1)
        
        @include('workorder.form'.$workorder->packages_id)

    @elseif($workorder->packages_id == 2)
        
        @include('workorder.form'.$workorder->packages_id)

    @elseif($workorder->packages_id == 3)
        @include('workorder.form'.$workorder->packages_id)
        
    @elseif($workorder->packages_id == 4)
        @include('workorder.form'.$workorder->packages_id)
        
    @elseif($workorder->packages_id == 5)
        @include('workorder.form'.$workorder->packages_id)
        
    @elseif($workorder->packages_id == 6)
        @include('workorder.form'.$workorder->packages_id)
        
    @elseif($workorder->packages_id == 7)
        @include('workorder.form'.$workorder->packages_id)
        
    @elseif($workorder->packages_id == 8)
        @include('workorder.form'.$workorder->packages_id)
        
    @elseif($workorder->packages_id == 9)
        @include('workorder.form'.$workorder->packages_id)
        
    @elseif($workorder->packages_id == 10)
        @include('workorder.form'.$workorder->packages_id)
        
    @elseif($workorder->packages_id == 11)
        @include('workorder.form'.$workorder->packages_id)
    @elseif($workorder->packages_id == 12)
        @include('workorder.form'.$workorder->packages_id)
        
    @elseif($workorder->packages_id == 13)
        @include('workorder.form'.$workorder->packages_id)
        
    @elseif($workorder->packages_id == 14)
        @include('workorder.form'.$workorder->packages_id)
        
    @elseif($workorder->packages_id == 15)
        @include('workorder.form'.$workorder->packages_id)
        
    @elseif($workorder->packages_id == 16)
        @include('workorder.form'.$workorder->packages_id)
        
    @endif
@endforeach
                    
                      
                    {{-- <div class="row"> --}}
                           


                    
                </div>
                {{-- <div class="page-break"></div> --}}
                {{-- @endforeach --}}

        </div>
    </div>
</div>



@section('script')




@endsection
