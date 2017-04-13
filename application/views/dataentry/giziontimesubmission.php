    <div id="content">
        <div>
            <form class="form" action="<?php echo site_url()."dataentry/giziontimesubmission/".$mode?>" method="get">
                <label class="col-sm-2 control-label">Periode: </label>
                <input type="date" name="start" class="form-control-static" value="<?=$start?>"/>
                <input type="date" name="end" class="form-control-static" value="<?=$end?>"/>
                <button class="form-control-static">GO</button>
            </form>
        </div>
        <br>
        <div id="text" style="text-align: center;">
            <h3><?=$mode?> On Time Submission</h3>
        </div>
        <div id="container">
            <!--
                graphic container
            -->
            <br>
            <div title="Daily">
                    <div id="">
                        <center><span style="font-size:16px; font-family:'Droid Sans',Arial,Verdana,sans-serif;"><strong><?=ucwords($this->uri->segment(3));?> On Time</strong>
                        <!-- START Script Block for Chart -->
                        <div id="daily" align="center">
                        </div>
                        <!-- END Script Block for Chart -->                
                    </div>
                </div>
            <br><br>
            <?php foreach($data as $user => $form){
                if($user=='daily'||$user=='weekly')continue;
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
    var url = "<?=base_url()?>dataentry/getGiziByForm/";
    var json = <?=json_encode($data)?>;
    $.fn.showChartDataEntryTanggal(json,url);
</script>