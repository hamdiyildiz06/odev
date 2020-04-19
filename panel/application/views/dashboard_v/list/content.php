<div class="row">
    <!-- new row -->
    <div class="col-md-3 col-sm-6">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">Ögrenci</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body p-t-lg">
                <div class="clearfix m-b-md">
                    <h3 class="pull-left text-primary m-0 fw-500"><span class="counter" data-plugin="counterUp">160</span> Öğrencimiz</h3>
                    <div class="pull-right watermark"><i class="fa fa-2x fa-user"></i></div>
                </div>
                <p class="m-b-0 text-muted">Consectetur adipisicing elit. Consequatur eaque corporis laudantium.</p>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->

    <div class="col-md-3 col-sm-6">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">Fakülte</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body p-t-lg">
                <div class="clearfix m-b-md">
                    <h3 class="pull-left text-success m-0 fw-500"><span class="counter" data-plugin="counterUp">960</span> Fakültemiz</h3>
                    <div class="pull-right watermark"><i class="fa fa-2x fa-university "></i></div>
                </div>
                <p class="m-b-0 text-muted">Consectetur adipisicing elit. Consequatur eaque corporis laudantium.</p>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->

    <div class="col-md-3 col-sm-6">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">Bölüm</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body p-t-lg">
                <div class="clearfix m-b-md">
                    <h3 class="pull-left text-warning m-0 fw-500"><span class="counter" data-plugin="counterUp">120</span> Bölümümüz</h3>
                    <div class="pull-right watermark"><i class="fa fa-2x fa-graduation-cap"></i></div>
                </div>
                <p class="m-b-0 text-muted">Consectetur adipisicing elit. Consequatur eaque corporis laudantium.</p>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->

    <div class="col-md-3 col-sm-6">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">Sınıf</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body p-t-lg">
                <div class="clearfix m-b-md">
                    <h3 class="pull-left text-danger m-0 fw-500"><span class="counter" data-plugin="counterUp">190</span> Sınıfımız</h3>
                    <div class="pull-right watermark"><i class="fa fa-2x fa-home"></i></div>
                </div>
                <p class="m-b-0 text-muted">Consectetur adipisicing elit. Consequatur eaque corporis laudantium.</p>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->

</div>

<div class="col-md-12">
    <div class="widget">
        <header class="widget-header">
            <h4 class="widget-title">Sınava Girecek Öğrenci Listemiz</h4>
            <a href="<?= base_url("dashboard/sinavKaristir"); ?>" class="btn pull-right btn-outline btn-primary btn-xs"><i class="fa fa-plus"></i> Sınav İçin Sınıf Belirle</a>
        </header><!-- .widget-header -->
        <hr class="widget-separator">
        <div class="widget-body">
            <div class="table-responsive">
                <table id="default-datatable" data-plugin="DataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="w50 text-center"><i class="fa fa-reorder"></i></th>
                        <th class="w50">#id</th>
                        <th>İsim Soyisim</th>
                        <th class="text-center">Fakülte</th>
                        <th class="text-center">Bölüm</th>
                        <th class="text-center">B.Türü</th>
                        <th class="text-center">Sınıf</th>
                        <th class="text-center">S.Sınıf</th>
                        <th class="text-center w200">İşlemler</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th class="w50 text-center"><i class="fa fa-reorder"></i></th>
                        <th class="w50">#id</th>
                        <th>İsim Soyisim</th>
                        <th class="text-center">Fakülte</th>
                        <th class="text-center">Bölüm</th>
                        <th class="text-center">B.Türü</th>
                        <th class="text-center">Sınıf</th>
                        <th class="text-center">S.Sınıf</th>
                        <th class="text-center w200">İşlemler</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php foreach ($items as $item): ?>
                        <?php $portfolyo = get_portfolyo($item->portfolyo_id);  ?>
                        <tr id="ord-<?= $item->id; ?>">
                            <th class="text-center"><i class="fa fa-reorder"></i></th>
                            <th class="text-center"><?= $item->id; ?></th>
                            <td><?= $item->title; ?></td>
                            <td class="text-center"><?=  get_category_title($item->category_id); ?></td>
                            <td class="text-center"><?= $portfolyo->title;  ?></td>
                            <td class="text-center"><?=  ($portfolyo->bolum_turu == 1) ? "N.Ö" : "İ:Ö"; ?></td>
                            <td class="text-center"><?=  get_brands_title($item->brands_id); ?></td>
                            <td class="text-center"><?=  get_brands_title($item->sbrands); ?></td>
                            <td class="text-center">
                                <button
                                    data-url="<?= base_url("ogrenci/delete/{$item->id}"); ?>"
                                    class="btn btn-sm btn-danger btn-outline remove-btn">
                                    <i class="fa fa-trash-o"></i> Sil
                                </button>
                                <a href="<?= base_url("ogrenci/update_form/{$item->id}"); ?>" class="btn btn-sm btn-info btn-outline"><i class="fa fa-pencil-square-o"></i> Düzenle</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div><!-- .widget-body -->
    </div><!-- .widget -->
</div><!-- END column -->