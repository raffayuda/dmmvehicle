<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Print Purchase Order</title>
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
                  <div class="col-3">
                    <table border="0" style="text-align: left width:100%;  font-size: 12px;">
                      <tr>
                        <td><img src="{{asset('public/assets/images/logo_dmm.jpg')}}" alt="homepage" height="100" class="dark-logo" />
                        <b>PT. DAYA MITRA MULTIPRATAMA</b></td>
                        <td colspan="7" style="text-align: center" width:100%;><h2> <u>PURCHASE ORDER</u></h1> <br>
                        DMM/325/PO/VI/2019
                        </td>
                      </tr>
                      <tr>
                        <td> <b> Forward Invoices to : </b></td>
                        
                        
                      </tr>
                      <tr>
                        <td>PT. Daya Mitra Multipratama <br>
                            Epiwalk Office Suites, Unit B-705 <br>
                            Kompleks Rasuna Epicentrumbr <br>
                            Jl. HR Rasuna Said - Jakarta Selatan <br>
                            Indonesia 12940 <br>
                            <b> Phone : </b>(021) 29941460 / 61 / 62 <br>
                            <b> Fax   : </b>(021) 29941463
                        </td>
                        <td></td>
                        <td colspan="2"> PO Number <br>
                          PO Date <br>
                          Version <br>
                          Term of Payment <br>
                          Delivery Point <br>
                          SPR Number 
                          Cost Code
                          </td>
                        <td colspan="2">: DMM/325/PO/VI/2019 <br>
                          : 13-Jun-19 <br>
                          : 30 Days After Goods Devlivered <br>
                          : Workshop DMM Sangatta <br>
                          : 0739 <br>
                          : APV
                        </td>
                        <td colspan="2" > <b> Supplier Information :</b>  <br>
                        UD Bintang Jaya</td>
                      </tr>
                      <tr>
                        <td><b>Site Office :</b></td>
                        <td colspan="7" rowspan="6">
                          <table border="1">
                            <tr>
                              <th>No</th>
                              <th>DESCRIPTION</th>
                              <th>QTY</th>
                              <th>UNIT</th>
                              <th>UNIT PRICE</th>
                              <th>TOTAL PRICE</th>
                            </tr>
                            <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>

                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>Jl. Parakesit Road 9 , Sangatta Utara <br>
                            Sangatta, Kutai Timur <br>
                            Kalimantan Timur <br>
                            Indonesia 75611 <br>

                        </td>
                      </tr>
                      <tr>
                        <td><b>Purchasing Officer :</b></td>
                      </tr>
                      <tr>
                        <td>Shadran Bilalki <br>
                            (62) 81281116656 <br>
                            shadran.bilalki@dmmpratama.co.id

                        </td>
                      </tr>
                      <tr>
                        <td><b>Supplier Representative :</b><br>
                          (Return to DMM after Signing)

                        </td>
                      </tr>
                      <tr>
                        <td>Name : <br>
                          Phone : <br>
                          Title : <br>
                          Email : <br>
                        </td>
                      </tr>
                    </table>
                    </div>
                               
                
                {{-- <div class="page-break"></div> --}}
                {{-- @endforeach --}}
            </div>
        </div>
    </div>
</div>

{{-- @include('notifikasi.form') --}}


@section('script')




@endsection
