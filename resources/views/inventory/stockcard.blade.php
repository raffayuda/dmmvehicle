<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Print Stock Card</title>
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
html { margin: 10px}
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
  border: 1px solid #000;
  font-size: 10px;
  padding: 8px;
}

#judul tr:nth-child(even){background-color: #f2f2f2;}

#judul tr:hover {background-color: #ddd;}

#judul th {
  padding-top: 12px;
  font-size: 10px;
  padding-bottom: 12px;
  text-align: center;
  border: 1px solid #000;
  background-color: #fff;
  color: black;
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
  font-size: 10px;
  padding: 8px;
}

#tabelstock tr:nth-child(even){background-color: #f2f2f2;}

#tabelstock tr:hover {background-color: #ddd;}

#tabelstock th {
  padding-top: 12px;
  font-size: 10px;
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
                {{-- @foreach ($datastock as $data) --}}
                    {{-- {{$data}} --}}
                    {{-- {{$grns}} --}}

                    <table class="table" style="text-align: left;  font-size: 12px;">
                        <tr>
                            <td colspan="2"><strong>BALANCE STOCK CARD</strong> </h4></td>
                        </tr>
                        <tr>
                            <td>Part Number</td>
                            <td>: {{$datastock->part_number }}  </td>
                        </tr>
                        <tr>
                            <td>Part Name</td>
                        <td>: {{$datastock->spareparts_name }}</td>
                        </tr>
                        <tr>
                            <td>Vehicle Model</td>
                            <td>: {{$datastock->vehiclemodels_name }} </td>
                        </tr>
                        <tr>
                            <td>Total Stock</td>
                            <td>: <b>{{$totalstock }} </b> </td>
                        </tr>
                    </table>
                    <table id="judul">
                      <tr>
                        <th>DATE</th>
                        <th>IN QTY</th>
                        <th>OUT QTY</th>
                        <th>SALDO</th>
                        <th>UOM</th>   
                      </tr>
                      @foreach ($grns as $grn)
                      <tr>
                          <td> {{$grn->gr_date}} </td>
                          <td> {{$grn->gr_qty}} </td>
                          <td>  {{$grn->gi_qty}} </td>
                          <td>  {{$grn->saldo}} </td>
                          <td> {{$grn->uom}} </td>
                      </tr>    
                      @endforeach
                      {{-- @foreach ($gins as $gin)
                      <tr>
                          <td> {{$gin->gins_date}} </td>
                          <td> </td>
                          <td> {{$gin->qty}}  </td>
                          <td> {{$gin->uom}} </td>
                      </tr>    
                      @endforeach --}}
                      {{-- @foreach ($datastock as $key => $val)
                     Key:{{$key}} Coutn: {{$val->count()}}
                          @foreach ($val as $item)
                          <tr>
                              <td>{{$item->spareparts_id}}</td>
                              <td>{{$item->grns_date}}</td>
                              </tr>
                          @endforeach --}}
                          {{-- Andi : {{$val}} --}}
                          {{-- @foreach ($key as $ke) --}}
                              
                          
                          {{-- @foreach ($val as $item)
                          <tr>
                              <td>{{$item->grns_date}}</td>
                              <td>{{$item->qty}}</td>
                              <td>{{$item->qty}}</td>
                              </tr>
                          @endforeach --}}
                          {{-- @endforeach --}}
                          {{-- echo : {{'qty'}} --}}
                          
                      {{-- @endforeach
                      {{dd('$datastock')}} --}}

                      {{-- {{dd('$datagrn')}} --}}
                        {{-- @foreach ($datagrn as $item) --}}
                        {{-- <tr> --}}
                          {{-- <td>{{$val=>grns_id}}</td> --}}
                          {{-- <td>{{$item->get('qty')}}</td>
                          <td>{{$item->get('qty')}}</td>
                          <td>{{$item->get('qty')}}</td>
                          <td>{{$item->get('uom')}}</td> --}}
                          {{-- </tr> --}}
                      {{-- @endforeach --}}
                      
                    </table>
                      <table id="judul">
                        <tr>
                          <th>Note</th>
                          <th>New Stock</th>
                        </tr>
                        @foreach ($adjusment as $item)
                            <tr>
                            <td>{{$item->note}}</td>
                            <td>{{$item->new_stock}}</td>
                            </tr>
                        @endforeach
                      </table>
                    {{-- <div class="row"> --}}
                           


                    
                </div>
                {{-- <div class="page-break"></div> --}}
                {{-- @endforeach --}}

        </div>
    </div>
</div>

{{-- @include('notifikasi.form') --}}


@section('script')





@endsection
