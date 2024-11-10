<!DOCTYPE html>
<html lang="en">

<head>
    <title>CSS Website Layout</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
        .column {
            float: left;
            width: 90%;
            padding: 15px;
        }

        /* Create three equal columns that floats next to each other */
        .content {
            float: left;
            width: 100%;
            padding: 15px;
        }

        /* Create three equal columns that floats next to each other */
        .poinfo {
            float: left;
            width: 50%;
            padding: 15px;
        }

        /* Create three equal columns that floats next to each other */
        .column {
            float: left;
            width: 33.33%;
            padding: 15px;
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
                <img src="{{asset('public/images/LOGO DMM.jpg')}}" height="70">
            </div>
            <div class="info">
                <h3 style="margin : 0;">PT. DAYA MITRA MULTI PRATAMA</h3>
                <p style="margin : 0;">Epiwalk Office Suites, Unit B-705 Kompleks Rasuna Epicentrum </p>
                <p style="margin : 0;"> HR Rasuna Said - Jakarta Selatan Indonesia 1294</p>
                <p><b>Phone :</b> (021) 29941460 / 61 / 62 <b>FAX : </b>(021) 29941463</p>
            </div>

        </div>
    </div>
    <hr>


    <div class="row">
        <div class="content">
            <h3 style="text-align : center; text-decoration: underline; margin :0;">PURCHASE ORDER</h3>
            <h5 style="text-align : center; margin :0;">Nomor PO</h5>
        </div>
    
    </div>

    <div class="row">
      <div class="poinfo">
        <table id="judul">
          <tr>
            <th>sdf</th>
          </tr>
        </table>
        <p style="margin:0;">
          <div style="float:left">
            PO Date
          </div>
          <div style="float:left">
            : PO Date
          </div>
        </p>
        <p style="margin:0;">Term of Payment :</p>
        <p>Delivery Point/Instruction :</p>
        <p>SPR Number :</p>
        <p>Cost Code :</p>
      </div>
      <div class="poinfo">
        <table id="judul">
          <tr>
            <th>sdf</th>
          </tr>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="content">
        <table id="judul">
          <tr>
            <th>No</th>
            <th>Description</th>
            <th>QTY</th>
            <th>UNIT</th>
            <th>UNIT PRICE</th>
            <th>TOTAL PRICE</th>
          </tr>
          <tr>
            <td>s</td>
            <td>s</td>
            <td>s</td>
            <td>s</td>
            <td>s</td>
            <td>s</td>
          </tr>
        </table>
      </div>
    </div>
    
  
  


</body>

</html>
