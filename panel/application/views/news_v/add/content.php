<div class="row">

    <div class="col-md-12">
        <h4 class="m-b-lg">
            Yeni Haber Ekle
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?= base_url("news/save"); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Başlık</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Başlık" name="title">
                        <?php if (isset($form_error)){ ?>
                            <small class="input-form-error pull-right"><?= form_error("title"); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Açıklama</label>
                        <textarea  class="m-0" data-plugin="summernote" data-options="{height: 250}" name="description"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="control-demo-6" class="">Haberin Türü</label>
                        <div id="control-demo-6" class="" >
                            <select class="form-control news_type_select" name="news_type">
                                <option <?= (isset($news_type) && $news_type == "image") ? "selected" : ""; ?> value="image">Resim</option>
                                <option <?= (isset($news_type) && $news_type == "video") ? "selected" : ""; ?> value="video">Video</option>
                            </select>
                        </div>
                    </div><!-- .form-group -->

                <?php if (isset($form_error)){ ?>

                    <div class="form-group image_upload_container" style="display: <?= ($news_type == "image") ? "block" : "none"; ?>">
                        <label for="exampleInputFile">Görsel Seçiniz</label>
                        <input type="file" name="img_url" id="exampleInputFile" class="form-control">
                    </div>
                    <div class="form-group video_url_container" style="display: <?= ($news_type == "video") ? "block" : "none"; ?>">
                        <label for="exampleInputEmail1">video URL</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Video bağlantısını buraya yapıştırınız..." name="video_url">
                        <?php if (isset($form_error)){ ?>
                            <small class="input-form-error pull-right"><?= form_error("video_url"); ?></small>
                        <?php } ?>
                    </div>

                <?php } else { ?>

                    <div class="form-group image_upload_container">
                        <label for="exampleInputFile">Görsel Seçiniz</label>
                        <input type="file" name="img_url" id="exampleInputFile" class="form-control">
                    </div>
                    <div class="form-group video_url_container">
                        <label for="exampleInputEmail1">video URL</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Video bağlantısını buraya yapıştırınız..." name="video_url">
                    </div>

                <?php } ?>


                    <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
                    <a href="<?= base_url("news"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>