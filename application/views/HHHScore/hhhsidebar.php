<div id="page" class="container">
    <div id="sidebar1">
        <div id="bidan">
            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#bidanscore" style="width: 250px; text-align: left;">Bidan</button>
            <div id="bidanscore" class="collapse">
              <div id="headscore" style="padding-left:25px;">
                  <a class="btn btn-link" href="<?php echo site_url() ."HHHScore/headscore"?>" style="width: 225px; text-align: left;">Head Score </a>
              </div>
              <div id="handscore" style="padding-left:25px;">
                <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#antenatal" style="width: 225px; text-align: left;">Hand Score</button>
                <div id="antenatal" class="collapse" style="padding-left:25px;">
                    <div id="subantenatalQCI">
                        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#trimesterlist" style="width: 225px; text-align: left;">Pelayanan Antenatal (QCI)</button>
                        <div id="trimesterlist" class="collapse" style="padding-left:40px;">
                            <p><a href=<?php echo site_url() ."HHHScore/bidantrimester1"?>>Trimester 1</a></p>
                            <p><a href=<?php echo site_url() ."HHHScore/bidantrimester2"?>>Trimester 2</a></p>
                            <p><a href=<?php echo site_url() ."HHHScore/bidantrimester3"?>>Trimester 3</a></p>
                        </div>
                    </div>
                    <div id="subantenatalSC">
                        <a class="btn btn-link" href="<?php echo site_url() ."HHHScore/standar"?>" style="width: 225px; text-align: left;">Cakupan (Standar & Non)</a>
                    </div>
                </div>
                
              </div>
              <div id="subbidanentrytanggal" style="padding-left:25px;">
                  <a class="btn btn-link" href="<?php echo site_url() ."HHHScore/heartscore"?>" style="width: 225px; text-align: left;">Heart Score </a>
              </div>
            </div>
         </div>
        <div id='gizi'>
            <a class="btn btn-link" href="#" style="width: 225px; text-align: left;">Gizi</a>
        </div>
        <div id='jurim'>
            <a class="btn btn-link" href="#" style="width: 225px; text-align: left;">Jurim</a>
        </div>
        
    </div>