<div id="page" class="container">
    <div id="sidebar1">
        <h2>Menu Laporan</h2>
        <div class="panel-group" id="accordion">
            <div class="panel panel-default" id="bidans">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#bidan_menu">Bidan</a>
                    </h4>
                </div>
                <div id="bidan_menu" class="panel-collapse collapse<?=($this->uri->segment(2)=='bidanbyform'||$this->uri->segment(2)=='bidanbytanggal')?' in':''?>">
                    <div class="panel panel-default" <?=($this->uri->segment(2)=='bidanbyform')?' style="background-color:#909090"':''?>>
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-parent="#bidans" href="<?php echo site_url() ."dataentry/bidanbyform"?>">Total Entry Tiap From</a>
                            </h4>
                        </div>
                    </div>
                    <div class="panel panel-default" <?=($this->uri->segment(2)=='bidanbytanggal')?' style="background-color:#909090"':''?>>
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-parent="#bidans" href="<?php echo site_url() ."dataentry/bidanbytanggal"?>">Total Entry Tiap Tanggal</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Gizi</a>
                    </h4>
                </div>
                <div id="collapse2" class="panel-collapse collapse<?=$this->uri->segment(2)=='gizi'?' in':''?>">
                    <div class="panel panel-default">
                        <div class="panel-heading"<?=($this->uri->segment(2)=='gizi'&&$this->uri->segment(3)=='Sengkol')?' style="background-color:#909090"':''?>>
                            <h4 class="panel-title">
                                <a href="<?php echo site_url() ."dataentry/gizi/Sengkol"?>">Kecamatan Sengkol</a>
                            </h4>
                        </div>
                        <div class="panel-heading"<?=($this->uri->segment(2)=='gizi'&&$this->uri->segment(3)=='Janapria')?' style="background-color:#909090"':''?>>
                            <h4 class="panel-title">
                                <a href="<?php echo site_url() ."dataentry/gizi/Janapria"?>">Kecamatan Janapria</a>
                            </h4>
                        </div>
                    </div>
                </div>
                    
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Jurim</a>
                    </h4>
                </div>
                <div id="collapse3" class="panel-collapse collapse<?=$this->uri->segment(2)=='jurim'?' in':''?>">
                    <div class="panel panel-default">
                        <div class="panel-heading"<?=($this->uri->segment(2)=='jurim'&&$this->uri->segment(3)=='Sengkol')?' style="background-color:#909090"':''?>>
                            <h4 class="panel-title">
                                <a href="<?php echo site_url() ."dataentry/Jurim/Sengkol"?>">Kecamatan Sengkol</a>
                            </h4>
                        </div>
                        <div class="panel-heading"<?=($this->uri->segment(2)=='jurim'&&$this->uri->segment(3)=='Janapria')?' style="background-color:#909090"':''?>>
                            <h4 class="panel-title">
                                <a href="<?php echo site_url() ."dataentry/Jurim/Janapria"?>">Kecamatan Janapria</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>