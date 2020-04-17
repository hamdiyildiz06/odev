<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            "<strong><?= $item->user_name; ?></strong>" Kaydını Düzenliyorsunuz...
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?= base_url("emailsettings/update/{$item->id}"); ?>" method="post">

                    <div class="form-group">
                        <label for="protocol">Protokol</label>
                        <input type="text" class="form-control" id="protocol" placeholder="protocol" name="protocol" value="<?= isset($form_error) ? set_value("protocol") : $item->protocol; ?>">
                        <?php if (isset($form_error)){ ?>
                            <small class="input-form-error pull-right"><?= form_error("protocol"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="host">E-Posta Sunucu Bilgisi</label>
                        <input type="text" class="form-control" id="host" placeholder="host" name="host" value="<?= isset($form_error) ? set_value("host") : $item->host; ?>">
                        <?php if (isset($form_error)){ ?>
                            <small class="input-form-error pull-right"><?= form_error("host"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="port">Port Numarası</label>
                        <input type="text" class="form-control" id="port" placeholder="port" name="port" value="<?= isset($form_error) ? set_value("port") : $item->port; ?>">
                        <?php if (isset($form_error)){ ?>
                            <small class="input-form-error pull-right"><?= form_error("port"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="user">E-Posta Adresi (User)</label>
                        <input type="email" class="form-control" id="user" placeholder="E-Posta Adresi (User)" name="user" value="<?= isset($form_error) ? set_value("user") : $item->user; ?>">
                        <?php if (isset($form_error)){ ?>
                            <small class="input-form-error pull-right"><?= form_error("user"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="password">E-Posta Adresine Ait Şifre</label>
                        <input type="password" class="form-control" id="password" placeholder="Şifre" name="password" value="<?= isset($form_error) ? set_value("password") : $item->password; ?>">
                        <?php if (isset($form_error)){ ?>
                            <small class="input-form-error pull-right"><?= form_error("password"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="from">Kimden Gidecek (from)</label>
                        <input type="email" class="form-control" id="from" placeholder="from" name="from" value="<?= isset($form_error) ? set_value("from") : $item->from; ?>">
                        <?php if (isset($form_error)){ ?>
                            <small class="input-form-error pull-right"><?= form_error("from"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="to">Kime Gidecek (to)</label>
                        <input type="email" class="form-control" id="to" placeholder="to" name="to" value="<?= isset($form_error) ? set_value("to") : $item->to; ?>">
                        <?php if (isset($form_error)){ ?>
                            <small class="input-form-error pull-right"><?= form_error("to"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="user_name">E-Posta Başlık</label>
                        <input type="text" class="form-control" id="user_name" placeholder="E-Posta Başlık" name="user_name" value="<?= isset($form_error) ? set_value("user_name") : $item->user_name; ?>">
                        <?php if (isset($form_error)){ ?>
                            <small class="input-form-error pull-right"><?= form_error("user_name"); ?></small>
                        <?php } ?>
                    </div>

                    <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
                    <a href="<?= base_url("emailsettings"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>