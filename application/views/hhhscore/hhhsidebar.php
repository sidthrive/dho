<div id="page" class="container">
    <div id="sidebar1">
        <h2>Menu HHH SCORE</h2>
        <div class="panel-group" id="accordion">
            <div class="panel panel-default" id="bidans">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#bidan_menu">Bidan</a>
                    </h4>
                </div>
                <div id="bidan_menu" class="panel-collapse collapse<?=($this->uri->segment(2)=='headscore'||(strpos($this->uri->segment(2),'trimester')!==false)||$this->uri->segment(2)=='heartscore'||$this->uri->segment(2)=='standar')?' in':''?>">
                    <div class="panel panel-default">
                        <div <?=($this->uri->segment(2)=='headscore')?' style="background-color:#909090"':''?> class="panel-heading">
                            <h4 class="panel-title">
                                <a data-parent="#bidan_menu" href="<?php echo site_url() ."hhhscore/headscore"?>">Head Score</a>
                            </h4>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#bidans" href="#handscore">Hand Score</a>
                            </h4>
                        </div>
                        <div id="handscore" class="panel-collapse collapse<?=(strpos($this->uri->segment(2),'trimester')!==false||$this->uri->segment(2)=='standar')?' in':''?>">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#handscore" href="#qci">Pelayanan Antenatal (QCI)</a>
                                    </h4>
                                </div>
                                <div id="qci" class="panel-collapse collapse<?=(strpos($this->uri->segment(2),'trimester')!==false)?' in':''?>">
                                    <div class="panel panel-default">
                                        <div class="panel-heading"<?=($this->uri->segment(2)=='bidantrimester1')?' style="background-color:#909090"':''?>>
                                            <h4 class="panel-title">
                                                <a data-parent="#qci" href="<?php echo site_url() ."hhhscore/bidantrimester1"?>">Trimester 1</a>
                                            </h4>
                                        </div>
                                        <div class="panel-heading"<?=($this->uri->segment(2)=='bidantrimester2')?' style="background-color:#909090"':''?>>
                                            <h4 class="panel-title">
                                                <a data-parent="#qci" href="<?php echo site_url() ."hhhscore/bidantrimester2"?>">Trimester 2</a>
                                            </h4>
                                        </div>
                                        <div class="panel-heading"<?=($this->uri->segment(2)=='bidantrimester3')?' style="background-color:#909090"':''?>>
                                            <h4 class="panel-title">
                                                <a data-parent="#qci" href="<?php echo site_url() ."hhhscore/bidantrimester3"?>">Trimester 3</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading"<?=($this->uri->segment(2)=='standar')?' style="background-color:#909090"':''?>>
                                    <h4 class="panel-title">
                                        <a data-parent="#bidan_menu" href="<?php echo site_url() ."hhhscore/standar"?>">Cakupan Standar</a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div <?=($this->uri->segment(2)=='bidanbyform'&&$this->uri->segment(3)=='Sengkol')?' style="background-color:#909090"':''?> class="panel-heading">
                            <h4 class="panel-title">
                                <a data-parent="#bidan_menu" href="<?php echo site_url() ."hhhscore/heartscore"?>">Heart Score</a>
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
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Jurim</a>
                    </h4>
                </div>
            </div>
        </div>
    </div>