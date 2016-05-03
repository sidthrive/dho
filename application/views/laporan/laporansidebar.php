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
                <div id="bidan_menu" class="panel-collapse collapse<?=($this->uri->segment(2)=='cakupanindikatorpws'||$this->uri->segment(2)=='downloadbidanpws')?' in':''?>">
                    <div class="panel panel-default">
                        <div class="panel-heading"<?=($this->uri->segment(2)=='cakupanindikatorpws')?' style="background-color:#909090"':''?>>
                            <h4 class="panel-title">
                                <a href="<?php echo site_url() ."laporan/cakupanindikatorpws"?>">Cakupan Indikator PWS</a>
                            </h4>
                        </div>
                        <div class="panel-heading"<?=($this->uri->segment(2)=='downloadbidanpws')?' style="background-color:#909090"':''?>>
                            <h4 class="panel-title">
                                <a href="<?php echo site_url() ."laporan/downloadbidanpws"?>">Download PWS</a>
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
                <div id="collapse2" class="panel-collapse collapse<?=($this->uri->segment(2)=='statusgizi'||$this->uri->segment(2)=='downloadgizipws')?' in':''?>">
                    <div class="panel panel-default">
                        <div class="panel-heading"<?=($this->uri->segment(2)=='statusgizi')?' style="background-color:#909090"':''?>>
                            <h4 class="panel-title">
                                <a href="<?php echo site_url() ."laporan/statusgizi"?>">Status Gizi</a>
                            </h4>
                        </div>
                        <div class="panel-heading"<?=($this->uri->segment(2)=='downloadgizipws')?' style="background-color:#909090"':''?>>
                            <h4 class="panel-title">
                                <a href="<?php echo site_url() ."laporan/downloadgizipws"?>">Download PWS</a>
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
                <div id="collapse3" class="panel-collapse collapse<?=$this->uri->segment(2)=='downloadjurimpws'?' in':''?>">
                    <div class="panel panel-default">
                        <div class="panel-heading"<?=($this->uri->segment(2)=='downloadjurimpws')?' style="background-color:#909090"':''?>>
                            <h4 class="panel-title">
                                <a href="<?php echo site_url() ."laporan/downloadjurimpws"?>">Download PWS</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>