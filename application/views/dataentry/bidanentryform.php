    <div id="content">
        <div id="text" style="text-align: center;">
            <h3>Total Entri tiap Form</h3>
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
<script src="<?=base_url()?>assets/js/modules/exporting.js"></script>
<script src="<?=base_url()?>assets/js/functions.js"></script>
<script>
    var json = <?=json_encode($data)?>;
    $.fn.showChartDataEntryForm(json);
</script>