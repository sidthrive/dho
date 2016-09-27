<div id="content">
    <div id="text" style="text-align: center;">
        <h3>Cakupan Imunisasi</h3>
        <h3><?=$header?></h3>
        <?=$this->uri->segment(3)=="tahuninivstahunlalu"?"<h3>".$this->uri->segment(4)."</h3>":""?>
    </div>
    <br/>
    <br/>
    <br/>
    <div id="container" style="text-align: center;">
        <div title="HB0">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>HB0</h3>
                <div id="hb0" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="bcg">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>BCG</h3>
                <div id="bcg" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="polio1">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>POLIO 1</h3>
                <div id="polio1" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="DPTHB1">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>DPT/HB (1)</h3>
                <div id="dpthb1" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="polio2">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>POLIO 2</h3>
                <div id="polio2" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="DPTHB2">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>DPT/HB (2)</h3>
                <div id="dpthb2" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="POLIO3">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>POLIO 3</h3>
                <div id="polio3" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="DPTHB3">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>DPT/HB (3)</h3>
                <div id="dpthb3" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="POLIO4">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>POLIO 4</h3>
                <div id="polio4" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="CAMPAK">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>CAMPAK</h3>
                <div id="campak" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="IMUNISASI LENGKAP">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>IMUNISASI LENGKAP</h3>
                <div id="imunisasi" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="BOOSTER CAMPAK">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>BOOSTER CAMPAK</h3>
                <div id="booster_campak" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="TT1">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>TT1</h3>
                <div id="tt1" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="TT2">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>TT2</h3>
                <div id="tt2" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="TT3">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>TT3</h3>
                <div id="tt3" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="TT4">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>TT4</h3>
                <div id="tt4" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="TT5">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>TT5</h3>
                <div id="tt5" align="center">
                </div>

                <!-- END Script Block for Chart -->                
            </div>
        </div>
        <br/>
        <br/>
        <div title="CAKUPAN DESA UCI">
            <div id="">
                <!-- START Script Block for Chart -->
                <h3>CAKUPAN DESA UCI</h3>
                <div id="uci" align="center">
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
    <?php if($this->uri->segment(3)=="bulaninivsbulanlalu"||$this->uri->segment(3)=="tahuninivstahunlalu"){ ?>
    $.fn.showChartStackDouble(json);
    <?php }else{ ?>
    $.fn.showChartStack(json);    
    <?php } ?>
</script>