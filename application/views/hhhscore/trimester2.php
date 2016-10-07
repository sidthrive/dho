<div id="content">
    <div id="text" style="text-align: center;">
        <h3>QCI</h3>
        <h3>Trimester 2</h3>
    </div>
    <br/>
    <br/>
    <div>
        <form class="form" action="<?php echo site_url()."hhhscore/bidantrimester2"?>" method="get">
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
                <option>2016</option>
                <option>2015</option>
            </select>
            <button class="form-control-static">GO</button>
        </form>
    </div>
    <br/>
    <br/>

    <div id="container" style="text-align: center;">
        <div title="tekanan darah trimester 2">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Pemeriksaan Tekanan Darah</h3>
                <div id="TDT2" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <br/>
        <div title="berat badan trimester 2">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Pemeriksaan Berat Badan</h3>
                <div id="BBT2" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <br/>
        <div title="lingkar kepala trimester 2">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Pemeriksaan Tinggi Fundus Uterus</h3>
                <div id="TFUT2" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <br/>
        <div title="Pres Janin trimester 2">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Pemeriksaan Persentase Janin</h3>
                <div id="PJT2" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <br/>
        <div title="DJJ trimester 2">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Pemeriksaan Denyut Jantung Janin</h3>
                <div id="DJJT2" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        <br/>
        <br/>
        </div>

    </div>
</div>

<script src="<?=base_url()?>assets/js/highcharts.js"></script>
<script src="<?=base_url()?>assets/js/exporting.js"></script>
<script src="<?=base_url()?>assets/js/functions.js"></script>
<script>
    
    
    var json = <?=json_encode($xlsForm)?>;
    $.fn.showChart(json);    
     
        
</script>