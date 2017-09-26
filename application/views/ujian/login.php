<div class="login-page">
    <div class="form">
        <form class="login-form" action="<?= site_url('sertifikasi/do_login') ?>" method="post">
            <input type="hidden" name="token" value="<?=$token?>" />
            <label for="username">Username</label>
            <input type="text" name="username" />
            <label for="password">Password</label>
            <input type="password" name="password" />
            <button type="submit">Login</button>
        </form>
    </div>
    <?=$this->session->flashdata('flash')?>
</div>