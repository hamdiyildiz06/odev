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
                            <label for="exampleInputEmail1">T.C</label>
                            <input type="text" class="form-control" disabled id="exampleInputEmail1" placeholder="T.C" name="tc" value="<?= isset($form_error) ? set_value("tc") : $user->tc; ?>">
                            <?php if (isset($form_error)){ ?>
                                <small class="input-form-error pull-right"><?= form_error("tc"); ?></small>
                            <?php } ?>
                        </div>

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
                            <input type="text" class="form-control" disabled id="exampleInputEmail1" placeholder="E-Posta Adresi" name="bölüm" value="<?= isset($form_error) ? set_value("bölüm") : get_portfolyo($user->portfolyo_id)->title; ?>">
                            <?php if (isset($form_error)){ ?>
                                <small class="input-form-error pull-right"><?= form_error("email"); ?></small>
                            <?php } ?>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Öğrenim Türü</label>
                            <input type="text" class="form-control" disabled id="exampleInputEmail1" placeholder="E-Posta Adresi" name="öğrenim" value="<?= isset($form_error) ? set_value("öğrenim") : (get_portfolyo($user->portfolyo_id)->bolum_turu == 1) ? "Normal Öğretim" : "İkinci Öğretim" ?>">
                            <?php if (isset($form_error)){ ?>
                                <small class="input-form-error pull-right"><?= form_error("email"); ?></small>
                            <?php } ?>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Vekil Öğretmen</label>
                            <input type="text" class="form-control" disabled id="exampleInputEmail1" placeholder="Vekil Öğretmen" name="teacher" value="<?= isset($form_error) ? set_value("teacher") : get_teacher($user->vteacher); ?>">
                            <?php if (isset($form_error)){ ?>
                                <small class="input-form-error pull-right"><?= form_error("email"); ?></small>
                            <?php } ?>
                        </div>

                    </form>
                </div><!-- .widget-body -->
            </div><!-- .widget -->
        </div><!-- END column -->
    </div>

