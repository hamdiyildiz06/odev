<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            "<strong><?= $item->user_name; ?></strong>" Kaydını Düzenliyorsunuz...
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?= base_url("users/update/{$item->id}"); ?>" method="post">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Kullanıcı Adı</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Kullanıcı Adı" name="user_name" value="<?= isset($form_error) ? set_value("user_name") : $item->user_name; ?>">
                        <?php if (isset($form_error)){ ?>
                            <small class="input-form-error pull-right"><?= form_error("user_name"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Ad Soyad</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Ad Soyad" name="full_name" value="<?= isset($form_error) ? set_value("full_name") : $item->full_name; ?>">
                        <?php if (isset($form_error)){ ?>
                            <small class="input-form-error pull-right"><?= form_error("full_name"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">E-Posta Adresi</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="E-Posta Adresi" name="email" value="<?= isset($form_error) ? set_value("email") : $item->email; ?>">
                        <?php if (isset($form_error)){ ?>
                            <small class="input-form-error pull-right"><?= form_error("email"); ?></small>
                        <?php } ?>
                    </div>

                    <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
                    <a href="<?= base_url("users"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>