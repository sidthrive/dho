<div id="contentujian">
    <div id="titleujian" style="text-align: center;">
        <h3><?=$jenis_tes->nama_tes?></h3>
        <br/>
        <br/>
    </div>
    <div id="isiujian" style="text-align:justified; width:91%; line-height: 30px;">
        <ul>
            <li>Ujian <?=ucwords($jenis_tes->nama_tes)?> ini akan dilakukan dengan pengulangan sebanyak <?=$jenis_tes->jumlah_tes?> kali.</li>
            <li>Setiap Ujian terdiri dari <?=$jenis_tes->jumlah_soal?> soal dengan waktu <?=$jenis_tes->waktu?> menit.</li>
            <li>Sebelum mengambil ujian, disarankan untuk melaksanakan pre-test terlebih dahulu dengan 
                meng-klik link berikut : <a href='<?=base_url()."sertifikasi/do_ujian/".$ujian->token."/pre-test"?>'>Ambil Pre-test</a></li>
            <li>Jika sudah yakin untuk mengambil ujian, silahkan klik link berikut : 
                <a href='<?=base_url()."sertifikasi/do_ujian/".$ujian->token."/do"?>'>Ambil Ujian Standarisasi</a></li>
        </ul>
        <p style="color: red; padding-left: 25px;">
            Catatan : Setelah link ujian diklik, waktu secara otomatis akan berjalan dan tidak bisa dihentikan.
            Maka pastikan Anda menyediakan waktu khusus sekitar 2 jam untuk mengambil ujian standarisasi ini.</p>
    </div>
</div>