<?php
    if($mode=="Mingguan"){
        $opt = "Minggu";
    }elseif($mode=="Bulanan"){
        $opt = "Bulan";
    }else{
        $opt = "Tanggal";
    }
    
?>    
    <div id="content">
        <div id="text">
            Tampilkan Berdasarkan : <select>
                <option id="tgl" value=""<?=$opt=="Tanggal"?" selected":""?>>Tanggal</option>
                <option id="mng" value="Mingguan"<?=$opt=="Minggu"?" selected":""?>>Minggu</option>
                <option id="bln" value="Bulanan"<?=$opt=="Bulan"?" selected":""?>>Bulan</option>
            </select>
        </div>
        <br>
        <br>
        <div>
            <form class="form" action="<?php echo site_url()."dataentry/vaksinatorbytanggal/".$kecamatan?>" method="get">
                <label class="col-sm-2 control-label">Periode: </label>
                <input type="date" name="start" class="form-control-static" value="<?=$start?>"/>
                <input type="date" name="end" class="form-control-static" value="<?=$end?>"/>
                <button class="form-control-static">GO</button>
            </form>
        </div>
        <br>
        <div id="text" style="text-align: center;">
            <h3>Total Entri tiap <?=$opt?></h3>
            <h3>Puskesmas <?=$kecamatan?></h3>
        </div>
        <div id="container">
            <!--
                graphic container
            -->
            <?php foreach($data as $user => $form){
            ?>
            <br>
            <div title="Desa <?=ucwords($user)?>">
                    <div id="">
                        <center><span style="font-size:16px; font-family:'Droid Sans',Arial,Verdana,sans-serif;"><strong>Desa <?=ucwords($user)?></strong>
                        <!-- START Script Block for Chart -->
                        <div id="<?=str_replace(' ', '_', $user);?>" align="center">
                        </div>
                        <!-- END Script Block for Chart -->                
                    </div>
                </div>
            <br><br>
            <?php
            }
            ?>
        </div>
    </div>

<script src="<?=base_url()?>assets/js/highcharts.js"></script>
<script src="<?=base_url()?>assets/js/modules/data.js"></script>
<script src="<?=base_url()?>assets/js/modules/drilldown.js"></script>
<script src="<?=base_url()?>assets/js/modules/exporting.js"></script>
<script src="<?=base_url()?>assets/js/functions.js"></script>
<script>
    var url = "<?=base_url()?>dataentry/getVaksinatorByForm/";
    var json = <?=json_encode($data)?>;
    <?php 
    if(isset($mode)){
        if($mode=='Mingguan'){
            echo '$.fn.showChartDataEntryMinggu(json);';
        }else{
            echo '$.fn.showChartDataEntryBulan(json);';
        }
    }else{
        echo '$.fn.showChartDataEntryTanggalDrill(json,url);';
    } ?> 
    var mode = $( "select option:selected" ).attr("id");
    $( "select" ).change(function() {
        $( "select option:selected" ).each(function() {
            var newmode = $( "select option:selected" ).attr("id");
            if(mode!=newmode){
                var modeurl = "";
                if(newmode=="mng"){
                    modeurl = "/Mingguan";
                }else if(newmode=="bln"){
                    modeurl = "/Bulanan";
                }
                window.location.href = "<?=base_url()."dataentry/vaksinatorbytanggal/".$kecamatan?>"+modeurl;
            }
            console.log($( "select option:selected" ).attr("id"));
        });    
    }).trigger( "change" );
</script>