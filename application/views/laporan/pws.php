<div id="content">
    <div id="text" style="text-align: center;">
        <h3>Cakupan Indikator PWS</h3>
    </div>
    <br/>
    <br/>
    <br/>
    <div id="container" style="text-align: center;">
        <div title="K1 Akses">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Akses Ibu Hamil (K1)</h3>
                <div id="K1A" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="K4">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Cakupan Ibu Hamil (K4)</h3>
                <div id="K4" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Maternal Tertangani">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Maternal Tertangani</h3>
                <div id="MT" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Persalinan dengan Fasilitas Kesehatan">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Persalinan dengan Fasilitas Kesehatan</h3>
                <div id="PDFK" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Persalinan dengan Tenaga Kesehatan">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Persalinan dengan Tenaga Kesehatan</h3>
                <div id="PDTK" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Kunjungan Nifas">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Kunjungan Nifas</h3>
                <div id="KN" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Kunjungan Neonatal 1">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Kunjungan Neonatal 1</h3>
                <div id="KNN1" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Kunjungan Neonatal 3">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Kunjungan Neonatal 3</h3>
                <div id="KNN3" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Kematian Maternal">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Kematian Maternal</h3>
                <div id="KM" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Kematian Neonatal">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Kematian Neonatal</h3>
                <div id="KNN" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Kematian Bayi">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Kematian Bayi</h3>
                <div id="KB" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="Kematian Balita">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>Kematian Balita</h3>
                <div id="KBLT" align="center">
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