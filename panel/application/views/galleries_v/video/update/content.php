<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            <?php
              //  print_r($item);
            ?>
            "<strong><?= $item->url; ?></strong>" Kaydını Düzenle
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?= base_url("galleries/gallery_video_update/{$item->id}/{$item->gallery_id}"); ?>" method="post">

                    <div class="form-group">
                        <label for="exampleInputEmail1">video URL</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Video bağlantısını buraya yapıştırınız..." name="url" value="<?= $item->url; ?>">
                        <?php if (isset($form_error)){ ?>
                            <small class="input-form-error pull-right"><?= form_error("url"); ?></small>
                        <?php } ?>
                    </div>

                    <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
                    <a href="<?= base_url("galleries/gallery_video_list/{$item->gallery_id}"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>