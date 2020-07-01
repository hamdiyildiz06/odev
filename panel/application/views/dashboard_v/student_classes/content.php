<div class="row">

    <div class="col-md-12">
        <h4 class="m-b-lg">
            <?= get_student($stdid); ?> 'Ögrencisine Ait Ders Listesi
            <a href="<?= base_url("course_operations/new_form/{$stdid}"); ?>" class="btn pull-right btn-outline btn-primary btn-xs"><i class="fa fa-plus"></i> Yeni Ekle</a>
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget p-lg">
            <?php if (empty($items)){ ?>
                <div class="alert alert-info text-center ">
                    <h5 class="alert-title">Kayıt Bulunamadı</h5>
                    <p>Burada herhangi bir veri bulunamamaktadır. Eklemek için lütfen <a href="<?= base_url("course_operations/new_form"); ?>">Tıklayınız</a></p>
                </div>
            <?php }else{ ?>
                <table class="table table-hover table-bordered table-striped content-container">
                    <thead>
                        <tr>
                            <th class="w50">#id</th>
                            <th>Başlık</th>
                            <th class="text-center">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php $i= 1; foreach ($items as $item):  ?>
                    <tr>
                        <th class="text-center"><?= $i;  $i++; ?></th>
                        <td><?= get_lesson($item->lesson_id); ?></td>
                        <td class="text-center w100">
                            <button
                                    data-url="<?= base_url("course_operations/delete/{$item->id}"); ?>"
                                    class="btn btn-sm btn-danger btn-outline remove-btn">
                                    <i class="fa fa-trash-o"></i> Sil
                            </button>
                        </td>
                    </tr>
                <?php  endforeach; ?>
                    </tbody>
                </table>
            <?php } ?>
        </div><!-- .widget -->
    </div><!-- END column -->
</div>