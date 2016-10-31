    <div id="content">
        <div id="text" style="text-align: center;">
            <h3>Total Entri tiap Form</h3>
            <h3>Puskesmas <?=$kecamatan?></h3>
        </div><br><br>
        <div>
            <form class="form" action="<?php echo site_url()."dataentry/bidanbyform/".$kecamatan?>" method="get">
                <label class="col-sm-2 control-label">Periode: </label>
                <input type="date" name="start" class="form-control-static" value="<?=$start?>"/>
                <input type="date" name="end" class="form-control-static" value="<?=$end?>"/>
                <button class="form-control-static">GO</button>
            </form>
            <form class="form" action="<?php echo site_url()."dataentry/downloadbidanbyform/".$kecamatan?>" method="post">
                <input type="hidden" name="start" class="form-control-static" value="<?=$start?>"/>
                <input type="hidden" name="end" class="form-control-static" value="<?=$end?>"/>
                <input type="hidden" name="old" class="form-control-static" value="<?=$this->input->get('old')==null?"no":"yes"?>"/>
                <button class="form-control-static" style="float: right">DOWNLOAD</button>
            </form>
        </div><br><br>
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
<script src="<?=base_url()?>assets/js/modules/exporting.js"></script>
<script src="<?=base_url()?>assets/js/functions.js"></script>
<script>
    var json = <?=json_encode($data)?>;
    $.fn.showChartDataEntryForm(json);
</script>