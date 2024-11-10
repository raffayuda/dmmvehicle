<h4>LEMBAR PEMERIKSAAN SERVICE KENDARAAN {{$workorder->packages_name}}</h4>
<table class="table" style="text-align: left;  font-size: 10.5px;" width="100%">
                        <tr>
                            <td>Work Order Number</td>
                            <td>: {{$workorder->wo_alias}}</td>
                            <td>Nomor Lambung</td>
                            <td>: {{$vehicle->nomor_lambung}}</td>
                            <td>Note</td>
                            <td>: {{$workorderparent->note}}</td>
                        </tr>
                        <tr>
                            <td>Schedule Date</td>
                            <td>: {{tanggal_indo($workorderparent->schedule_date)}}</td>
                            <td>Nomor Polisi</td>
                            <td>: {{$vehicle->nomor_polisi}}</td>
                            <td>WO Created By</td>
                            <td>: {{$workorderparent->created_by}}</td>
                        </tr>
                        <tr>
                            <td>Time</td>
                            <td>: {{$workorderparent->time}}</td>
                            <td>ODO</td>
                            <td>: {{format_uang($workorderparent->odo)}} KM</td>
                            <td>WO Printed By</td>
                            <td>: {{Auth::user()->name}}</td>
                        </tr>


</table>
<table class="table" style="text-align: left;  font-size: 10.5px;" id="judul">
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
    <tr>
    <td>{{++$nooo}}</td>
    <td>{{$workorder->problem}}</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>{{$workorder->note}}</td>
    </tr>
</table>
<p></p>
