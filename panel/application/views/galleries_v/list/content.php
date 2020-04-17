<div class="row">

    <div class="col-md-12">
        <h4 class="m-b-lg">
            Galeri listesi
            <a href="<?= base_url("galleries/new_form"); ?>" class="btn pull-right btn-outline btn-primary btn-xs"><i class="fa fa-plus"></i> Yeni Ekle</a>
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget p-lg">
            <?php if (empty($items)){ ?>
                <div class="alert alert-info text-center ">
                    <h5 class="alert-title">Kayıt Bulunamadı</h5>
                    <p>Burada herhangi bir veri bulunamamaktadır. Eklemek için lütfen <a href="<?= base_url("galleries/new_form"); ?>">Tıklayınız</a></p>
                </div>
            <?php }else{ ?>
                <table class="table table-hover table-bordered table-striped content-container">
                    <thead>
                        <tr>
                            <th class="w50 text-center"><i class="fa fa-reorder"></i></th>
                            <th class="w50">#id</th>
                            <th>Galeri Adı</th>
                            <th class="text-center">Galeri Türü</th>
                            <th>Klasör Adı</th>
                            <th>Url</th>
                            <th class="text-center w100">Durumu</th>
                            <th class="text-center">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody class="sortable" data-url="<?= base_url("galleries/rankSetter"); ?>">
                <?php foreach ($items as $item): ?>
                    <tr id="ord-<?= $item->id; ?>">
                        <th class="text-center"><i class="fa fa-reorder"></i></th>
                        <th class="text-center"><?= $item->id; ?></th>
                        <td><?= $item->title; ?></td>
                        <td class="text-center"><?= $item->gallery_type; ?></td>
                        <td><?= $item->folder_name; ?></td>
                        <td><?= $item->url; ?></td>
                        <td class="text-center w100">
                            <input
                                    data-url="<?= base_url("galleries/isActiveSetter/{$item->id}"); ?>"
                                    class="isActive"
                                    type="checkbox"
                                    data-switchery
                                    data-color="#10c469"
                                    <?= ($item->isActive) ? "checked" : "";  ?>
                            />
                        </td>
                        <td class="text-center">
                            <button
                                    data-url="<?= base_url("galleries/delete/{$item->id}"); ?>"
                                    class="btn btn-sm btn-danger btn-outline remove-btn">
                                    <i class="fa fa-trash-o"></i> Sil
                            </button>
                            <a href="<?= base_url("galleries/update_form/{$item->id}"); ?>" class="btn btn-sm btn-info btn-outline"><i class="fa fa-pencil-square-o"></i> Düzenle</a>

                            <?php
                                if ($item->gallery_type == "image"){
                                    $buttton_icon = "fa-file-image-o";
                                    $buttton_text = "Resimler";
                                    $button_url   = "galleries/upload_form/{$item->id}";
                                }elseif ($item->gallery_type == "video") {
                                    $buttton_icon = "fa-play-circle-o";
                                    $buttton_text = "Videolar";
                                    $button_url   = "galleries/gallery_video_list/{$item->id}";
                                }else{
                                    $buttton_icon = "fa-folder-o";
                                    $buttton_text = "Dosyalar";
                                    $button_url   = "galleries/upload_form/{$item->id}";
                                }
                            ?>

                            <a href="<?= base_url($button_url); ?>" class="btn btn-sm btn-dark btn-outline"><i class="fa <?= $buttton_icon; ?>"></i> <?= $buttton_text; ?></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                    </tbody>
                </table>
            <?php } ?>
        </div><!-- .widget -->
    </div><!-- END column -->
</div>