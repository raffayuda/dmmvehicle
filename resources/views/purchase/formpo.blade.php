<!DOCTYPE html>
<html lang="en">

<head>
    <title>PO Document</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    #pageCounter {
      counter-reset: pageTotal;
    }
    #pageCounter span {
      counter-increment: pageTotal; 
    }
    #pageNumbers {
      counter-reset: currentPage;
    }
    #pageNumbers div:before { 
      counter-increment: currentPage; 
      content: "Page " counter(currentPage) " of "; 
    }
    #pageNumbers div:after { 
      content: counter(pageTotal); 
    }
    #totalPage div:after { 
      content: counter(pageTotal); 
    }
    </style>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
        }

        /* Style the header */
        .header {
            background-color: white;
            padding: 0px 20px 0px 30px;
            text-align: center;
        }

        /* Style the top navigation bar */
        .topnav {
            overflow: hidden;
            background-color: #333;
        }

        /* Style the topnav links */
        .topnav a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        /* Change color on hover */
        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        /* Create three equal columns that floats next to each other */
        .logo {
            float: left;
            width: 10%;
            padding: 15px;
            display: block;
        }

        /* Create three equal columns that floats next to each other */
        /* .column {
            float: left;
            width: 90%;
            padding: 15px;
        } */

        /* Create three equal columns that floats next to each other */
        .content {
            float: left;
            width: 100%;
            padding: 0px;
        }

        /* Create three equal columns that floats next to each other */
        .poinfo {
            float: left;
            width: 50%;
            /* padding: 15px; */
            margin: 0px;
        }

        /* Create three equal columns that floats next to each other */
        .tengah {
            float: left;
            width: 20%;
            padding: 0px;
        }
        .column {
            float: left;
            width: 40%;
            padding: 0px 1px 0px 0px;
        }

        /* Create three equal columns that floats next to each other */
        .columnn {
            float: left;
            width: 66.66%;
            padding: 15px;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
        @media screen and (max-width:600px) {
            .column {
                width: 100%;
            }
        }

        #container {
            position: relative;
        }

        table {
            float: left;
            margin: 0px;
            width: 100%;
            font-size: 10px;

        }
        #judul {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  float: left;
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
    </style>
</head>

<body>

    <div class="header">
        <div class="row">
            <div class="logo">
                <img src="{{asset('public/images/LOGO_DMM.jpg')}}" height="60">
            </div>
            <div class="info">
                <h3 style="margin : 0;">PT. DAYA MITRA MULTI PRATAMA</h3>
                <p style="margin : 0;">Epiwalk Office Suites, Unit B-705 Kompleks Rasuna Epicentrum </p>
                <p style="margin : 0;"> HR Rasuna Said - Jakarta Selatan Indonesia 1294</p>
                <p style="margin : 0;"><b>Phone :</b> (021) 29941460 / 61 / 62 <b>FAX : </b>(021) 29941463</p>
            </div>

        </div>
    </div>
    <hr style="margin : 0;">


    <div class="row">
        <div class="content">
            <h3 style="text-align : center; text-decoration: underline; margin :0;">PURCHASE ORDER</h3>
        <h5 style="text-align : center; margin :0;">{{$po->po_alias}}</h5>
        </div>
    
    </div>
{{-- {{$po}} --}}

<div class="row">
  <table>
    <tr>
      <td width="20%" style="margin:0;">PO Date</td>
      <td>: {{tanggal_indo($po->po_date)}} </td>
      <td rowspan="5" style="margin:0; border-style: ridge">
      <p style="margin:0;"><b>Supplier :</b></p> 
      <hr> 
      <p style="margin:1px; "> {{$suppliers->suppliers_name}} </p>
      <p></p>
      <p style="margin:1px; ">PIC   : {{$suppliers->contact_person}} </p>
      <p style="margin:1px; ">Phone : {{$suppliers->phone}} </p>
      <p style="margin:1px; ">Fax : {{$suppliers->phone}} </p>
      <p style="margin:1px; ">Email : {{$suppliers->phone}} </p>
      
      </td>
    </tr>
    <tr>
      <td>Term of Payment</td>
      <td>: {{$po->top}} </td>
    </tr>
    <tr>
      <td>Delivery Point</td>
      <td>: {{$po->delivery_point}} </td>
    </tr> 
    <tr>
      <td>SPR Number</td>
      <td>: {{$po->spr_alias}} </td>
    </tr> 
    <tr>
      <td>Cost Code</td>
      <td>: {{$cost_code->vehiclemodels_name}} </td>
    </tr> 
  </table>
