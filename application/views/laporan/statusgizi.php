<div id="content">
    <div id="text" style="text-align: center;">
        <h3>Cakupan Gizi</h3>
    </div>
    <br/>
    <br/>
    <br/>
    <div id="container" style="text-align: center;">
        <div title="K1 Akses">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan D/S Balita (0-59 Bln)</h3>
                <div id="ds" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="K4">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan N/D</h3>
                <div id="nd" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Maternal Tertangani">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan BGM/D</h3>
                <div id="bgmd" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Persalinan dengan Fasilitas Kesehatan">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan Vit/Fe Nifas </h3>
                <div id="vitfe" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Persalinan dengan Tenaga Kesehatan">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan Anemia Bumil</h3>
                <div id="anemia" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Kunjungan Nifas">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan Bumil KEK</h3>
                <div id="kek" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Kunjungan Neonatal 1">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan Kasus Gizi Buruk</h3>
                <div id="gibur" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Kunjungan Neonatal 3">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan Fe 1 & Fe 3</h3>
                <div id="fe13" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Kematian Maternal">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan ASI Eksklusif</h3>
                <div id="asi" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Kematian Neonatal">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Persentase BBLR</h3>
                <div id="bblr" align="center">
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