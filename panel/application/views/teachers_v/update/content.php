<div class="row">

    <div class="col-md-12">
        <h4 class="m-b-lg">
            "<strong><?= $item->title; ?></strong>" Kaydını Düzenle
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?= base_url("teachers/Update/{$item->id}"); ?>" method="post">

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="title">Başlık</label>
                            <input type="text" class="form-control" id="title" placeholder="İsim ve Soyisim" name="title" value="<?= isset($form_error) ? set_value("title") : $item->title; ?>">
                            <?php if (isset($form_error)){ ?>
                                <small class="input-form-error pull-right"><?= form_error("title"); ?></small>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="tc">Tc Kimlik</label>
                            <input type="text" class="form-control" id="tc" placeholder="İşi Anlatan Başlık Bilgisi" name="tc" value="<?= isset($form_error) ? set_value("tc") : $item->tc; ?>">
                            <?php if (isset($form_error)){ ?>
                                <small class="input-form-error pull-right"><?= form_error("tc"); ?></small>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="brands_id">Vekil Sınıfınız</label>
                            <select  name="brands_id" id="brands_id" class="form-control" data-url="<?php echo base_url("teachers/categoriSec/"); ?>">

                                <?php foreach ($brands as $brand):  ?>
                                    <option <?= ($item->brands_id == $brand->id) ? "selected" : null; ?> value="<?= $brand->id; ?>"><?= $brand->title; ?></option>
                                <?php endforeach; ?>

                            </select>
                            <?php if (isset($form_error)){ ?>
                                <small class="input-form-error pull-right"><?= form_error("brands_id"); ?></small>
                            <?php } ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
                    <a href="<?= base_url("teachers"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>