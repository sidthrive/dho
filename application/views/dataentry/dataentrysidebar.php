<div id="page" class="container">
    <div id="mini-submenu">
        <div>
            <i class="glyphicon glyphicon-play"></i>
        </div>
    </div>
    <div id="sidebar1">
        <h2>Menu Laporan
            <span class="pull-right" id="slide-submenu">
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
                <div id="bidan_menu" class="panel-collapse collapse<?=($this->uri->segment(2)=='bidanbyform'||$this->uri->segment(2)=='bidanbytanggal'||$this->uri->segment(2)=='bidanontimesubmission')?' in':''?>">
                    <div class="panel-group" id="accordion2" style="padding-left: 30px;margin-bottom: 0;">
                        <div class="panel panel-default">
                            <a data-toggle="collapse" data-parent="#accordion2" href="#by_form">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    Total Entry Tiap From
                                </h4>
                            </div>
                            </a>
                            <div id="by_form" class="panel-collapse collapse<?=$this->uri->segment(2)=='bidanbyform'?' in':''?>">
                                <?php
                                foreach($location as $kec=>$desas){
                                ?>
                                <div class="panel panel-default panel-collapse">
                                    <a data-parent="#bidan_menu" href="<?php echo site_url() ."dataentry/bidanbyform/".$kec?>">
                                    <div <?=($this->uri->segment(2)=='bidanbyform'&&$this->uri->segment(3)==$kec)?' style="background-color:#909090"':''?> class="panel-heading">
                                        <h4 class="panel-title">
                                            Puskesmas <?=$kec?>
                                        </h4>
                                    </div>
                                    </a>
                                    <?php if($this->uri->segment(2)=='bidanbyform'&&$this->uri->segment(3)==$kec){ ?>
                                    <div class="panel panel-default">
                                        <?php foreach($desas as $user => $desa){
                                        ?>
                                        <a data-parent="#bidan_menu" href="<?php echo site_url() ."dataentry/bidanbyform/".$kec."/".ucwords($desa)?>">
                                        <div class="panel-heading" <?=($this->uri->segment(4)==ucwords(str_replace(' ','%20',$desa)))?' style="background-color:#909090"':''?>>
                                            <h4 class="panel-title">
                                                Desa <?=ucwords($desa)?>
                                            </h4>
                                        </div>
                                        </a>
                                        <?php }?>
                                    </div>
                                    <?php }?>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <a data-toggle="collapse" data-parent="#accordion2" href="#by_date">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    Total Entry Tiap Tanggal
                                </h4>
                            </div>
                            </a>
                            <div id="by_date" class="panel-collapse collapse<?=$this->uri->segment(2)=='bidanbytanggal'?' in':''?>">
                                <?php
                                foreach($location as $kec=>$desas){
                                ?>
                                <div class="panel panel-default panel-collapse">
                                    <a data-parent="#bidan_menu" href="<?php echo site_url() ."dataentry/bidanbytanggal/".$kec?>">
                                    <div class="panel-heading"<?=($this->uri->segment(2)=='bidanbytanggal'&&$this->uri->segment(3)==$kec)?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            Puskesmas <?=$kec?>
                                        </h4>
                                    </div>
                                    </a>
                                    <?php if($this->uri->segment(2)=='bidanbytanggal'&&$this->uri->segment(3)==$kec){ ?>
                                    <div class="panel panel-default">
                                        <?php foreach($desas as $user => $desa){
                                        ?>
                                        <a data-parent="#bidan_menu" href="<?php echo site_url() ."dataentry/bidanbytanggal/".$kec."/".ucwords($desa)?>">
                                        <div class="panel-heading" <?=($this->uri->segment(4)==ucwords(str_replace(' ','%20',$desa)))?' style="background-color:#909090"':''?>>
                                            <h4 class="panel-title">
                                                Desa <?=ucwords($desa)?>
                                            </h4>
                                        </div>
                                        </a>
                                        <?php }?>
                                    </div>
                                    <?php }?>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php if($this->session->userdata('tipe')=="all"){ ?>
                        <div class="panel panel-default">
                            <a data-toggle="collapse" data-parent="#accordion2" href="#ontime">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    On Time Submission
                                </h4>
                            </div>
                            </a>
                            <div id="ontime" class="panel-collapse collapse<?=$this->uri->segment(2)=='bidanontimesubmission'?' in':''?>">
                                <div class="panel panel-default panel-collapse">
                                    <a data-parent="#bidan_menu" href="<?php echo site_url() ."dataentry/bidanontimesubmission/daily"?>">
                                    <div class="panel-heading"<?=($this->uri->segment(2)=='bidanontimesubmission'&&$this->uri->segment(3)=='daily')?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            Daily On Time
                                        </h4>
                                    </div>
                                    </a>
                                </div>
                                <div class="panel panel-default panel-collapse">
                                    <a data-parent="#bidan_menu" href="<?php echo site_url() ."dataentry/bidanontimesubmission/weekly"?>">
                                    <div class="panel-heading"<?=($this->uri->segment(2)=='bidanontimesubmission'&&$this->uri->segment(3)=='weekly')?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            Weekly On Time
                                        </h4>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>
            <?php }?>
            <?php if($this->session->userdata('tipe')=="gizi"||$this->session->userdata('tipe')=="all"){ ?>
            <div class="panel panel-default" id="gizis">
                <a data-toggle="collapse" data-parent="#accordion" href="#gizi_menu">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Gizi
                    </h4>
                </div>
                </a>
                <div id="gizi_menu" class="panel-collapse collapse<?=($this->uri->segment(2)=='gizibyform'||$this->uri->segment(2)=='gizibytanggal'||$this->uri->segment(2)=='giziontimesubmission')?' in':''?>">
                    <div class="panel-group" id="accordion3" style="padding-left: 30px;;margin-bottom: 0;">
                        <div class="panel panel-default">
                            <a data-toggle="collapse" data-parent="#accordion3" href="#giziby_form">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    Total Entry Tiap From
                                </h4>
                            </div>
                            </a>
                            <div id="giziby_form" class="panel-collapse collapse<?=$this->uri->segment(2)=='gizibyform'?' in':''?>">
                                <?php
                                foreach($location as $kec=>$desas){
                                ?>
                                <div class="panel panel-default panel-collapse">
                                    <a data-parent="#gizi_menu" href="<?php echo site_url() ."dataentry/gizibyform/".$kec?>">
                                    <div <?=($this->uri->segment(2)=='gizibyform'&&$this->uri->segment(3)==$kec)?' style="background-color:#909090"':''?> class="panel-heading">
                                        <h4 class="panel-title">
                                            Puskesmas <?=$kec?>
                                        </h4>
                                    </div>
                                    </a>
                                    <?php if($this->uri->segment(2)=='gizibyform'&&$this->uri->segment(3)==$kec){ ?>
                                    <div class="panel panel-default">
                                        <?php foreach($desas as $user => $desa){
                                        ?>
                                        <a data-parent="#gizi_menu" href="<?php echo site_url() ."dataentry/gizibyform/".$kec."/".ucwords($desa)?>">
                                        <div class="panel-heading" <?=($this->uri->segment(4)==ucwords(str_replace(' ','%20',$desa)))?' style="background-color:#909090"':''?>>
                                            <h4 class="panel-title">
                                                Desa <?=ucwords($desa)?>
                                            </h4>
                                        </div>
                                        </a>
                                        <?php }?>
                                    </div>
                                    <?php }?>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <a data-toggle="collapse" data-parent="#accordion3" href="#giziby_date">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    Total Entry Tiap Tanggal
                                </h4>
                            </div>
                            </a>
                            <div id="giziby_date" class="panel-collapse collapse<?=$this->uri->segment(2)=='gizibytanggal'?' in':''?>">
                                <?php
                                foreach($location as $kec=>$desas){
                                ?>
                                <div class="panel panel-default panel-collapse">
                                    <a data-parent="#gizi_menu" href="<?php echo site_url() ."dataentry/gizibytanggal/".$kec?>">
                                    <div class="panel-heading"<?=($this->uri->segment(2)=='gizibytanggal'&&$this->uri->segment(3)==$kec)?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            Puskesmas <?=$kec?>
                                        </h4>
                                    </div>
                                    </a>
                                    <?php if($this->uri->segment(2)=='gizibytanggal'&&$this->uri->segment(3)==$kec){ ?>
                                    <div class="panel panel-default">
                                        <?php foreach($desas as $user => $desa){
                                        ?>
                                        <a data-parent="#gizi_menu" href="<?php echo site_url() ."dataentry/gizibytanggal/".$kec."/".ucwords($desa)?>">
                                        <div class="panel-heading" <?=($this->uri->segment(4)==ucwords(str_replace(' ','%20',$desa)))?' style="background-color:#909090"':''?>>
                                            <h4 class="panel-title">
                                                Desa <?=ucwords($desa)?>
                                            </h4>
                                        </div>
                                        </a>
                                        <?php }?>
                                    </div>
                                    <?php }?>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php if($this->session->userdata('tipe')=="all"){ ?>
                        <div class="panel panel-default">
                            <a data-toggle="collapse" data-parent="#accordion2" href="#ontimegizi">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    On Time Submission
                                </h4>
                            </div>
                            </a>
                            <div id="ontimegizi" class="panel-collapse collapse<?=$this->uri->segment(2)=='giziontimesubmission'?' in':''?>">
                                <div class="panel panel-default panel-collapse">
                                    <a data-parent="#gizi_menu" href="<?php echo site_url() ."dataentry/giziontimesubmission/daily"?>">
                                    <div class="panel-heading"<?=($this->uri->segment(2)=='giziontimesubmission'&&$this->uri->segment(3)=='daily')?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            Daily On Time
                                        </h4>
                                    </div>
                                    </a>
                                </div>
                                <div class="panel panel-default panel-collapse">
                                    <a data-parent="#gizi_menu" href="<?php echo site_url() ."dataentry/giziontimesubmission/weekly"?>">
                                    <div class="panel-heading"<?=($this->uri->segment(2)=='giziontimesubmission'&&$this->uri->segment(3)=='weekly')?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            Weekly On Time
                                        </h4>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php if($this->session->userdata('tipe')=="vaksinator"||$this->session->userdata('tipe')=="all"){ ?>
            <div class="panel panel-default" id="vaksinators">
                <a data-toggle="collapse" data-parent="#accordion" href="#vaksinator_menu">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Vaksinator
                    </h4>
                </div>
                </a>
                <div id="vaksinator_menu" class="panel-collapse collapse<?=($this->uri->segment(2)=='vaksinatorbyform'||$this->uri->segment(2)=='vaksinatorbytanggal'||$this->uri->segment(2)=='vaksinontimesubmission')?' in':''?>">
                    <div class="panel-group" id="accordion4" style="padding-left: 30px;;margin-bottom: 0;">
                        <div class="panel panel-default">
                            <a data-toggle="collapse" data-parent="#accordion4" href="#vaksinatorby_form">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    Total Entry Tiap From
                                </h4>
                            </div>
                            </a>
                            <div id="vaksinatorby_form" class="panel-collapse collapse<?=$this->uri->segment(2)=='vaksinatorbyform'?' in':''?>">
                                <?php
                                foreach($location as $kec=>$desas){
                                ?>
                                <div class="panel panel-default panel-collapse">
                                    <a data-parent="#vaksinator_menu" href="<?php echo site_url() ."dataentry/vaksinatorbyform/$kec"?>">
                                    <div <?=($this->uri->segment(2)=='vaksinatorbyform'&&$this->uri->segment(3)==$kec)?' style="background-color:#909090"':''?> class="panel-heading">
                                        <h4 class="panel-title">
                                            Puskesmas <?=$kec?>
                                        </h4>
                                    </div>
                                    </a>
                                    <?php if($this->uri->segment(2)=='vaksinatorbyform'&&$this->uri->segment(3)==$kec){ ?>
                                    <div class="panel panel-default">
                                        <?php foreach($desas as $user => $desa){
                                        ?>
                                        <a data-parent="#vaksinator_menu" href="<?php echo site_url() ."dataentry/vaksinatorbyform/$kec/".ucwords($desa)?>">
                                        <div class="panel-heading" <?=($this->uri->segment(4)==ucwords(str_replace(' ','%20',$desa)))?' style="background-color:#909090"':''?>>
                                            <h4 class="panel-title">
                                                Desa <?=ucwords($desa)?>
                                            </h4>
                                        </div>
                                        </a>
                                        <?php }?>
                                    </div>
                                    <?php }?>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <a data-toggle="collapse" data-parent="#accordion4" href="#vaksinatorby_date">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    Total Entry Tiap Tanggal
                                </h4>
                            </div>
                            </a>
                            <div id="vaksinatorby_date" class="panel-collapse collapse<?=$this->uri->segment(2)=='vaksinatorbytanggal'?' in':''?>">
                                <?php
                                foreach($location as $kec=>$desas){
                                ?>
                                <div class="panel panel-default panel-collapse">
                                    <a data-parent="#vaksinator_menu" href="<?php echo site_url() ."dataentry/vaksinatorbytanggal/$kec"?>">
                                    <div class="panel-heading"<?=($this->uri->segment(2)=='vaksinatorbytanggal'&&$this->uri->segment(3)==$kec)?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            Puskesmas <?=$kec?>
                                        </h4>
                                    </div>
                                    </a>
                                    <?php if($this->uri->segment(2)=='vaksinatorbytanggal'&&$this->uri->segment(3)==$kec){ ?>
                                    <div class="panel panel-default">
                                        <?php foreach($desas as $user => $desa){
                                        ?>
                                        <a data-parent="#vaksinator_menu" href="<?php echo site_url() ."dataentry/vaksinatorbytanggal/$kec/".ucwords($desa)?>">
                                        <div class="panel-heading" <?=($this->uri->segment(4)==ucwords(str_replace(' ','%20',$desa)))?' style="background-color:#909090"':''?>>
                                            <h4 class="panel-title">
                                                Desa <?=ucwords($desa)?>
                                            </h4>
                                        </div>
                                        </a>
                                        <?php }?>
                                    </div>
                                    <?php }?>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php if($this->session->userdata('tipe')=="all"){ ?>
                        <div class="panel panel-default">
                            <a data-toggle="collapse" data-parent="#accordion2" href="#ontimevaksin">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    On Time Submission
                                </h4>
                            </div>
                            </a>
                            <div id="ontimevaksin" class="panel-collapse collapse<?=$this->uri->segment(2)=='vaksinontimesubmission'?' in':''?>">
                                <div class="panel panel-default panel-collapse">
                                    <a data-parent="#vaksinator_menu" href="<?php echo site_url() ."dataentry/vaksinontimesubmission/daily"?>">
                                    <div class="panel-heading"<?=($this->uri->segment(2)=='vaksinontimesubmission'&&$this->uri->segment(3)=='daily')?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            Daily On Time
                                        </h4>
                                    </div>
                                    </a>
                                </div>
                                <div class="panel panel-default panel-collapse">
                                    <a data-parent="#vaksinator_menu" href="<?php echo site_url() ."dataentry/vaksinontimesubmission/weekly"?>">
                                    <div class="panel-heading"<?=($this->uri->segment(2)=='vaksinontimesubmission'&&$this->uri->segment(3)=='weekly')?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                            Weekly On Time
                                        </h4>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>