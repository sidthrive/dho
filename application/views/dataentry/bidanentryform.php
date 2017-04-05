    <div id="content">
        <div id="text" style="text-align: center;">
            <h3>Total Entri tiap Form</h3>
            <h3><?=$kecamatan?></h3>
        </div><br><br>
        <div>
            <span>Tampilkan Berdasarkan : </span><select id="date">
                <option id="subdate" value="subdate"<?=$datemode=="subdate"?" selected":""?>>Submission Date</option>
                <option id="visdate" value="visdate"<?=$datemode=="visdate"?" selected":""?>>Visit Date</option>
            </select>
        </div><br><br>
        <div>
            <form class="form" action="<?php echo site_url()."dataentry/bidanbyform/".$kecamatan?>" method="get">
                <label class="col-sm-2 control-label">Periode: </label>
                <input type="date" name="start" class="form-control-static" value="<?=$start?>"/>
                <input type="date" name="end" class="form-control-static" value="<?=$end?>"/>
                <input type="hidden" name="by" class="form-control-static" value="<?=$datemode?>"/>
                <button class="form-control-static">GO</button>
            </form>
            <form class="form" action="<?php echo site_url()."dataentry/downloadbidanbyform/".$kecamatan?>" method="post">
                <input type="hidden" name="start" class="form-control-static" value="<?=$start?>"/>
                <input type="hidden" name="end" class="form-control-static" value="<?=$end?>"/>
                <input type="hidden" name="by" class="form-control-static" value="<?=$datemode?>"/>
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
    var datemode = $( "#date option:selected" ).attr("id");
    $( "#date" ).change(function() {
        $( "#date option:selected" ).each(function() {
            var newmode = $( "#date option:selected" ).attr("id");
            if(datemode!=newmode){
                if(newmode=="subdate"){
                    window.location.href = "<?=base_url()."dataentry/bidanbyform/".$kecamatan."?start=".$start."&end=".$end."&by=subdate"?>";
                }else if(newmode=="visdate"){
                    window.location.href = "<?=base_url()."dataentry/bidanbyform/".$kecamatan."?start=".$start."&end=".$end."&by=visdate"?>";
                }
            }
        });    
    }).trigger( "change" );
</script>