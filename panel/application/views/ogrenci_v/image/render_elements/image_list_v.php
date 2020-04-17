<?php if (empty($item_images)){ ?>
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
            <th class="text-center">Görsel</th>
            <th>Resim Adı</th>
            <th class="text-center">Durumu</th>
            <th class="text-center">Kapak</th>
            <th class="text-center">İşlem</th>
        </tr>
        </thead>
        <tbody class="sortable" data-url="<?= base_url("portfolio/imageRankSetter"); ?>">
        <?php foreach ($item_images as $image): ?>

            <tr id="ord-<?= $image->id; ?>">
                <th class="text-center"><i class="fa fa-reorder"></i></th>
                <th class="text-center"><?= $image->id; ?></th>
                <td class="w100 text-center">
                    <img width="30" src="<?php echo get_picture($viewFolder, $image->img_url, "255x157"); ?>" alt="" class="img-responsive">
                </td>
                <td><?= $image->img_url; ?></td>
                <td class="w100 text-center">
                    <input
                        data-url="<?= base_url("portfolio/imageIsActiveSetter/{$image->id}"); ?>"
                        class="isActive"
                        type="checkbox"
                        data-switchery
                        data-color="#10c469"
                        <?= ($image->isActive) ? "checked" : "";  ?>
                    />
                </td>
                <td class="w100 text-center">
                    <input
                        data-url="<?= base_url("portfolio/isCoverSetter/{$image->id}/{$image->portfolio_id}"); ?>"
                        class="isCover"
                        type="checkbox"
                        data-switchery
                        data-color="#ff5b5b"
                        <?= ($image->isCover) ? "checked" : "";  ?>
                    />
                </td>
                <td class="w100 text-center">
                    <button
                        data-url="<?= base_url("portfolio/imageDelete/{$image->id}/{$image->portfolio_id}"); ?>"
                        class="btn btn-sm btn-danger btn-outline remove-btn btn-block">
                        <i class="fa fa-trash-o"></i> Sil
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php } ?>