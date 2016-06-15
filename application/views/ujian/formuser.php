<?php
    $page_header = "TAMBAH USER BARU";
    $id_         = "";
    $nama_       = "";
    $username_   = "";
    $password_   = "";
    $email_      = "";
    $kontak_     = "";
    $alamat_     = "";
    
    if(isset($error)){
        if($mode=="edit"){
            $page_header = "EDIT USER";
        }else{
            $page_header = "TAMBAH USER BARU";
        }
        $id_         = $id;
        $nama_       = $nama;
        $username_   = $user;
        $password_   = "";
        $email_      = $email;
        $kontak_     = $kontak;
        $alamat_     = $alamat;
    }elseif($user!=null){
        $page_header = "EDIT USER";
        $id_         = $user->id;
        $nama_       = $user->nama_lengkap;
        $username_   = $user->username;
        $password_   = $user->password;
        $email_      = $user->email;
        $kontak_     = $user->kontak;
        $alamat_     = $user->alamat;
    }

?>

<div id="content">
    <div id="text">
        <h3><?=$page_header?></h3>
    </div>
    <br><br>
    <hr class="divider">
    <?=$this->session->flashdata('flash_data')?>
    <div id="container">
        <form action="<?=base_URL()?>ujian/setuser" method="post">
            <input type="hidden" name="mode" value="<?=$mode?>"/>
            <input type="hidden" name="id" value="<?=$id_?>"/>
            <?php echo $this->session->flashdata("pass");?>
            <table style="width: 100%">
                <tr>
                    <td>Nama Lengkap</td><td><input type="text" name="nama" required autofocus class="form-control" placeholder="Masukkan Nama Lengkap" value="<?=$nama_?>"></td>
                </tr>
                <tr>
                    <td>Username</td><td><input type="text" name="user" required class="form-control" placeholder="Masukkan Username" value="<?=$username_?>"></td>
                </tr>
                <tr>
                    <td>Password</td><td><input type="password" name="pass" required class="form-control" placeholder="Masukkan Password" value="<?=$password_?>"></td>
                </tr>
                <tr>
                    <td>Ulangi Password</td><td><input type="password" name="pass2" required class="form-control" placeholder="Masukkan Lagi Password" value="<?=$password_?>"></td>
                </tr>
                <tr>
                    <td>Email</td><td><input type="email" name="email" class="form-control" placeholder="Masukkan Email" value="<?=$email_?>"></td>
                </tr>
                <tr>
                    <td>No. Kontak</td><td><input type="text" name="kontak" class="form-control" placeholder="Masukkan Nomor Kontak" value="<?=$kontak_?>"></td>
                </tr>
                <tr>
                    <td>Alamat</td><td><input type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat" value="<?=$alamat_?>"></td>
                </tr>
            </table>
            <div><button type="submit" class="btn btn-success">SIMPAN</button></div>
        </form>
    </div>
</div>
</div>