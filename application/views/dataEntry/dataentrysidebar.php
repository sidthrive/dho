<div id="page" class="container">
    <div id="sidebar1">
        <div id="box1">
            <h2>DATA ENTRY</h2>
            <!-- Data Entry Bidan-->
            <div id="bidan">
              <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#bidanentry" style="width: 250px; text-align: left;">Bidan</button>
              <div id="bidanentry" class="collapse">
                <div id="subbidanentry" style="padding-left:25px;">
                  <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#TEtF" style="width: 225px; text-align: left;">Total Entry tiap Form </button>
                  <div id="TEtF" class="collapse" style="padding-left:40px;">
                      <p><a href=<?php echo site_url() ."/dataEntry/BidanFormSengkol"?>>Kecamatan Sengkol</a></p>
                      <p><a href=<?php echo site_url() ."/dataEntry/BidanFormJanapria"?>>Kecamatan Janapria</a></p>
                  </div>
                </div>
                <div id="subbidanentrytanggal" style="padding-left:25px;">
                  <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#TEtT" style="width: 225px; text-align: left;">Total Entry tiap Form </button>
                  <div id="TEtT" class="collapse" style="padding-left:40px;">
                      <p><a href=<?php echo site_url() ."/dataEntry/BidanTanggalSengkol"?>>Kecamatan Sengkol</a></p>
                      <p><a href=<?php echo site_url() ."/dataEntry/BidanTanggalJanapria"?>>Kecamatan Janapria</a></p>
                  </div>
                </div>
              </div>
            </div>
            <!-- Data Entry Gizi-->
            <div id="Gizi">
              <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#gizientry" style="width: 250px; text-align: left;">Gizi</button>
              <div id="gizientry" class="collapse" style="padding-left: 25px;">
                <p><a href=<?php echo site_url() ."/dataEntry/GiziSengkol"?>>Kecamatan Sengkol</a></p>
                <p><a href=<?php echo site_url() ."/dataEntry/GiziJanapria"?>>Kecamatan Janapria</a></p>
              </div>
            </div>
            <!-- Data Entry Jurim-->
            <div id="Gizi">
              <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#jurimentry" style="width: 250px; text-align: left;">Jurim</button>
              <div id="jurimentry" class="collapse" style="padding-left: 25px;">
                <p><a href=<?php echo site_url() ."/dataEntry/JurimSengkol"?>>Kecamatan Sengkol</a></p>
                <p><a href=<?php echo site_url() ."/dataEntry/JurimJanapria"?>>Kecamatan Janapria</a></p>
              </div>
            </div>
        </div>
    </div>