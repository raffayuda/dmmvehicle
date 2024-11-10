<h4>LEMBAR PEMERIKSAAN SERVICE KENDARAAN</h4>
<table class="table" style="text-align: left;  font-size: 9px;">
                        <tr>
                            <td>Work Order Number</td>
                            <td>: {{$workorder->wo_alias}}</td>
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
                    </table>
<table class="table" style="text-align: left;  font-size: 9px;" id="judul">
    <tr>
        <th width="5%">NO</th>
        <th width="30%">PEKERJAAN</th>
        <th width="9%">Baik</th>
        <th width="9%">Setel</th>
        <th width="9%">Bersihkan</th>
        <th width="9%">Tambahakan</th>
        <th width="9%">Ganti</th>
        <th width="20%">Catatan</th>
    </tr>
    <tr><td colspan="8" style="text-align : center;">SERVICE TYPE "A" / KELIPATAN 5.000( 1-27 )</td></tr>
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
    <tr><td colspan="8" style="text-align : center;">SERVICE TYPE "B" / KELIPATAN 10.000( 1-39 )</td></tr>
    <tr><td>28</td><td>Ganti filter oli</td><td></td><td></td><td></td><td></td><td></td><td>SGP DXE 1006 / INDOPART 16510-82700-000</td></tr>
    <tr><td>29</td><td>Periksa dan bersihkan filter udara</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
    <tr><td>30</td><td>Ganti Contact Breaker</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
    <tr><td>31</td><td>Periksa dan tambahkan power steering fluid</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
    <tr><td>32</td><td>Periksa dan tambahkan tambahkan transmision fluid</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
    <tr><td>33</td><td>Periksa steering wheel dan sambungannya</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
    <tr><td>34</td><td>Periksa kondisi bearing roda</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
    <tr><td>35</td><td>Periksa kondisi battery</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
    <tr><td colspan="8" style="text-align : center;">Pengukuran diameter dalam drum brake berdasarkan OEM</td></tr>
    <tr><td rowspan="5">36</td><td>Posisi Drum Brake</td><td colspan="6">Hasil Pengukuran ( Mili Meter )</td></tr>
    <tr>                  <td rowspan="2">Pos 3</td><td colspan="2">X1=</td><td colspan="2">X2=</td><td colspan="2">X3=</td></tr>
 	<tr>                                            <td colspan="2">Y1=</td><td colspan="2">Y2=</td><td colspan="2">Y3=</td></tr>												
    <tr>                  <td rowspan="2">Pos 4</td><td colspan="2">X1=</td><td colspan="2">X2=</td><td colspan="2">X3=</td></tr>
 	<tr>                                            <td colspan="2">Y1=</td><td colspan="2">Y2=</td><td colspan="2">Y3=</td></tr>													
    <tr><td colspan="8" style="text-align : center;">SERVICE TYPE "C" / KELIPATAN 15.000( 1-48 )</td></tr>

    <tr><td rowspan="4">37</td><td colspan="7">Pengukuran ketebalan lining brake berdasarkan OEM</td></tr>
    <tr>                       <td>Posisi Lining Brake</td><td colspan="3">Hasil Pengukuran ( Mili Meter )</td><td colspan="3">Keterangan ( Standart / Limit )</td></tr>
    <tr>                       <td>Pos 3</td><td colspan="3"></td><td colspan="3"></td></tr>
    <tr>                       <td>Pos 3</td><td colspan="3"></td><td colspan="3"></td></tr>

    <tr><td rowspan="4">38</td><td colspan="7">Pengukuran ketebalan Disc Brake</td></tr>
    <tr>                       <td>Posisi Lining Brake</td><td colspan="3">Hasil Pengukuran ( Mili Meter )</td><td colspan="3">Keterangan ( Standart / Limit )</td></tr>
    <tr>                       <td>Pos 3</td><td colspan="3"></td><td colspan="3"></td></tr>
    <tr>                       <td>Pos 3</td><td colspan="3"></td><td colspan="3"></td></tr>

    <tr><td rowspan="4">39</td><td colspan="7">Pengukuran ketebalan Brake Pad</td></tr>
    <tr>                       <td>Posisi Lining Brake</td><td colspan="3">Hasil Pengukuran ( Mili Meter )</td><td colspan="3">Keterangan ( Standart / Limit )</td></tr>
    <tr>                       <td>Pos 3</td><td colspan="3"></td><td colspan="3"></td></tr>
    <tr>                       <td>Pos 3</td><td colspan="3"></td><td colspan="3"></td></tr>

    <tr><td>40</td><td>Ganti Busi</td><td></td><td></td><td></td><td></td><td></td><td>Denso - 4 ea</td></tr>
    <tr><td>41</td><td>Ganti element Filter Udara</td><td></td><td></td><td></td><td></td><td></td><td>SGP - DXE 1020</td></tr>
    <tr><td>42</td><td>Periksa Pipa exhaust dan mounting</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
    <tr><td>43</td><td>Periksa engine mounting</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
    <tr><td>44</td><td>Periksa tutup tangki , sambungan & saluran bahan bakar</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
    <tr><td>45</td><td>Periksa boot drive shaft</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
    <tr><td>46</td><td>Periksa tie rod ball joint dan dust cover</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
    <tr><td>47</td><td>Periksa suspension depan dan belakang</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
    <tr><td>48</td><td>Periksa filter element Air Conditioner ( AC )</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>

    <tr><td colspan="8" style="text-align : center;">SERVICE TYPE "D" / KELIPATAN 20.000( 1-56 )</td></tr>

    <tr><td>49</td><td>Ganti Filter bahan bakar</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
    <tr><td>50</td><td>Ganti minyak rem</td><td></td><td></td><td></td><td></td><td></td><td>Prestone dot 3 - 1 botol</td></tr>
    <tr><td>51</td><td>Ganti oli transfer</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
    <tr><td>52</td><td>Ganti Oli Transmisi</td><td></td><td></td><td></td><td></td><td></td><td>Pertamina Rored (SAE 90) 4 ltr</td></tr>
    <tr><td>53</td><td>Ganti oli differential</td><td></td><td></td><td></td><td></td><td></td><td>Pertamina Rored (SAE 90) 4 ltr</td></tr>
    <tr><td>54</td><td>Ganti engine coolant</td><td></td><td></td><td></td><td></td><td></td><td>MEGACOOL COOLANT</td></tr>
    <tr><td>55</td><td>Periksa dan bersihkan tutup & rotor distrinbutor</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
    <tr><td>56</td><td>Periksa dan setel ignition timeng dan dwell angle</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>


</table>
<p></p>