    <div id="content">
        <br>
        <div id="text" style="text-align: center;">
            <h3>Total View tiap Tanggal</h3>
            <h3>User</h3>
        </div>
        <div id="container">
            <!--
                graphic container
            -->
            <?php foreach($data as $user => $form){
            ?>
            <br>
            <div title="User <?=ucwords($user)?>">
                    <div id="">
                        <center><span style="font-size:16px; font-family:'Droid Sans',Arial,Verdana,sans-serif;"><strong>User: <?=ucwords($user)?></strong>
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
    var url = "<?=base_url()?>siteanalytics/getdatabyview/";
    var json = <?=json_encode($data)?>;
    $.fn.showChartDataEntryTanggalDrill(json,url);
</script>