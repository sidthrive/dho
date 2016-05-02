<div id="page" class="container">
    <div id="sidebar1">
        <div id="box1">
            <h2>Menu Laporan</h2>
            
            <div id="laporanBidan">
              <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#bidansubmenu" style="width: 250px; text-align: left;">Bidan</button>
              <div id="bidansubmenu" class="collapse" style="padding-left: 25px;">
                <p><a href=<?php echo site_url() ."/laporan/CakupanIndikatorPWS"?>>Cakupan Indikator PWS</a></p>
                <p><a href=<?php echo site_url() ."/laporan/DownloadBidanPWS"?>>Download PWS</a></p>
              </div>
            </div>
            <div id="laporanGizi">
              <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#gizisubmenu" style="width: 250px; text-align: left;">Gizi</button>
              <div id="gizisubmenu" class="collapse" style="padding-left: 25px;">
                <p><a href=<?php echo site_url() ."/laporan/StatusGizi"?>>Status Gizi</a></p>
                <p><a href=<?php echo site_url() ."/laporan/DownloadGiziPWS"?>>Download PWS</a></p>                
              </div>
            </div>
            <div id="laporanJurim">
              <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#jurimsubmenu" style="width: 250px; text-align: left;">Jurim</button>
              <div id="jurimsubmenu" class="collapse" style="padding-left: 25px;">
                <p><a href=<?php echo site_url() ."/laporan/DownloadJurimPWS"?>>Download PWS</a></p>
              </div>
            </div>
            
        </div>
    </div>