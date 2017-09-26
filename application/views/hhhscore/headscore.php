<div id="content">
    <div id="title" style="text-align: center; padding-right: 150px;">
        <h3>Standarisasi Bidan</h3>
        <br/>
        <br/>
    </div>
    <div id="isi" style="text-align:justified; width:91%; line-height: 30px;">
        <ul>
            <li>Untuk mengambil ujian, anda dapat mengklik link dibawah ini (Jika link tidak muncul, harap menghubungi admin)</li>
            <li>Link Ujian : <?=empty($jadwal)?"<span style='color:red'>Tidak ada jadwal ujian</span>":"<a href='".base_url()."hhhscore/headscore/do/".$jadwal->token."' style='color: blue'>Ambil Ujian</a>"?></li>
            <li>Untuk melihat hasil ujian anda, silahkan klik link berikut : 
                <a href="<?=base_url()."hhhscore/headscore/hasil"?>" style="color: blue">Hasil Ujian</a></li>
        </ul>
    </div>
    <br/>
    <br/>
    <br/>
</div>