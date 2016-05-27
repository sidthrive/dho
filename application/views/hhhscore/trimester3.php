<div id="content">
    <div id="text" style="text-align: center;">
        <h3>QCI</h3>
        <h3>Trimester 3</h3>
    </div>
    <br/>
    <br/>
    <br/>
    <div id="container" style="text-align: center;">
        <div title="tekanan darah trimester 3">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Pemeriksaan Tekanan Darah</h3>
                <div id="TDT3" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="berat badan trimester 3">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Pemeriksaan Berat Badan</h3>
                <div id="BBT3" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>

    </div>
</div>

<script src="<?=base_url()?>assets/js/highcharts.js"></script>
<script src="<?=base_url()?>assets/js/exporting.js"></script>
<script src="<?=base_url()?>assets/js/functions.js"></script>
<script>
    
    
    var json = <?=json_encode($xlsForm)?>;
    $.fn.showChart(json);    
     
        
</script>