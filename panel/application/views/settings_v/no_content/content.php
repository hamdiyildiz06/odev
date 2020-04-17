<div class="row">

    <div class="col-md-12">
        <h4 class="m-b-lg">
            Site Ayarları
            <a href="<?= base_url("settings/new_form"); ?>" class="btn pull-right btn-outline btn-primary btn-xs"><i class="fa fa-plus"></i> Yeni Ekle</a>
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget p-lg">
            <?php if (empty($items)){ ?>
                <div class="alert alert-info text-center ">
                    <h5 class="alert-title">Kayıt Bulunamadı</h5>
                    <p>Burada herhangi bir veri bulunamamaktadır. Eklemek için lütfen <a href="<?= base_url("settings/new_form"); ?>">Tıklayınız</a></p>
                </div>
            <?php } ?>
        </div><!-- .widget -->
    </div><!-- END column -->
</div>