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
  font-size: 10px;
  padding: 8px;
}

#judul tr:nth-child(even){background-color: #f2f2f2;}

#judul tr:hover {background-color: #ddd;}

#judul th {
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
                {{-- @foreach ($workorder as $data) --}}
                    {{-- {{$workorder->vehicles_id}} --}}
                    <h2>WORK ORDER</h2>
                    <table class="table" style="text-align: left;  font-size: 12px;">
                        <tr>
                            <td>Work Order Number</td>
                            <td>: {{$workorder->workorders_id}}</td>
                        </tr>
                        <tr>
                            <td>Schedule Date</td>
                            <td>: {{tanggal_indo($workorder->shceduled_date)}}</td>
                        </tr>
                        <tr>
                            <td>Nomor Lambung</td>
                            <td>: {{$workorder->nomor_lambung}}</td>
                        </tr>
                        <tr>
                            <td>Nomor Polisi</td>
                            <td>: {{$workorder->nomor_polisi}}</td>
                        </tr>
                        <tr>
                            <td>ODO</td>
                            <td>: {{format_uang($workorder->odo)}} KM</td>
                        </tr>
                    </table>
                    <h4>Work Package</h4>
                    <table class="table" style="text-align: left;  font-size: 12px;" id="judul">
                        <tr>
                                    <th>No</th>
                                    <th>PACKAGE NAME</th>
                                    <th>LOG DATE</th>
                                    <th>PROBLEM</th>
                                    <th>SCHEDULE</th>
                                    <th>ACTION</th>
                                </tr>
                                <tr>
                                    <td>1. </td>
                                    <td>{{$workorder->packages_name}}</td>
                                    <td>{{$workorder->log_date}}</td>
                                    <td>{{$workorder->problem}}</td>
                                    <td>{{$workorder->shceduled_date}}</td>
                                    <td>{{$workorder->nomor_polisi}}</td>


                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>Service Type D - 20000</td>
                                    <td>{{$workorder->log_date}}</td>
                                    <td>Routine</td>
                                    <td>{{$workorder->shceduled_date}}</td>
                                    <td>{{$workorder->nomor_polisi}}</td>
                                </tr>
                    </table>
                    <h4>Material and Part</h4>
                    <table class="table" style="text-align: left;  font-size: 12px;" id="judul">
                        <tr>
                                    <th>No</th>
                                    <th>PART NUMBER</th>
                                    <th>PART NAME</th>
                                    <th>QTY</th>
                                    <th>UOM</th>
                                    <th>ACTION</th>
                                </tr>
                                <tr><td>1</td><td>48420-61J00</td><td>PERTAMINA PRIMA XP(SAE 20W-50)</td><td>4</td><td>LTR</td><td></td></tr>
                                <tr><td>2</td><td>ZA-35BWD24CA18</td><td>SGP DXE 1006 / INDOPART 16510-82700-000</td><td>1</td><td>PCS</td><td></td></tr>
                                <tr><td>3</td><td>44241-61J00</td><td>Denso - 4 ea</td><td>4</td><td>PCS</td><td></td></tr>
                                <tr><td>4</td><td>H11 12V 55W</td><td>SGP - DXE 1020</td><td>1</td><td>PCS</td><td></td></tr>
                                <tr><td>5</td><td>53200-61J00-000</td><td>Prestone dot 3</td><td>1</td><td>Botol</td><td></td></tr>
                                <tr><td>6</td><td>AFTDW04-1-01</td><td>Pertamina Rored (SAE 90)</td><td>4</td><td>LTR</td><td></td></tr>
                                <tr><td>7</td><td>83640-61J00</td><td>MEGACOOL COOLANT</td><td>1</td><td>Botol</td><td></td></tr>

                    </table>
                    <h4>LEMBAR PEMERIKSAAN SERVICE KENDARAAN LV-DC</h4>

                    <table class="table" style="text-align: left;  font-size: 12px;" id="judul">
                        
                        <tr>
                                    <th>NO</th>
                                    <th>PEKERJAAN</th>
                                    <th>Baik</th>
                                    <th>Setel</th>
                                    <th>Bersihkan</th>
                                    <th>Tambahakan</th>
                                    <th>Ganti</th>
                                    <th>Catatan</th>
                                   
                                </tr>
                                <tr><td>1</td><td>Ganti Oli Mesin</td><td></td><td></td><td></td><td></td><td></td><td>PERTAMINA PRIMA XP(SAE 20W-50) 4 LTR</td></tr>
