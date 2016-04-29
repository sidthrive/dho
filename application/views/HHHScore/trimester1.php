<div id="text" style="text-align: center;">
    <h3>QCI</h3>
    <h3>Trimester 1</h3>
</div>
<br/>
<br/>
    
<div id="container" style="padding-left:280px;text-align: center;">
    <div title="tekanan darah trimester 1">
        <div id="">
            <!-- START Script Block for Chart -->
            <h3>Pemeriksaan Tekanan Darah</h3>
            <div id="TDT1" align="center">
            </div>

            <!-- END Script Block for Chart -->                
        </div>
    </div>
    <br/>
    <br/>
    <div title="berat badan trimester 1">
        <div id="">
            <!-- START Script Block for Chart -->
            <h3>Pemeriksaan Berat Badan</h3>
            <div id="BBT1" align="center">
            </div>

            <!-- END Script Block for Chart -->                
        </div>
    </div>
    <br/>
    <br/>
    <div title="lingkar kepala trimester 1">
        <div id="">
            <!-- START Script Block for Chart -->
            <h3>Pemeriksaan LILA</h3>
            <div id="LIKAT1" align="center">
            </div>

            <!-- END Script Block for Chart -->                
        </div>
    </div>
    <br/>
    <br/>
    <div title="pemeriksaan hb trimester 1">
        <div id="">
            <!-- START Script Block for Chart -->
            <h3>Pemeriksaan Hb</h3>
            <div id="HBT1" align="center">
            </div>

            <!-- END Script Block for Chart -->                
        </div>
    </div>
    <br/>
    <br/>
    <div title="golongan darah trimester 1">
        <div id="">
            <!-- START Script Block for Chart -->
            <h3>Pemeriksaan Golongan Darah</h3>
            <div id="GOLDART1" align="center">
            </div>

            <!-- END Script Block for Chart -->                
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