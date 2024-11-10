<style>

.page-break {
    page-break-after: always;
}
</style>

<h3>LEMBAR PEMERIKSAAN SERVICE KENDARAAN {{$workorder->packages_name}}</h3>
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
        <th colspan="2">NO</th>
        <th>ITEM PENGECEKAN</th>
        <th colspan="6">Hasil Pemeriksaan Dan Tindak Lanjut</th>
    </tr>
    {{-- <tr>
    <td>{{++$nooo}}</td>
    <td>{{$workorder->problem}}</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>{{$workorder->note}}</td>
    </tr> --}}
    <tr><td rowspan="9">1. </td><td colspan="8">ENGINE</td></tr>
    <tr><td>1.</td><td width="25%">Cek Oli Mesin</td><td>Level Min</td><td></td><td>Level Max</td><td></td><td>Tindakan</td><td width="15%"></td></tr>
    <tr><td>2.</td><td>Cek Kebocoran Oli Mesin</td><td>Bocor</td><td></td><td>Tidak Bocor</td><td></td><td>Tindakan</td><td></td></tr>
    <tr><td>3.</td><td>Cek Filter Udara</td><td>Kotor</td><td></td><td>Bersih</td><td></td><td>Tindakan</td><td></td></tr>
    <tr><td>4.</td><td>Cek Filter Bahan Bakar</td><td>Kotor</td><td></td><td>Bersih</td><td></td><td>Tindakan</td><td></td></tr>
    <tr><td>5.</td><td>Cek Sistem Radiator</td><td>Level Min</td><td></td><td>Level Max</td><td></td><td>Tindakan</td><td></td></tr>
    <tr><td>6.</td><td>Cek V-Belt Dan Adjuster </td><td>Kendor</td><td></td><td>Kencang</td><td></td><td>Tindakan</td><td></td></tr>
    <tr><td>7.</td><td>Cek Mounting Engine</td><td>Longgar</td><td></td><td>Kuat</td><td></td><td>Tindakan</td><td></td></tr>
    <tr><td>8.</td><td>Cek Oil Separator</td><td>Bocor</td><td></td><td>Tidak Bocor</td><td></td><td>Tindakan</td><td></td></tr>
    <tr><td rowspan="3">2. </td><td colspan="8">CLUTCH</td></tr>
    <tr><td>1.</td><td>Cek Master Kopling Atas Dan Bawah</td><td>Bocor</td><td></td><td>Tidak Bocor</td><td></td><td>Tindakan</td><td></td></tr>
    <tr><td>2.</td><td>Cover,Disclutch,Release Bearing</td><td>Ubnormal</td><td></td><td>Normal</td><td></td><td>Tindakan</td><td></td></tr>

    <tr><td rowspan="4">3. </td><td colspan="8">TRANSMISI</td></tr>
    <tr><td>1.</td><td>Cek Kebocoran Oli Transmisi</td><td>Bocor</td><td></td><td>Tidak Bocor</td><td></td><td>Tindakan</td><td></td></tr>
    <tr><td>2.</td><td>Cek Mounting Transmisi</td><td>Longgar</td><td></td><td>Kuat</td><td></td><td>Tindakan</td><td></td></tr>
    <tr><td>3.</td><td>Cek Fungsi Tuas Transmisi</td><td>Kocak</td><td></td><td>Tidak kocak</td><td></td><td>Tindakan</td><td></td></tr>

    <tr><td rowspan="6">4. </td><td colspan="8">REAR AXLE</td></tr>
    <tr><td>1.</td><td>Cek Kebocoran Oli Differential</td><td>Bocor</td><td></td><td>Tidak Bocor</td><td></td><td>Tindakan</td><td></td></tr>
    <tr><td>2.</td><td>Cek Cross Joint Propeller Shaft</td><td>Goyang </td><td></td><td>Baik</td><td></td><td>Tindakan</td><td></td></tr>
    <tr><td>3.</td><td>Cek Baut Propeller Shaft</td><td>Kendor</td><td></td><td>Kencang</td><td></td><td>Tindakan</td><td></td></tr>
    <tr><td>4.</td><td>Cek Kebocoran Hub Roda Belakang</td><td>Bocor</td><td></td><td>Tidak Bocor</td><td></td><td>Tindakan</td><td></td></tr>
    <tr><td>5.</td><td>Cek Sistem Suspensi Roda Belakang</td><td>Lemah</td><td></td><td>Keras</td><td></td><td>Tindakan</td><td></td></tr>

    <tr><td rowspan="6">5. </td><td colspan="8">FRONT AXLE</td></tr>
    <tr><td>1.</td><td>Cek tierod</td><td>Goyang</td><td></td><td>Bagus</td><td></td><td>Tindakan</td><td></td></tr>
    <tr><td>2.</td><td>Cek Draglink,Kingpin</td><td>Goyang</td><td></td><td>Baik</td><td></td><td>Tindakan</td><td></td></tr>
    {{-- <tr><td rowspan="3"></td><td colspan="8"></td></tr> --}}
    
    <tr><td>3.</td><td>Cek stoper</td><td>Robek</td><td></td><td>Bagus</td><td></td><td>Tindakan</td><td></td></tr>
    <tr><td>4.</td><td>Cek Kebocoran Hub Roda Depan </td><td>Bocor</td><td></td><td>Tidak Bocor</td><td></td><td>Tindakan</td><td></td></tr>
    <tr><td>5.</td><td>Cek Sistem Suspensi Roda Depan </td><td>Lemah</td><td></td><td>Keras</td><td></td><td>Tindakan</td><td></td></tr>

