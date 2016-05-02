<div id="content">
    <div id="text" style="text-align: center;">

        <h3>Cakupan (Standard & Non)</h3>
    </div>
    <br/>
    <br/>
    <br/>
    <div id="container" style="text-align: center;">
        <div title="ANC 1 Standard Coverage">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan ANC 1 Standar</h3>
                <div id="ANC1SC" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <br/>
        <div title="ANC 1 Nonstandard Coverage">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan ANC 1 Non-standar</h3>
                <div id="ANC1NC" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <br/>
        <div title="ANC 4 Standard Coverage">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan ANC 4 Standar</h3>
                <div id="ANC4SC" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <br/>
        <div title="ANC 4 Nonstandard Coverage">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan ANC 4 Non-standar</h3>
                <div id="ANC4NC" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <br/>
        <div title="Birth Coverage">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan kelahiran</h3>
                <div id="BC" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <br/>
        <div title="PNC Coverage">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan PNC</h3>
                <div id="PNCC" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
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