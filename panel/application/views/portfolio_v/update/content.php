<div class="row">

    <div class="col-md-12">
        <h4 class="m-b-lg">
            "<strong><?= $item->title; ?></strong>" Kaydını Düzenle
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?= base_url("portfolio/Update/{$item->id}"); ?>" method="post">

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Başlık</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="İşi Anlatan Başlık Bilgisi" name="title" value="<?= isset($form_error) ? set_value("title") : $item->title; ?>">
                            <?php if (isset($form_error)){ ?>
                                <small class="input-form-error pull-right"><?= form_error("title"); ?></small>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="category_id">Kategori</label>
                            <select name="category_id" class="form-control">

                                <?php foreach ($categories as $category): ?>
                                    <?php $category_id = empty($form_error) ? $item->category_id : set_value("category_id") ; ?>
                                    <option <?= ($category->id === $category_id) ? "selected" : null; ?> value="<?= $category->id ?>"><?= $category->title; ?></option>
                                <?php endforeach; ?>

                            </select>
                            <?php if (isset($form_error)){ ?>
                                <small class="input-form-error pull-right"><?= form_error("category_id"); ?></small>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="category_id">Bölüm Türü</label>
                            <select name="bolum_turu" class="form-control"  id="bolum_turu">
                                <option value="1" <?= ($item->bolum_turu == '1') ? 'selected' : null; ?>>N.Ö</option>
                                <option value="2" <?= ($item->bolum_turu == '2') ? 'selected' : null; ?>>İ.Ö</option>
                            </select>
                            <?php if (isset($form_error)){ ?>
                                <small class="input-form-error pull-right"><?= form_error("bolum_turu"); ?></small>
                            <?php } ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
                    <a href="<?= base_url("portfolio"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>