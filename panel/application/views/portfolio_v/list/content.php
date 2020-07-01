<div class="row">

    <div class="col-md-12">
        <h4 class="m-b-lg">
            Portfolio Listesi
            <a href="<?= base_url("portfolio/new_form"); ?>" class="btn pull-right btn-outline btn-primary btn-xs"><i class="fa fa-plus"></i> Yeni Ekle</a>
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget p-lg">
            <?php if (empty($items)){ ?>
                <div class="alert alert-info text-center ">
                    <h5 class="alert-title">Kayıt Bulunamadı</h5>
                    <p>Burada herhangi bir veri bulunamamaktadır. Eklemek için lütfen <a href="<?= base_url("portfolio/new_form"); ?>">Tıklayınız</a></p>
                </div>
            <?php }else{ ?>
                <table class="table table-hover table-bordered table-striped content-container">
                    <thead>
                        <tr>
                            <th class="w50">#id</th>
                            <th class="text-center">Fakülte</th>
                            <th>Bölüm</th>
                            <th>Bölüm T.</th>
                            <th>Durumu</th>
                            <th class="text-center">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody class="sortable" data-url="<?= base_url("portfolio/rankSetter"); ?>">
                <?php foreach ($items as $item): ?>
                    <tr id="ord-<?= $item->id; ?>">
                        <th><?= $item->id; ?></th>
                        <td><?=  get_category_title($item->category_id); ?></td>
                        <td><?= $item->title; ?></td>
                        <td class="text-center"><?= ($item->bolum_turu == 1) ? "N.Ö" : "İ.Ö"; ?></td>
                        <td>
                            <input
                                    data-url="<?= base_url("portfolio/isActiveSetter/{$item->id}"); ?>"
                                    class="isActive"
                                    type="checkbox"
                                    data-switchery
                                    data-color="#10c469"
                                    <?= ($item->isActive) ? "checked" : "";  ?>
                            />
                        </td>
                        <td class="text-center">
                            <button
                                    data-url="<?= base_url("portfolio/delete/{$item->id}"); ?>"
                                    class="btn btn-sm btn-danger btn-outline remove-btn">
                                    <i class="fa fa-trash-o"></i> Sil
                            </button>
                            <a href="<?= base_url("portfolio/update_form/{$item->id}"); ?>" class="btn btn-sm btn-info btn-outline"><i class="fa fa-pencil-square-o"></i> Düzenle</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                    </tbody>
                </table>
            <?php } ?>
        </div><!-- .widget -->
    </div><!-- END column -->
</div>