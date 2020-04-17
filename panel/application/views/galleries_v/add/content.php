<div class="row">

    <div class="col-md-12">
        <h4 class="m-b-lg">
            Yeni Ürün Ekle
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?= base_url("galleries/save"); ?>" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Galeri Adı</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Galerinin Adını Giriniz" name="title">
                        <?php if (isset($form_error)){ ?>
                            <small class="input-form-error pull-right"><?= form_error("title"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="control-demo-6" class="">Galeri Türü</label>
                        <div id="control-demo-6" class="" >
                            <select class="form-control news_type_select" name="gallery_type">
                                <option <?= (isset($gallery_type) && $gallery_type == "image") ? "selected" : ""; ?> value="image">Resim</option>
                                <option <?= (isset($gallery_type) && $gallery_type == "video") ? "selected" : ""; ?> value="video">Video</option>
                                <option <?= (isset($gallery_type) && $gallery_type == "file" ) ? "selected" : ""; ?> value="file">Dosya</option>
                            </select>
                        </div>
                    </div><!-- .form-group -->

                    <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
                    <a href="<?= base_url("galleries"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>