{{--     
</table>

<p style="page-break-after: always;"></p>

<table class="table" style="text-align: left;  font-size: 10.5px;" id="judul"> --}}

    <tr><td rowspan="6">6. </td><td colspan="8">SISTEM PENGEREMAN </td></tr>
    <tr><td>1.</td><td>Cek Kampas Rem Depan Dan Belakang</td><td>Tipis</td><td></td><td>Tebal</td><td></td><td>Tindakan</td><td width="22%"></td></tr>
    <tr><td>2.</td><td>Cek Master Rem Depan Dan Belakang </td><td>Bocor</td><td></td><td>Tidak Bocor</td><td></td><td>Tindakan</td><td></td></tr>
    <tr><td>3.</td><td>Chek Wheel Silinder Rem</td><td>Bocor</td><td></td><td>Tidak Bocor</td><td></td><td>Tindakan</td><td></td></tr>
    <tr><td>4.</td><td>Cek Minyak Rem</td><td>Level Min</td><td></td><td>Level Max</td><td></td><td>Tindakan</td><td></td></tr>
    <tr><td>5.</td><td>Cek Rem Tangan (Just Antara 6-9 Klik)</td><td>Jelek</td><td></td><td>Bagus</td><td></td><td>Tindakan</td><td></td></tr>

    <tr><td rowspan="5">7. </td><td colspan="8">STEERING SISTEM </td></tr>
    <tr><td>1.</td><td>Cek Oli Power Steering</td><td>Level Min</td><td></td><td>Level Max</td><td></td><td>Tindakan</td><td></td></tr>
    <tr><td>2.</td><td>Cek Kebocoran Oli Power Steering</td><td>Bocor</td><td></td><td>Tidak Bocor</td><td></td><td>Tindakan</td><td></td></tr>
    <tr><td>3.</td><td>Cek Tierod</td><td>Goyang</td><td></td><td>Baik</td><td></td><td>Tindakan</td><td></td></tr>
    <tr><td>4.</td><td>Cek Gear Box Steering</td><td>Rusak</td><td></td><td>Bagus</td><td></td><td>Tindakan</td><td></td></tr>

    <tr><td>8. </td><td colspan="8">SAFETY BELT</td></tr>
   
    <tr><td rowspan="5">9. </td><td colspan="8">TYRE</td></tr>
    <tr><td>1.</td><td>Periksa Tread Ban (kedalaman Alur Ban)</td><td>Tipis</td><td></td><td>Tebal</td><td></td><td>Tindakan</td><td>P1:     P2:    P3:    P4: </td></tr>
    <tr><td>2.</td><td>Periksa Keausan Ban (Normal/Ubnormal</td><td>Aus</td><td></td><td>Bagus</td><td></td><td>Tindakan</td><td></td></tr>
    <tr><td>3.</td><td>Periksa Tekanan Ban 30/35 Psi</td><td>Min</td><td></td><td>Max</td><td></td><td>Tindakan</td><td></td></tr>
    <tr><td>4.</td><td>Periksa Kekencangan Baut Roda (17kg)</td><td>Kendor</td><td></td><td>Kencang</td><td></td><td>Tindakan</td><td></td></tr>

    <tr><td rowspan="6">10. </td><td colspan="8">CONTROL AIR CONDITIONER</td></tr>
    <tr><td>1.</td><td>Cek Switch Ac</td><td>Rusak</td><td></td><td>Bagus</td><td></td><td>Tindakan</td><td></td></tr>
    <tr><td>2.</td><td>Cek Sistem Kondensor Ac</td><td>Kotor</td><td></td><td>Bersih</td><td></td><td>Tindakan</td><td></td></tr>
    <tr><td>3.</td><td>Cek Sistem Evaporator Ac</td><td>Kotor</td><td></td><td>Bersih</td><td></td><td>Tindakan</td><td></td></tr>
    <tr><td>4.</td><td>Cek Sistem Kompressor</td><td>Rusak</td><td></td><td>Bagus</td><td></td><td>Tindakan</td><td></td></tr>
    <tr><td>5.</td><td>Cek Motor Fan Blower ac</td><td>Bunyi</td><td></td><td>Tidak Bunyi</td><td></td><td>Tindakan</td><td></td></tr>

    <tr><td rowspan="5">11. </td><td colspan="8">ACCU DAN ELECTRIC</td></tr>
    <tr><td>1.</td><td>Cek Air Accu</td><td>Level Min</td><td></td><td>Level Max</td><td></td><td>Tindakan</td><td></td></tr>
    <tr><td>2.</td><td>Cek Terminal/Kepala Accu</td><td>Kotor</td><td></td><td>Bersih</td><td></td><td>Tindakan</td><td></td></tr>
    <tr><td>3.</td><td>Cek Kabel-Kabel,Relay,Fuse</td><td>Rusak</td><td></td><td>Bagus</td><td></td><td>Tindakan</td><td></td></tr>
    <tr><td>4.</td><td>Cek Voltage Accu 12 Volt</td><td>Drop</td><td></td><td>Stabil</td><td></td><td>Tindakan</td><td></td></tr>

    <tr><td>12. </td><td colspan="8">STARTER MOTOR</td></tr>
    <tr><td>13. </td><td colspan="8">PINTU (Cek Lock Pintu Dan Regulator Kaca)</td></tr>
    <tr><td>14. </td><td colspan="8">INSTRUMENT DASHBOARD</td></tr>
    <tr><td>15. </td><td colspan="8">WIPER DAN KARET WIPER</td></tr>
    <tr><td>16. </td><td colspan="8">LAMPU-LAMPU</td></tr>
    <tr><td>17. </td><td colspan="8">AUDIO</td></tr>
    <tr><td>18. </td><td colspan="8">KACA SPION</td></tr>
    <tr><td>19. </td><td colspan="8">KONDISI JOK SUPIR DAN PENUMPANG</td></tr>
    <tr><td>20. </td><td colspan="8">KOTAK P3K</td></tr>
    <tr><td>21. </td><td colspan="8">SEGITIGA PENGAMAN</td></tr>
    <tr><td>22. </td><td colspan="8">ALAT PEMADAM API</td></tr>
    <tr><td>23. </td><td colspan="8">DONGKRAK</td></tr>
    <tr><td>24. </td><td colspan="8">KUNCI RODA</td></tr>
    <tr><td>25. </td><td colspan="8">TEST ROAD</td></tr>

</table>


</div>


<p></p>
