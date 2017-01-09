<div id="content">
    <div id="text" style="text-align: center;">
        <h3>HEART SCORE</h3>
    </div>
    <br/>
    <br>
    <div>
        <form class="form" action="<?php echo site_url()."hhhscore/heartscore"?>" method="get">
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
        <div title="tekanan darah trimester 2">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>ANC Komplit - HRP</h3>
                <div id="ANC" align="center">
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
                <h3>PNC Komplit - HRPP</h3>
                <div id="PNC" align="center">
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
                <h3>Pemberian Hb</h3>
                <div id="Hb" align="center">
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
                <h3>Kunjungan PNC/Rumah</h3>
                <div id="KPNC" align="center">
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
                <h3>Pengisian Rencana Persalinan</h3>
                <div id="PRP" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        <br/>
        <br/>
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