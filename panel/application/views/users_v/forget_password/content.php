<div id="back-to-home">
    <a href="<?= base_url(); ?>" class="btn btn-outline btn-default"><i class="fa fa-home animated zoomIn"></i></a>
</div>

<div class="simple-page-wrap">
    <div class="simple-page-logo animated swing">
        <a href="index.html">
            <span><i class="fa fa-gg"></i></span>
            <span>CMS</span>
        </a>
    </div><!-- logo -->
    <div class="simple-page-form animated flipInY" id="reset-password-form">
        <h4 class="form-title m-b-xl text-center">Şifrenizi mi Unuttunuz ?</h4>

        <form action="<?= base_url("reset-password"); ?>" method="post">
            <div class="form-group">
                <input
                        id="reset-password-email"
                        type="email"
                        class="form-control"
                        placeholder="E-Posta Adresiniz..."
                        name="email" value="<?= isset($form_error) ? set_value("email") : ""; ?>"
                >
                <?php if (isset($form_error)){ ?>
                    <small class="input-form-error pull-right"><?= form_error("email"); ?></small>
                <?php } ?>
            </div>
            <button class="btn btn-primary">Şifremi Sıfırla</button>
        </form>
    </div><!-- #reset-password-form -->

</div><!-- .simple-page-wrap -->

