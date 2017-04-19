<div id="content">
    <div id="text" style="text-align: center;">
        <h3>Cakupan Indikator MMN</h3>
    </div>
    <br/>
    <br>
    <div>
        <form class="form" action="<?php echo site_url()."laporan/gen/".$this->uri->segment(3)?>" method="get">
            <label class="col-sm-2 control-label">Periode: </label>
            <select name="mode" class="form-control-static">
                <option value="bulan_ini" <?=$mode=="bulan_ini"?"selected":""?>>Bulan Ini</option>
                <option value="akumulatif" <?=$mode=="akumulatif"?"selected":""?>>Akumulatif</option>
                <option value="semua_bulan" <?=$mode=="semua_bulan"?"selected":""?>>Semua Bulan</option>
            </select>
            <?php if($mode=="semua_bulan"){ ?>
            <select name="desa" class="form-control-static">
                <?php foreach($desas as $ds){ ?>
                <option value="<?=$ds?>" <?=$desa==$ds?"selected":""?>><?=$ds?></option>
                <?php } ?>
            </select>
            <?php } ?>
            <button class="form-control-static">GO</button>
        </form>
    </div>
    <br/>
    <br/>
    <div id="container" style="text-align: center;">
        <div title="MMN">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Jumlah Ibu yang menerima MMN - <?=str_replace("_",' ',$mode)?></h3>
                <div id="mmn" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>

    </div>
</div>
<script src="<?=base_url()?>assets/js/highcharts.js"></script>
<script src="<?=base_url()?>assets/js/modules/exporting.js"></script>
<script src="<?=base_url()?>assets/js/functions.js"></script>
<script>
    var json = <?=json_encode($xlsForm)?>;
    $.fn.showChart(json);
</script>