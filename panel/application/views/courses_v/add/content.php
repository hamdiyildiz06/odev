<div class="row">

    <div class="col-md-12">
        <h4 class="m-b-lg">
            Yeni Eğitim Ekle
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?= base_url("courses/save"); ?>" method="post" enctype="multipart/form-data">




                    <div class="row">
                        <div class="col-md-4">
                            <label for="datetimepicker1">Sınav Tarihi</label>
                            <input type="hidden" name="event_date" id="datetimepicker1" data-plugin="datetimepicker" data-options="{ inline: true, viewMode: 'days', format : 'YYYY-MM-DD HH:mm:ss' }">
                        </div><!-- END column -->

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="egitimYili">Eğitim Yılı</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="2019 - 2020 (Şeklinde Giriniz)" name="egitimYili">
                                <?php if (isset($form_error)){ ?>
                                    <small class="input-form-error pull-right"><?= form_error("egitimYili"); ?></small>
                                <?php } ?>
                            </div>

                            <div class="form-group">
                                <label for="yariYil">Yarı Yıl</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Güz veya Yaz yarıyılı Şeklinde Giriniz" name="yariYil">
                                <?php if (isset($form_error)){ ?>
                                    <small class="input-form-error pull-right"><?= form_error("yariYil"); ?></small>
                                <?php } ?>
                            </div>

                            <div class="form-group">
                                <label for="oturum">Oturum</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="1. Oturum Şeklinde Giriniz" name="oturum">
                                <?php if (isset($form_error)){ ?>
                                    <small class="input-form-error pull-right"><?= form_error("oturum"); ?></small>
                                <?php } ?>
                            </div>
                        </div><!-- END column -->
                    </div>



                    <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
                    <a href="<?= base_url("courses"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>