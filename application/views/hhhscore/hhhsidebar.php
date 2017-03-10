<div id="page" class="container">
    <div id="mini-submenu">
        <div>
            <i class="glyphicon glyphicon-play"></i>
        </div>
    </div>
    <div id="sidebar1">
        <h2>Menu HHH SCORE<span class="pull-right" id="slide-submenu">
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
                <div id="bidan_menu" class="panel-collapse collapse<?=($this->uri->segment(2)=='headscore'||(strpos($this->uri->segment(2),'trimester')!==false)||$this->uri->segment(2)=='heartscore'||$this->uri->segment(2)=='standar')?' in':''?>">
                    <div class="panel panel-default">
                        <a data-parent="#bidan_menu" href="<?php echo site_url() ."hhhscore/headscore"?>">
                        <div <?=($this->uri->segment(2)=='headscore')?' style="background-color:#909090"':''?> class="panel-heading">
                            <h4 class="panel-title">
                                Head Score
                            </h4>
                        </div>
                        </a>
                    </div>
                    <div class="panel panel-default">
                        <a data-toggle="collapse" data-parent="#bidans" href="#handscore">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                Hand Score
                            </h4>
                        </div>
                        </a>
                        <div id="handscore" class="panel-collapse collapse<?=(strpos($this->uri->segment(2),'trimester')!==false||$this->uri->segment(2)=='standar')?' in':''?>">
                            <div class="panel panel-default">
                                <a data-toggle="collapse" data-parent="#handscore" href="#qci">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        Pelayanan Antenatal (QCI)
                                    </h4>
                                </div>
                                </a>
                                <div id="qci" class="panel-collapse collapse<?=(strpos($this->uri->segment(2),'trimester')!==false)?' in':''?>">
                                    <div class="panel panel-default">
                                        <a data-parent="#qci" href="<?php echo site_url() ."hhhscore/bidantrimester1"?>">
                                        <div class="panel-heading"<?=($this->uri->segment(2)=='bidantrimester1')?' style="background-color:#909090"':''?>>
                                            <h4 class="panel-title">
                                                Trimester 1
                                            </h4>
                                        </div>
                                        </a>
                                        <a data-parent="#qci" href="<?php echo site_url() ."hhhscore/bidantrimester2"?>">
                                        <div class="panel-heading"<?=($this->uri->segment(2)=='bidantrimester2')?' style="background-color:#909090"':''?>>
                                            <h4 class="panel-title">
                                                Trimester 2
                                            </h4>
                                        </div>
                                        </a>
                                        <a data-parent="#qci" href="<?php echo site_url() ."hhhscore/bidantrimester3"?>">
                                        <div class="panel-heading"<?=($this->uri->segment(2)=='bidantrimester3')?' style="background-color:#909090"':''?>>
                                            <h4 class="panel-title">
                                                Trimester 3
                                            </h4>
                                        </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <a data-parent="#bidan_menu" href="<?php echo site_url() ."hhhscore/standar"?>">
                                <div class="panel-heading"<?=($this->uri->segment(2)=='standar')?' style="background-color:#909090"':''?>>
                                    <h4 class="panel-title">
                                        Cakupan Pelayanan
                                    </h4>
                                </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <a data-parent="#bidan_menu" href="<?php echo site_url() ."hhhscore/heartscore"?>">
                        <div <?=($this->uri->segment(2)=='heartscore')?' style="background-color:#909090"':''?> class="panel-heading">
                            <h4 class="panel-title">
                                Heart Score
                            </h4>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php if($this->session->userdata('tipe')=="gizi"||$this->session->userdata('tipe')=="all"){ ?>
            <div class="panel panel-default">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Gizi
                    </h4>
                </div>
                </a>
            </div>
            <?php } ?>
            <?php if($this->session->userdata('tipe')=="vaksinator"||$this->session->userdata('tipe')=="all"){ ?>
            <div class="panel panel-default">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Vaksinator
                    </h4>
                </div>
                </a>
            </div>
            <?php } ?>
        </div>
    </div>