<tr><td>2</td><td>Ganti Drain Plug Gasket</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>3</td><td>Periksa Kondisi Drive Belt / Fan Belt dan setel jika perlu</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>4</td><td>Periksa selang dan sambungan sistem pendingin</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>5</td><td>Periksa dan setel pedal kopling</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>6</td><td>Periksa dan setel rem tangan 5  Klik</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>7</td><td>Periksa minyak rem , pipa , dan selang saluran rem</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>8</td><td>Periksa dan kencangkan baut & mur bagian bawah</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>9</td><td>Periksa ban dan tekanan angin</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>10</td><td>Periksa dan lumasi engsel pintu</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>11</td><td>Periksa semua lampu bagian luar dan dalam</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>12</td><td>Periksa sistem suspensi </td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>13</td><td>Periksa wiper kaca dan nozzle washer</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>14</td><td>Periksa dan tambah air aki</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>15</td><td>Periksa dan tambahkan air washer</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>16</td><td>Periksa dan tambahkan engine coolant</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>17</td><td>Perisa kinerja klakson</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>18</td><td>Periksa kinerja semua power window dan central lock</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>19</td><td>Periksa kondisi drive / Propeller shaft</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>20</td><td>Periksa kinerja electric mirror</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>21</td><td>Periksa kondisi blower , filter , dan freon AC</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>22</td><td>Periksa dan setel iddle speed / fast idle minute</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>23</td><td>Periksa system power steering</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>24</td><td>Periksa kebocoran oil steering</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>25</td><td>Periksa kebocoran oli transmisi</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>26</td><td>Periksa kebocoran oli transfer</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>27</td><td>Periksa kebocoran oli differential ( Rear + Front )</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>28</td><td>Ganti filter oli</td><td></td><td></td><td></td><td></td><td></td><td>SGP DXE 1006 / INDOPART 16510-82700-000</td></tr>
<tr><td>29</td><td>Periksa dan bersihkan filter udara</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>30</td><td>Ganti Contact Breaker</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>31</td><td>Periksa dan tambahkan power steering fluid</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>32</td><td>Periksa dan tambahkan tambahkan transmision fluid</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>33</td><td>Periksa steering wheel dan sambungannya</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>34</td><td>Periksa kondisi bearing roda</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>35</td><td>Periksa kondisi battery</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>40</td><td>Ganti Busi</td><td></td><td></td><td></td><td></td><td></td><td>Denso - 4 ea</td></tr>
<tr><td>41</td><td>Ganti element Filter Udara</td><td></td><td></td><td></td><td></td><td></td><td>SGP - DXE 1020</td></tr>
<tr><td>42</td><td>Periksa Pipa exhaust dan mounting</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>43</td><td>Periksa engine mounting</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>44</td><td>Periksa tutup tangki , sambungan & saluran bahan bakar</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>45</td><td>Periksa boot drive shaft</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>46</td><td>Periksa tie rod ball joint dan dust cover</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>47</td><td>Periksa suspension depan dan belakang</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>48</td><td>Periksa filter element Air Conditioner ( AC )</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>49</td><td>Ganti Filter bahan bakar</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>50</td><td>Ganti minyak rem</td><td></td><td></td><td></td><td></td><td></td><td>Prestone dot 3 - 1 botol</td></tr>
<tr><td>51</td><td>Ganti oli transfer</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>52</td><td>Ganti Oli Transmisi</td><td></td><td></td><td></td><td></td><td></td><td>Pertamina Rored (SAE 90) 4 ltr</td></tr>
<tr><td>53</td><td>Ganti oli differential</td><td></td><td></td><td></td><td></td><td></td><td>Pertamina Rored (SAE 90) 4 ltr</td></tr>
<tr><td>54</td><td>Ganti engine coolant</td><td></td><td></td><td></td><td></td><td></td><td>MEGACOOL COOLANT</td></tr>
<tr><td>55</td><td>Periksa dan bersihkan tutup & rotor distrinbutor</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>56</td><td>Periksa dan setel ignition timeng dan dwell angle</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>

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
