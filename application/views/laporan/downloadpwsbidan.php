<div id="content">    
    <div id="text" style="text-align: center;">
        <h3>Download PWS</h3>
    </div>
    <div id="container" style="text-align: center;">
        <form action="<?php echo site_url()."laporan/download"?>" method="post">
            <div id="option" class="form">
                <select name="kecamatan" style="width:120px;" class="form-control-static">
                    <option value="janapria">Janapria</option>
                    <option value="sengkol">Sengkol</option>
                </select>
                <select name="year" style="width:120px;" class="form-control-static">
                    <option value="2015">2015</option>
                    <option value="2016" selected>2016</option>
                </select>
                <select name="month" style="width:120px;" class="form-control-static">
                    <option value="januari">Januari</option>
                    <option value="februari">Februari</option>
                    <option value="maret" selected>Maret</option>
                    <option value="april">April</option>
                    <option value="mei">Mei</option>
                    <option value="juni">Juni</option>
                    <option value="juli">Juli</option>
                    <option value="agustus">Agustus</option>
                    <option value="september">September</option>
                    <option value="oktober">Oktober</option>
                    <option value="november">November</option>
                    <option value="desember">Desember</option>
                </select>
                <select name="formtype" style="width:120px;" class="form-control-static">
                    <option value="KIA1" selected>KIA Ibu 1</option>
                    <option value="KIA2">KIA Ibu 2</option>
                    <option value="KIA3">KIA Ibu 3</option>
                    <option value="KIA4">KIA Ibu 4</option>
                    <option value="KIA5">KIA Ibu 5</option>
                </select>
            </div>
            <br/>
            <br/>
            <?php echo $this->session->flashdata("file");?>
            <br/>
            <div id="sadasd">
                <button class="btn btn-success" type="submit">DOWNLOAD</button>
            </div>
        </form>

    </div>
</div>