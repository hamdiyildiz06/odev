
<div id="back-to-home">
    <a href="<?= base_url(); ?>" class="btn btn-outline btn-default"><i class="fa fa-home animated zoomIn"></i></a>
</div>
<div class="simple-page-wrap">
    <div class="simple-page-logo animated swing">
        <a href="<?= base_url(); ?>">
            <span><i class="fa fa-gg"></i></span>
            <span>CMS</span>
        </a>
    </div><!-- logo -->
    <div class="simple-page-form animated flipInY" id="login-form">
        <h4 class="form-title m-b-xl text-center">Bigileriniz ile CMS'e Giriş Yapınız</h4>
        <form action="<?= base_url("userop/do_login"); ?>" method="post">
            <div class="form-group">
                <input id="title" type="text" class="form-control" placeholder="Kullanıcı Adı" name="title" value="<?= isset($form_error) ? set_value("title") : ""; ?>">
                <?php if (isset($form_error)){ ?>
                    <small class="input-form-error pull-right"><?= form_error("title"); ?></small>
                <?php } ?>
            </div>

            <div class="form-group">
                <input id="sign-in-password" type="password" class="form-control" placeholder="Şifre" name="user_password">
                <?php if (isset($form_error)){ ?>
                    <small class="input-form-error pull-right"><?= form_error("user_password"); ?></small>
                <?php } ?>
            </div>

            <div class="form-group m-b-xl">
                <div class="checkbox checkbox-primary">
                    <input type="checkbox" id="keep_me_logged_in"/>
                    <label for="keep_me_logged_in">Keep me signed in</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" value="SING IN">Giriş Yap</button>
        </form>
    </div><!-- #login-form -->

<div class="simple-page-footer">
    <p><a href="<?= base_url("sifremi-unuttum"); ?>">Şifremi Unuttum</a></p>
</div><!-- .simple-page-footer -->


</div><!-- .simple-page-wrap -->