<div class="row">

    <div class="col-md-12">
        <h4 class="m-b-lg">
            Yeni Marka Ekle
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?= base_url("brands/save"); ?>" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Sınıf Adı</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Sınıf Adını Giriniz" name="title">
                        <?php if (isset($form_error)){ ?>
                            <small class="input-form-error pull-right"><?= form_error("title"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Sınıf Mevcudu</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Sınıf Mevcudunu giriniz" name="mevcut">
                        <?php if (isset($form_error)){ ?>
                            <small class="input-form-error pull-right"><?= form_error("mevcut"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="category_id">Fakülte</label>
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


                    <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
                    <a href="<?= base_url("brands"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>