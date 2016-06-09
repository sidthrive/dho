<?php
    if($this->uri->segment(4)=="Mingguan"){
        $opt = "Minggu";
    }elseif($this->uri->segment(4)=="Bulanan"){
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
        <div>
            <?php 
                $json = file_get_contents(base_url()."assets/location.json");
		$obj = json_decode($json);
                var_dump($obj);
            ?>
        </div>
    </div>

<script src="<?=base_url()?>assets/js/highcharts.js"></script>
<script src="<?=base_url()?>assets/js/exporting.js"></script>
<script src="<?=base_url()?>assets/js/functions.js"></script>
<script>
    var json = <?=json_encode($data)?>;
    <?php 
    if(isset($mode)){
        if($mode=='Mingguan'){
            echo '$.fn.showChartDataEntryMinggu(json);';
        }else{
            echo '$.fn.showChartDataEntryBulan(json);';
        }
    }else{
        echo '$.fn.showChartDataEntryTanggal(json);';
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
                window.location.href = "<?=base_url()."dataentry/bidanbytanggal/".$kecamatan?>"+modeurl;
            }
            console.log($( "select option:selected" ).attr("id"));
        });    
    }).trigger( "change" );
</script>