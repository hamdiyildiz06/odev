<?php $user = get_active_user(); ?>
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
                    <h3 class="pull-left text-primary m-0 fw-500"><span class="counter" data-plugin="counterUp"><?= $ogren ?></span> Öğrencimiz</h3>
                    <div class="pull-right watermark"><i class="fa fa-2x fa-user"></i></div>
                </div>
                <p class="m-b-0 text-muted text-center">Üniversitemize Bünyesinde Bulunan Toplam <br> Ögrenci Sayımız</p>
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
                    <h3 class="pull-left text-success m-0 fw-500"><span class="counter" data-plugin="counterUp"><?= $fakulte ?></span> Fakültemiz</h3>
                    <div class="pull-right watermark"><i class="fa fa-2x fa-university "></i></div>
                </div>
                <p class="m-b-0 text-muted text-center">Üniversitemize Bünyesinde Bulunan Toplam <br> Fakülte Sayımız</p>
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
                    <h3 class="pull-left text-warning m-0 fw-500"><span class="counter" data-plugin="counterUp"><?= $bolum ?></span> Bölümümüz</h3>
                    <div class="pull-right watermark"><i class="fa fa-2x fa-graduation-cap"></i></div>
                </div>
                <p class="m-b-0 text-muted text-center">Üniversitemize Bünyesinde Bulunan Toplam <br> Bölüm Sayımız</p>
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
                    <h3 class="pull-left text-danger m-0 fw-500"><span class="counter" data-plugin="counterUp"><?= $sinif ?></span> Sınıfımız</h3>
                    <div class="pull-right watermark"><i class="fa fa-2x fa-home"></i></div>
                </div>
                <p class="m-b-0 text-muted text-center">Üniversitemize Bünyesinde Bulunan Toplam <br> Sınıf Sayımız</p>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->

</div>


<?php if($user->rutbe == 1){ ?>


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
                        <th class="text-center">Sıra</th>
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
                        <th class="text-center">Sıra</th>
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
                            <td class="text-center"><?=  $item->sira; ?></td>
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

<?php } else { ?>

    <div class="row">
        <div class="col-md-12">
            <h4 class="m-b-lg">
                "<strong><?= $user->title; ?></strong>" Kullanıcısını Görüntülüyorsunuz...
            </h4>
        </div><!-- END column -->
        <div class="col-md-offset-4 col-md-4">
            <div class="widget">
                <div class="widget-body">
                    <form action="<?= base_url("users/update/{$user->id}"); ?>" method="post">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Öğrenci Adı</label>
                            <input type="text" class="form-control" disabled id="exampleInputEmail1" placeholder="Kullanıcı Adı" name="user_name" value="<?= isset($form_error) ? set_value("user_name") : $user->title; ?>">
                            <?php if (isset($form_error)){ ?>
                                <small class="input-form-error pull-right"><?= form_error("user_name"); ?></small>
                            <?php } ?>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Fakülte</label>
                            <input type="text" class="form-control" disabled id="exampleInputEmail1" placeholder="Ad Soyad" name="full_name" value="<?= isset($form_error) ? set_value("full_name") : get_category_title($user->category_id); ?>">
                            <?php if (isset($form_error)){ ?>
                                <small class="input-form-error pull-right"><?= form_error("full_name"); ?></small>
                            <?php } ?>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Bölüm</label>
                            <input type="email" class="form-control" disabled id="exampleInputEmail1" placeholder="E-Posta Adresi" name="email" value="<?= isset($form_error) ? set_value("email") : get_portfolyo($user->portfolyo_id)->title; ?>">
                            <?php if (isset($form_error)){ ?>
                                <small class="input-form-error pull-right"><?= form_error("email"); ?></small>
                            <?php } ?>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Öğrenim Türü</label>
                            <input type="email" class="form-control" disabled id="exampleInputEmail1" placeholder="E-Posta Adresi" name="email" value="<?= isset($form_error) ? set_value("email") : (get_portfolyo($user->portfolyo_id)->bolum_turu == 1) ? "Normal Öğretim" : "İkinci Öğretim" ?>">
                            <?php if (isset($form_error)){ ?>
                                <small class="input-form-error pull-right"><?= form_error("email"); ?></small>
                            <?php } ?>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Eğitim Öğretim Yılı</label>
                            <input type="email" class="form-control" disabled id="exampleInputEmail1" placeholder="E-Posta Adresi" name="email" value="<?= isset($form_error) ? set_value("email") : $courses->egitimYili; ?>">
                            <?php if (isset($form_error)){ ?>
                                <small class="input-form-error pull-right"><?= form_error("email"); ?></small>
                            <?php } ?>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Yarı Yıl</label>
                            <input type="email" class="form-control" disabled id="exampleInputEmail1" placeholder="E-Posta Adresi" name="email" value="<?= isset($form_error) ? set_value("email") : $courses->yariYil; ?>">
                            <?php if (isset($form_error)){ ?>
                                <small class="input-form-error pull-right"><?= form_error("email"); ?></small>
                            <?php } ?>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Sınav</label>
                            <input type="email" class="form-control" disabled id="exampleInputEmail1" placeholder="E-Posta Adresi" name="email" value="<?= isset($form_error) ? set_value("email") : $courses->sinav; ?>">
                            <?php if (isset($form_error)){ ?>
                                <small class="input-form-error pull-right"><?= form_error("email"); ?></small>
                            <?php } ?>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Sınav Tarihi</label>
                            <input type="email" class="form-control" disabled id="exampleInputEmail1" placeholder="E-Posta Adresi" name="email" value="<?= isset($form_error) ? set_value("email") : get_readable_date($courses->event_date); ?>">
                            <?php if (isset($form_error)){ ?>
                                <small class="input-form-error pull-right"><?= form_error("email"); ?></small>
                            <?php } ?>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Sınav Saati</label>
                            <input type="email" class="form-control" disabled id="exampleInputEmail1" placeholder="E-Posta Adresi" name="email" value="<?= isset($form_error) ? set_value("email") : get_readable_clock($courses->event_date); ?>">
                            <?php if (isset($form_error)){ ?>
                                <small class="input-form-error pull-right"><?= form_error("email"); ?></small>
                            <?php } ?>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Oturum</label>
                            <input type="email" class="form-control" disabled id="exampleInputEmail1" placeholder="E-Posta Adresi" name="email" value="<?= isset($form_error) ? set_value("email") : $courses->oturum; ?>">
                            <?php if (isset($form_error)){ ?>
                                <small class="input-form-error pull-right"><?= form_error("email"); ?></small>
                            <?php } ?>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Sınav Yeri Ve Salonu</label>
                            <input type="email" class="form-control" disabled id="exampleInputEmail1" placeholder="E-Posta Adresi" name="email" value="<?= isset($form_error) ? set_value("email") : get_brands_title($user->sbrands); ?>">
                            <?php if (isset($form_error)){ ?>
                                <small class="input-form-error pull-right"><?= form_error("email"); ?></small>
                            <?php } ?>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Sıra No</label>
                            <input type="email" class="form-control" disabled id="exampleInputEmail1" placeholder="E-Posta Adresi" name="email" value="<?= isset($form_error) ? set_value("email") :$user->sira; ?>">
                            <?php if (isset($form_error)){ ?>
                                <small class="input-form-error pull-right"><?= form_error("email"); ?></small>
                            <?php } ?>
                        </div>

                    </form>
                </div><!-- .widget-body -->
            </div><!-- .widget -->
        </div><!-- END column -->
    </div>


<?php } ?>



<?php


?>
