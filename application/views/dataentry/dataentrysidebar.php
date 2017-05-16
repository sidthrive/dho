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
                <div id="bidan_menu" class="panel-collapse collapse<?=($this->uri->segment(2)=='bidanbyform'||$this->uri->segment(2)=='bidanbytanggal')?' in':''?>">
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
                                $location = $this->loc->getAllLoc('bidan');
                                foreach($location as $kec=>$desas){
                                ?>
                                <div class="panel panel-default panel-collapse">
                                    <a data-parent="#bidan_menu" href="<?php echo site_url() ."dataentry/bidanbyform/".$kec?>">
                                    <div <?=($this->uri->segment(2)=='bidanbyform'&&str_replace('%20',' ',$this->uri->segment(3))==$kec)?' style="background-color:#909090"':''?> class="panel-heading">
                                        <h4 class="panel-title">
                                             <?=$kec?>
                                        </h4>
                                    </div>
                                    </a>
                                    <?php if($this->uri->segment(2)=='bidanbyform'&&str_replace('%20',' ',$this->uri->segment(3))==$kec){ ?>
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
                                    <div class="panel-heading"<?=($this->uri->segment(2)=='bidanbytanggal'&&str_replace('%20',' ',$this->uri->segment(3))==$kec)?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                             <?=$kec?>
                                        </h4>
                                    </div>
                                    </a>
                                    <?php if($this->uri->segment(2)=='bidanbytanggal'&&str_replace('%20',' ',$this->uri->segment(3))==$kec){ ?>
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
                    </div>
                </div>
            </div>
            <?php }?>
            <?php if($this->session->userdata('tipe')=="sdidtk"||$this->session->userdata('tipe')=="all"){ ?>
            <div class="panel panel-default" id="sdidtks">
                <a data-toggle="collapse" data-parent="#accordion" href="#sdidtk_menu">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        ECD
                    </h4>
                </div>
                </a>
                <div id="sdidtk_menu" class="panel-collapse collapse<?=($this->uri->segment(2)=='sdidtkbyform'||$this->uri->segment(2)=='sdidtkbytanggal')?' in':''?>">
                    <div class="panel-group" id="accordion3" style="padding-left: 30px;;margin-bottom: 0;">
                        <div class="panel panel-default">
                            <a data-toggle="collapse" data-parent="#accordion3" href="#sdidtkby_form">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    Total Entry Tiap From
                                </h4>
                            </div>
                            </a>
                            <div id="sdidtkby_form" class="panel-collapse collapse<?=$this->uri->segment(2)=='sdidtkbyform'?' in':''?>">
                                <?php
                                $location = $this->loc->getAllLoc('sdidtk');
                                foreach($location as $kec=>$desas){
                                ?>
                                <div class="panel panel-default panel-collapse">
                                    <a data-parent="#sdidtk_menu" href="<?php echo site_url() ."dataentry/sdidtkbyform/".$kec?>">
                                    <div <?=($this->uri->segment(2)=='sdidtkbyform'&&str_replace('%20',' ',$this->uri->segment(3))==$kec)?' style="background-color:#909090"':''?> class="panel-heading">
                                        <h4 class="panel-title">
                                             <?=$kec?>
                                        </h4>
                                    </div>
                                    </a>
                                    <?php if($this->uri->segment(2)=='sdidtkbyform'&&str_replace('%20',' ',$this->uri->segment(3))==$kec){ ?>
                                    <div class="panel panel-default">
                                        <?php foreach($desas as $user => $desa){
                                        ?>
                                        <a data-parent="#sdidtk_menu" href="<?php echo site_url() ."dataentry/sdidtkbyform/".$kec."/".ucwords($desa)?>">
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
                            <a data-toggle="collapse" data-parent="#accordion3" href="#sdidtkby_date">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    Total Entry Tiap Tanggal
                                </h4>
                            </div>
                            </a>
                            <div id="sdidtkby_date" class="panel-collapse collapse<?=$this->uri->segment(2)=='sdidtkbytanggal'?' in':''?>">
                                <?php
                                foreach($location as $kec=>$desas){
                                ?>
                                <div class="panel panel-default panel-collapse">
                                    <a data-parent="#sdidtk_menu" href="<?php echo site_url() ."dataentry/sdidtkbytanggal/".$kec?>">
                                    <div class="panel-heading"<?=($this->uri->segment(2)=='sdidtkbytanggal'&&str_replace('%20',' ',$this->uri->segment(3))==$kec)?' style="background-color:#909090"':''?>>
                                        <h4 class="panel-title">
                                             <?=$kec?>
                                        </h4>
                                    </div>
                                    </a>
                                    <?php if($this->uri->segment(2)=='sdidtkbytanggal'&&str_replace('%20',' ',$this->uri->segment(3))==$kec){ ?>
                                    <div class="panel panel-default">
                                        <?php foreach($desas as $user => $desa){
                                        ?>
                                        <a data-parent="#sdidtk_menu" href="<?php echo site_url() ."dataentry/sdidtkbytanggal/".$kec."/".ucwords($desa)?>">
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
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>