<div class="row">

    <div class="col-md-12">
        <h4 class="m-b-lg">
            Yeni Ogrenci Ekle
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?= base_url("ogrenci/save"); ?>" method="post">

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">İsim Soyisim</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="İşi Anlatan Başlık Bilgisi" name="title" value="<?= isset($form_error) ? set_value("title") : ""; ?>">
                            <?php if (isset($form_error)){ ?>
                                <small class="input-form-error pull-right"><?= form_error("title"); ?></small>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12 categori_sec">
                            <label for="category_id">Fakülte</label>
                            <select  name="category_id" class="form-control"  id="category_id">

                                <?php foreach ($categories as $category):  ?>
                                    <option class="catSec" data-url="<?= base_url("ogrenci/categoriSec/{$category->id}"); ?>" value="<?= $category->id; ?>"><?= $category->title; ?></option>
                                <?php endforeach; ?>

                            </select>
                            <?php if (isset($form_error)){ ?>
                                <small class="input-form-error pull-right"><?= form_error("category_id"); ?></small>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Bölüm</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="İşi Anlatan Başlık Bilgisi" name="title" value="<?= isset($form_error) ? set_value("title") : ""; ?>">
                            <?php if (isset($form_error)){ ?>
                                <small class="input-form-error pull-right"><?= form_error("title"); ?></small>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Sınıf</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="İşi Anlatan Başlık Bilgisi" name="title" value="<?= isset($form_error) ? set_value("title") : ""; ?>">
                            <?php if (isset($form_error)){ ?>
                                <small class="input-form-error pull-right"><?= form_error("title"); ?></small>
                            <?php } ?>
                        </div>
                    </div>



                    <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
                    <a href="<?= base_url("ogrenci"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>