</div>




    <div class="row">
      <div class="content">
        <table id="judul">
          <thead>
          <tr>
            <th>No</th>
            <th>Description</th>
            <th>QTY</th>
            <th>UNIT</th>
            <th>UNIT PRICE</th>
            <th>TOTAL PRICE</th>
          </tr>
          </thead>
          <tbody>
          @foreach ($parts as $part)
              
         
          <tr>
            <td> {{++$no}} </td>
            <td>{{$part->spareparts_name}} </td>
            <td>{{$part->qty}} </td>
            <td>{{$part->uom}} </td>
            <td style="text-align:right;">{{format_uang($part->price)}} </td>
            <td style="text-align:right;">{{format_uang($part->total)}} </td>
            {{$total +=$part->total}}
          </tr>
           @endforeach
           </tbody>
           <tfoot>
          <tr>
            <td colspan="4">TERM AND CONDITION :</td>
            <td><b>TOTAL</b></td>
            <td style="text-align:right;"> {{format_uang($total)}} </td>
          </tr>
          </tfoot>
        </table>
      </div>
    </div>
    <p></p>
<div class="row">
  <table>
    <tr>
      <td width="25%" style="margin:0; border-style: ridge">
        <p style="margin:0;"><b>Forward Invoice to :</b></p> 
        <hr> 
        <p style="margin:1px; ">PT. Daya Mitra Multipratama</p>
        <p style="margin:1px; ">Epiwalk Office Suites, Unit B-705</p>
        <p style="margin:1px; ">Kompleks Rasuna Epicentrum</p>
        <p style="margin:1px; ">Jl. HR Rasuna Said - Jakarta Selatan </p>
        <p style="margin:1px; ">Indonesia 12940 </p>
        <p style="margin:1px; ">Phone : (021) 29941460 / 61 / 6 </p>
        <p style="margin:1px; ">FAX : (021) 29941463</p>
        <br>
        <br>

      </td>
      <td width="25%" style="margin:0; border-style: ridge">
        <p style="margin:0;"><b>Site Office :</b></p> 
        <hr> 
        <p style="margin:1px; ">Jl. Parakesit Road 9 , Sangatta Utara</p>
        <p style="margin:1px; ">Sangatta, Kutai Timur</p>
        <p style="margin:1px; ">Kalimantan Timur</p>
        <p style="margin:1px; ">Indonesia 75611</p>
        <br>
        <br>
        <br>
        <br>
        <br>
      </td>
      <td width="25%" style="margin:0; border-style: ridge">
        <p style="margin:0;"><b>Purchasing Oficer :</b></p> 
        <hr> 
        <p style="margin:1px; ">Shadran Bilalki</p>
        <p style="margin:1px; ">(62) 81281116656</p>
        <p style="margin:1px; ">shadran.bilalki@dmmpratama.co.id</p>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

      </td>
      <td width="25%" style="margin:0; border-style: ridge">
        <p style="margin:0;"><b>Suppiler Representative :</b></p> 
        <hr> 
        <br>
        <br>
        <br>
        <br>
        <p style="margin:1px; ">Name  : </p>
        <p style="margin:1px; ">Phone :  </p>
        <p style="margin:1px; ">Title :  </p>
        <p style="margin:1px; ">Email : </p>
        
        <p style="margin:1px; ">(Return to DMM afer signed) </p>
      </td>
    </tr>
  </table>
</div>


</body>

</html>
