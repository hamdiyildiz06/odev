<?php if (empty($items)){ ?>
    <div class="alert alert-info text-center ">
        <h5 class="alert-title">Kayıt Bulunamadı</h5>
        <p>Burada herhangi bir resim bulunamamaktadır.</p>
    </div>
<?php }else{ ?>
    <table class="table table-bordered table-striped table-hover pictures_list">
        <thead>
        <tr>
            <th class="w50 text-center"><i class="fa fa-reorder"></i></th>
            <th class="w50 text-center">#id</th>
            <th class="text-center">
                <?php if ($gallery_type == "image"){ ?>
                    Görseller
                <?php } elseif ($gallery_type == "file") {?>
                    Dosyalar
                <?php } ?>
            </th>
            <th>Resim Adı</th>
            <th class="text-center">Durumu</th>
            <th class="text-center">İşlem</th>
        </tr>
        </thead>
        <tbody class="sortable" data-url="<?= base_url("galleries/fileRankSetter/{$gallery_type}"); ?>">
        <?php foreach ($items as $item): ?>

            <tr id="ord-<?= $item->id; ?>">
                <th class="text-center"><i class="fa fa-reorder"></i></th>
                <th class="text-center"><?= $item->id; ?></th>
                <td class="w100 text-center">
                    <?php if ($gallery_type == "image"){ ?>
                        <img width="30" src="<?php echo base_url("{$item->url}"); ?>" alt="" class="img-responsive">
                    <?php } elseif ($gallery_type == "file") {?>
                        <i class="fa fa-folder-o fa-2x"></i>
                    <?php } ?>
                </td>
                <td><?= $item->url; ?></td>
                <td class="w100 text-center">
                    <input
                        data-url="<?= base_url("galleries/fileIsActiveSetter/{$item->id}/{$gallery_type}"); ?>"
                        class="isActive"
                        type="checkbox"
                        data-switchery
                        data-color="#10c469"
                        <?= ($item->isActive) ? "checked" : "";  ?>
                    />
                </td>
                <td class="w100 text-center">
                    <button
                        data-url="<?= base_url("galleries/fileDelete/{$item->id}/{$item->gallery_id}/{$gallery_type}"); ?>"
                        class="btn btn-sm btn-danger btn-outline remove-btn btn-block">
                        <i class="fa fa-trash-o"></i> Sil
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php } ?>