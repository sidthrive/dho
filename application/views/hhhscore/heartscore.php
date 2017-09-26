<div id="content">
    <div id="text" style="text-align: center;">
        <h3>HEART SCORE</h3>
    </div>
    <br/>
    <br>
    <div>
        <form class="form" action="<?php echo site_url()."hhhscore/heartscore"?>" method="get">
            <label class="col-sm-2 control-label">Periode: </label>
            <input type="date" name="start" class="form-control-static" value="<?=$start?>"/>
            <input type="date" name="end" class="form-control-static" value="<?=$end?>"/>
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
                <h3><?=$form['title']?></h3>
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
    $.fn.showChart(json);    
     
        
</script>