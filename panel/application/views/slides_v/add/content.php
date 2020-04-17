<div class="row">

    <div class="col-md-12">
        <h4 class="m-b-lg">
            Yeni Slayt Ekle
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?= base_url("slides/save"); ?>" method="post" enctype="multipart/form-data">

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

                    <div class="form-group image_upload_container">
                        <label for="exampleInputFile">Görsel Seçiniz</label>
                        <input type="file" name="img_url" id="exampleInputFile" class="form-control">
                    </div>

                    <div class="form-group image_upload_container">
                        <label for="exampleInputFile">Button Kullanımı</label><br>
                        <input
                                data-url=""
                                class="form-control button_usage_btn"
                                type="checkbox"
                                data-switchery
                                name="allowButton"
                                data-color="#10c469" />
                    </div>
                    
                    <div class="button-information-container" >
                        <div class="form-group">
                            <label for="button_caption">Button Başlık</label>
                            <input type="text" class="form-control" id="button_caption" placeholder="Butonun üzerindeki yazı" name="button_caption">
                            <?php if (isset($form_error)){ ?>
                                <small class="input-form-error pull-right"><?= form_error("button_caption"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="button_url">URL Bilgisi</label>
                            <input type="text" class="form-control" id="button_url" placeholder="Buttona basıldığında gidilecek URL bilgisi" name="button_url">
                            <?php if (isset($form_error)){ ?>
                                <small class="input-form-error pull-right"><?= form_error("button_url"); ?></small>
                            <?php } ?>
                        </div>
                    </div>
                    

                    <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
                    <a href="<?= base_url("slides"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>