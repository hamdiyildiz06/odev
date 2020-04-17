<div class="row">

    <div class="col-md-12">
        <h4 class="m-b-lg">
            Yeni E-posta Hesabı Ekle
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?= base_url("emailsettings/save"); ?>" method="post">

                    <div class="form-group">
                        <label for="protocol">Protokol</label>
                        <input type="text" class="form-control" id="protocol" placeholder="protocol" name="protocol" value="<?= isset($form_error) ? set_value("protocol") : ""; ?>">
                        <?php if (isset($form_error)){ ?>
                            <small class="input-form-error pull-right"><?= form_error("protocol"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="host">E-Posta Sunucu Bilgisi</label>
                        <input type="text" class="form-control" id="host" placeholder="host" name="host" value="<?= isset($form_error) ? set_value("host") : ""; ?>">
                        <?php if (isset($form_error)){ ?>
                            <small class="input-form-error pull-right"><?= form_error("host"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="port">Port Numarası</label>
                        <input type="text" class="form-control" id="port" placeholder="port" name="port" value="<?= isset($form_error) ? set_value("port") : ""; ?>">
                        <?php if (isset($form_error)){ ?>
                            <small class="input-form-error pull-right"><?= form_error("port"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="user">E-Posta Adresi (User)</label>
                        <input type="email" class="form-control" id="user" placeholder="E-Posta Adresi (User)" name="user" value="<?= isset($form_error) ? set_value("user") : ""; ?>">
                        <?php if (isset($form_error)){ ?>
                            <small class="input-form-error pull-right"><?= form_error("user"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="password">E-Posta Adresine Ait Şifre</label>
                        <input type="password" class="form-control" id="password" placeholder="Şifre" name="password">
                        <?php if (isset($form_error)){ ?>
                            <small class="input-form-error pull-right"><?= form_error("password"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="from">Kimden Gidecek (from)</label>
                        <input type="email" class="form-control" id="from" placeholder="from" name="from" value="<?= isset($form_error) ? set_value("from") : ""; ?>">
                        <?php if (isset($form_error)){ ?>
                            <small class="input-form-error pull-right"><?= form_error("from"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="to">Kime Gidecek (to)</label>
                        <input type="email" class="form-control" id="to" placeholder="to" name="to" value="<?= isset($form_error) ? set_value("to") : ""; ?>">
                        <?php if (isset($form_error)){ ?>
                            <small class="input-form-error pull-right"><?= form_error("to"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="user_name">E-Posta Başlık</label>
                        <input type="text" class="form-control" id="user_name" placeholder="E-Posta Başlık" name="user_name" value="<?= isset($form_error) ? set_value("user_name") : ""; ?>">
                        <?php if (isset($form_error)){ ?>
                            <small class="input-form-error pull-right"><?= form_error("user_name"); ?></small>
                        <?php } ?>
                    </div>


                    <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
                    <a href="<?= base_url("emailsettings"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>