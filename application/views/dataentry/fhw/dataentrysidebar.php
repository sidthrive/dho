<div id="page" class="container">
    <div id="mini-submenu">
        <div>
            <i class="glyphicon glyphicon-play"></i>
        </div>
    </div>
    <div id="sidebar1">
        <h2>Menu Laporan<span class="pull-right" id="slide-submenu">
                <i class="glyphicon glyphicon-remove-sign"></i>
            </span></h2>
        <div class="panel-group" id="accordion">
            <?php if($this->session->userdata('tipe')=="bidan"||$this->session->userdata('tipe')=="all"){ ?>
            <div class="panel panel-default" id="bidans">
                <a data-toggle="collapse" data-parent="#accordion" href="#bidan_menu">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Bidan
                    </h4>
                </div>
                </a>
                <div id="bidan_menu" class="panel-collapse collapse<?=($this->uri->segment(2)=='bidanbyform'||$this->uri->segment(2)=='bidanbytanggal')?' in':''?>">
                    <div class="panel panel-default" <?=($this->uri->segment(2)=='bidanbyform')?' style="background-color:#909090"':''?>>
                        <a data-parent="#bidans" href="<?php echo site_url() ."dataentry/bidanbyform"?>">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                Total Entry Tiap From
                            </h4>
                        </div>
                        </a>
                    </div>
                    <div class="panel panel-default" <?=($this->uri->segment(2)=='bidanbytanggal')?' style="background-color:#909090"':''?>>
                        <a data-parent="#bidans" href="<?php echo site_url() ."dataentry/bidanbytanggal"?>">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                Total Entry Tiap Tanggal
                            </h4>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php if($this->session->userdata('tipe')=="bidan"||$this->session->userdata('tipe')=="all"){ ?>
            <div class="panel panel-default" id="sdidtks">
                <a data-toggle="collapse" data-parent="#accordion" href="#sdidtk_menu">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        ECD
                    </h4>
                </div>
                </a>
                <div id="sdidtk_menu" class="panel-collapse collapse<?=($this->uri->segment(2)=='sdidtkbyform'||$this->uri->segment(2)=='sdidtkbytanggal')?' in':''?>">
                    <div class="panel panel-default" <?=($this->uri->segment(2)=='sdidtkbyform')?' style="background-color:#909090"':''?>>
                        <a data-parent="#sdidtks" href="<?php echo site_url() ."dataentry/sdidtkbyform"?>">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                Total Entry Tiap From
                            </h4>
                        </div>
                        </a>
                    </div>
                    <div class="panel panel-default" <?=($this->uri->segment(2)=='sdidtkbytanggal')?' style="background-color:#909090"':''?>>
                        <a data-parent="#sdidtks" href="<?php echo site_url() ."dataentry/sdidtkbytanggal"?>">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                Total Entry Tiap Tanggal
                            </h4>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>