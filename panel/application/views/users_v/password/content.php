<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            "<strong><?= $item->user_name; ?></strong>" Kaydının Şifresini Düzenliyorsunuz...
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?= base_url("users/update_password/{$item->id}"); ?>" method="post">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Şifre</label>
                        <input type="password" class="form-control" id="exampleInputEmail1" placeholder="Şifre" name="password">
                        <?php if (isset($form_error)){ ?>
                            <small class="input-form-error pull-right"><?= form_error("password"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Şifre Tekrarı</label>
                        <input type="password" class="form-control" id="exampleInputEmail1" placeholder="Şifre Tekrarı" name="re_password">
                        <?php if (isset($form_error)){ ?>
                            <small class="input-form-error pull-right"><?= form_error("re_password"); ?></small>
                        <?php } ?>
                    </div>

                    <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
                    <a href="<?= base_url("users"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>