<div id="container" style="padding-left: 280px;text-align: center;">
    <div title="tekanan darah trimester 2">
        <div id="">
            <!-- START Script Block for Chart -->
            <h3>ANC Komplit - HRP</h3>
            <div id="ANC" align="center">
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
            <h3>PNC Komplit - HRPP</h3>
            <div id="PNC" align="center">
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
            <h3>Pemberian Hb</h3>
            <div id="Hb" align="center">
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
            <h3>Kunjungan PNC/Rumah</h3>
            <div id="KPNC" align="center">
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
            <h3>Pengisian Rencana Persalinan</h3>
            <div id="PRP" align="center">
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