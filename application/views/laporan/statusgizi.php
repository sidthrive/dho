<div id="content">
    <div id="text" style="text-align: center;">
        <h3>Cakupan Gizi</h3>
    </div>
    <br/>
    <br>
    <div>
        <form class="form" action="<?php echo site_url()."laporan/cakupangizi"?>" method="get">
            <label class="col-sm-2 control-label">Periode: </label>
            <select name="b" class="form-control-static">
                <option value="januari" <?=$bulan=="januari"?"selected":""?>>Januari</option>
                <option value="februari" <?=$bulan=="februari"?"selected":""?>>Februari</option>
                <option value="maret" <?=$bulan=="maret"?"selected":""?>>Maret</option>
                <option value="april" <?=$bulan=="april"?"selected":""?>>April</option>
                <option value="mei" <?=$bulan=="mei"?"selected":""?>>Mei</option>
                <option value="juni" <?=$bulan=="juni"?"selected":""?>>Juni</option>
                <option value="juli" <?=$bulan=="juli"?"selected":""?>>Juli</option>
                <option value="agustus" <?=$bulan=="agustus"?"selected":""?>>Agustus</option>
                <option value="september" <?=$bulan=="september"?"selected":""?>>September</option>
                <option value="oktober" <?=$bulan=="oktober"?"selected":""?>>Oktober</option>
                <option value="november" <?=$bulan=="november"?"selected":""?>>November</option>
                <option value="desember" <?=$bulan=="desember"?"selected":""?>>Desember</option>
            </select>
            <select name="t" class="form-control-static">
                <?php 
                $thn = date("Y");
                while($thn >= 2015){ ?>
                <option <?=$tahun==$thn?"selected":""?>><?=$thn?></option>
                <?php $thn--;} ?>
            </select>
            <button class="form-control-static">GO</button>
        </form>
    </div>
    <br/>
    <br/>
    <div id="container" style="text-align: center;">
        <div title="Cakupan D/S Balita (0-59 Bln)">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan D/S Balita (0-59 Bln)</h3>
                <div id="ds" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Cakupan N/D">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan N/D</h3>
                <div id="nd" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Cakupan BGM">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan BGM/D</h3>
                <div id="bgmd" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Cakupan Vit A Nifas">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan Vit A Nifas Kumulatif</h3>
                <div id="vitA" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Cakupan Fe Nifas">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan Fe Nifas Kumulatif</h3>
                <div id="vitfe" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Cakupan Anemia Bumil">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan Anemia Bumil Kumulatif</h3>
                <div id="anemia" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Cakupan Bumil KEK">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan Bumil KEK Kumulatif</h3>
                <div id="kek" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Cakupan Kasus Gizi Buruk">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan Kasus Gizi Buruk (BB/U)</h3>
                <div id="gibur" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Cakupan Fe 1">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan Fe 1 Kumulatif</h3>
                <div id="fe1" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Cakupan Fe 3">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan Fe 3 Kumulatif</h3>
                <div id="fe3" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Cakupan ASI Eksklusif">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan ASI Eksklusif</h3>
                <div id="asi" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Jumlah BBLR">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Jumlah BBLR</h3>
                <div id="bblr" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
    </div>
</div>
<script src="<?=base_url()?>assets/js/highcharts.js"></script>
<script src="<?=base_url()?>assets/js/modules/exporting.js"></script>
<script src="<?=base_url()?>assets/js/functions.js"></script>
<script>
    var json = <?=json_encode($xlsForm)?>;
    $.fn.showChart(json);
</script>