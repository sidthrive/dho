<div id="text" style="text-align: center;">
    <h3>QCI</h3>
    <h3>Trimester 2</h3>
</div>
<br/>
<br/>
    
<div id="container" style="padding-left: 280px;text-align: center;">
    <div title="tekanan darah trimester 2">
        <div id="">
            <!-- START Script Block for Chart -->
            <h3>Pemeriksaan Tekanan Darah</h3>
            <div id="TDT2" align="center">
            </div>

            <!-- END Script Block for Chart -->                
        </div>
    </div>
    <br/>
    <br/>
    <br/>
    <div title="berat badan trimester 2">
        <div id="">
            <!-- START Script Block for Chart -->
            <h3>Pemeriksaan Berat Badan</h3>
            <div id="BBT2" align="center">
            </div>

            <!-- END Script Block for Chart -->                
        </div>
    </div>
    <br/>
    <br/>
    <br/>
    <div title="lingkar kepala trimester 2">
        <div id="">
            <!-- START Script Block for Chart -->
            <h3>Pemeriksaan Tinggi Fundus Uterus</h3>
            <div id="TFUT2" align="center">
            </div>

            <!-- END Script Block for Chart -->                
        </div>
    </div>
    <br/>
    <br/>
    <br/>
    <div title="Pres Janin trimester 2">
        <div id="">
            <!-- START Script Block for Chart -->
            <h3>Pemeriksaan Persentas Janin</h3>
            <div id="PJT2" align="center">
            </div>

            <!-- END Script Block for Chart -->                
        </div>
    </div>
    <br/>
    <br/>
    <br/>
    <div title="DJJ trimester 2">
        <div id="">
            <!-- START Script Block for Chart -->
            <h3>Pemeriksaan Denyut Jantung Janin</h3>
            <div id="DJJT2" align="center">
            </div>

            <!-- END Script Block for Chart -->                
        </div>
    <br/>
    <br/>
    </div>
    
</div>

<script src="<?=base_url()?>assets/js/highcharts.js"></script>
<script src="<?=base_url()?>assets/js/exporting.js"></script>
<script src="<?=base_url()?>assets/js/functions.js"></script>
<script>
    
    
    var json = <?=json_encode($xlsForm)?>;
    $.fn.showChart(json);    
     
        
</script>