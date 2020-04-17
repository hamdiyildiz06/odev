<div class="row">

    <div class="col-md-12">
        <h4 class="m-b-lg">
            Yeni Marka Ekle
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?= base_url("brands/save"); ?>" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Başlık</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Başlık" name="title">
                        <?php if (isset($form_error)){ ?>
                            <small class="input-form-error pull-right"><?= form_error("title"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group image_upload_container">
                        <label for="exampleInputFile">Görsel Seçiniz</label>
                        <input type="file" name="img_url" id="exampleInputFile" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
                    <a href="<?= base_url("brands"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>