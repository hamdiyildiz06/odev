<div class="row">

    <div class="col-md-12">
        <h4 class="m-b-lg">
            "<strong><?= $gallery->title; ?></strong>" Galerisine Ailt Videolar...
            <a href="<?= base_url("galleries/new_gallery_video_form/{$gallery->id}"); ?>" class="btn pull-right btn-outline btn-primary btn-xs"><i class="fa fa-plus"></i> Yeni Ekle</a>
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget p-lg">
            <?php if (empty($items)){ ?>
                <div class="alert alert-info text-center ">
                    <h5 class="alert-title">Kayıt Bulunamadı</h5>
                    <p>Burada herhangi bir veri bulunamamaktadır. Eklemek için lütfen <a href="<?= base_url("galleries/new_gallery_video_form/{$gallery->id}"); ?>">Tıklayınız</a></p>
                </div>
            <?php }else{ ?>
                <table class="table table-hover table-bordered table-striped content-container">
                    <thead>
                        <tr>
                            <th class="w50 text-center"><i class="fa fa-reorder"></i></th>
                            <th class="w50">#id</th>
                            <th>Url</th>
                            <th class="text-center">Görsel</th>
                            <th class="text-center">Durumu</th>
                            <th class="text-center">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody class="sortable" data-url="<?= base_url("galleries/rankGalleryVideoSetter"); ?>">
                <?php foreach ($items as $item): ?>
                    <tr id="ord-<?= $item->id; ?>">
                        <th class="text-center"><i class="fa fa-reorder"></i></th>
                        <th class="text-center"><?= $item->id; ?></th>
                        <td><?= $item->url; ?></td>
                        <td class="text-center w200">
                            <iframe
                                    width="200"
                                    src="<?= $item->url; ?>"
                                    frameborder="0"
                                    allow="accelerometer;
                                    autoplay;
                                    encrypted-media;
                                    gyroscope;
                                    picture-in-picture"
                                    allowfullscreen>
                            </iframe>
                        </td>
                        <td class="text-center w100">
                            <input
                                    data-url="<?= base_url("galleries/galleryVideoIsActiveSetter/{$item->id}"); ?>"
                                    class="isActive"
                                    type="checkbox"
                                    data-switchery
                                    data-color="#10c469"
                                    <?= ($item->isActive) ? "checked" : "";  ?>
                            />
                        </td>
                        <td class="text-center w200">
                            <button
                                    data-url="<?= base_url("galleries/galleryVideoDelete/{$item->id}/{$item->gallery_id}"); ?>"
                                    class="btn btn-sm btn-danger btn-outline remove-btn">
                                    <i class="fa fa-trash-o"></i> Sil
                            </button>
                            <a href="<?= base_url("galleries/update_gallery_video_form/{$item->id}"); ?>" class="btn btn-sm btn-info btn-outline"><i class="fa fa-pencil-square-o"></i> Düzenle</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                    </tbody>
                </table>
            <?php } ?>
        </div><!-- .widget -->
    </div><!-- END column -->
</div>