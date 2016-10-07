<div id="content">
    <div id="text" style="text-align: center;">

        <h3>Cakupan (Standard & Non)</h3>
    </div>
    <br/>
    <br>
    <div>
        <form class="form" action="<?php echo site_url()."hhhscore/standar"?>" method="get">
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
        <div title="ANC 1 Standard Coverage">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan ANC 1 Standar</h3>
                <div id="ANC1SC" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <br/>
        <div title="ANC 1 Nonstandard Coverage">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan ANC 1 Non-standar</h3>
                <div id="ANC1NC" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <br/>
        <div title="ANC 4 Standard Coverage">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan ANC 4 Standar</h3>
                <div id="ANC4SC" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <br/>
        <div title="ANC 4 Nonstandard Coverage">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan ANC 4 Non-standar</h3>
                <div id="ANC4NC" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <br/>
        <div title="Birth Coverage">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan kelahiran</h3>
                <div id="BC" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <br/>
        <div title="PNC Coverage">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan PNC</h3>
                <div id="PNCC" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
    </div>
</div>

<script src="<?=base_url()?>assets/js/highcharts.js"></script>
<script src="<?=base_url()?>assets/js/exporting.js"></script>
<script src="<?=base_url()?>assets/js/functions.js"></script>
<script>
    
    
    var json = <?=json_encode($xlsForm)?>;
    $.fn.showChart(json);    
     
        
</script>