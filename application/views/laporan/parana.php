<div id="content">
    <div id="text" style="text-align: center;">
        <h3>Cakupan Indikator KARANA</h3>
    </div>
    <br/>
    <br>
    <div>
        <form class="form" action="<?php echo site_url()."laporan/karana/".$this->uri->segment(3)?>" method="get">
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
            <?php }else{ ?>
            <select name="bulan" class="form-control-static">
                <option value="januari" <?=$bulan=='januari'?"selected":""?>>Januari</option>
                <option value="februari" <?=$bulan=='februari'?"selected":""?>>Februari</option>
                <option value="maret" <?=$bulan=='maret'?"selected":""?>>Maret</option>
                <option value="april" <?=$bulan=='april'?"selected":""?>>April</option>
                <option value="mei" <?=$bulan=='mei'?"selected":""?>>Mei</option>
                <option value="juni" <?=$bulan=='juni'?"selected":""?>>Juni</option>
                <option value="juli" <?=$bulan=='juli'?"selected":""?>>Juli</option>
                <option value="agustus" <?=$bulan=='agustus'?"selected":""?>>Agustus</option>
                <option value="september" <?=$bulan=='september'?"selected":""?>>September</option>
                <option value="oktober" <?=$bulan=='oktober'?"selected":""?>>Oktober</option>
                <option value="november" <?=$bulan=='november'?"selected":""?>>November</option>
                <option value="desember" <?=$bulan=='desember'?"selected":""?>>Desember</option>
            </select>
            <?php } ?>
            <button class="form-control-static">GO</button>
        </form>
    </div>
    <br/>
    <br/>
    <div id="container" style="text-align: center;">
        <?php foreach($xlsForm as $form){ ?>
        <div title="<?=$form['page']?>">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3><?=$form['title']?> - <?=str_replace("_",' ',$mode)?></h3>
                <div id="<?=$form['page']?>" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <?php } ?>
    </div>
</div>
<script src="<?=base_url()?>assets/js/highcharts.js"></script>
<script src="<?=base_url()?>assets/js/modules/exporting.js"></script>
<script src="<?=base_url()?>assets/js/functions.js"></script>
<script>
    var json = <?=json_encode($xlsForm)?>;
    <?php if($mode=="semua_bulan"){ ?>
    $.fn.showChartStack4(json);
    <?php }else{ ?>
    $.fn.showChart(json);    
    <?php } ?>
</script>