<div class="row">

    <div class="col-md-12">
        <h4 class="m-b-lg">
            Yeni Portfolio Ekle
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?= base_url("portfolio/save"); ?>" method="post">

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Başlık</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="İşi Anlatan Başlık Bilgisi" name="title" value="<?= isset($form_error) ? set_value("title") : ""; ?>">
                            <?php if (isset($form_error)){ ?>
                                <small class="input-form-error pull-right"><?= form_error("title"); ?></small>
                            <?php } ?>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="category_id">Kategori</label>
                            <select name="category_id" class="form-control"  id="category_id">

                                <?php foreach ($categories as $category):  ?>
                                    <option value="<?= $category->id; ?>"><?= $category->title; ?></option>
                                <?php endforeach; ?>

                            </select>
                            <?php if (isset($form_error)){ ?>
                                <small class="input-form-error pull-right"><?= form_error("category_id"); ?></small>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="datetimepicker1">Bitirme Tarihi</label>
                            <input type="hidden" name="finishedAt" id="datetimepicker1" data-plugin="datetimepicker" data-options="{ inline: true, viewMode: 'days', format : 'YYYY-MM-DD HH:mm:ss' }"
                                   value="<?= isset($form_error) ? set_value("finishedAt") : ""; ?>">
                        </div><!-- END column -->
                        <div class="col-md-8">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="client">Müşteri</label>
                                    <input type="text" class="form-control" id="client" placeholder="İşi Yaptığınız Müşteri" name="client" value="<?= isset($form_error) ? set_value("client") : ""; ?>">
                                    <?php if (isset($form_error)){ ?>
                                        <small class="input-form-error pull-right"><?= form_error("client"); ?></small>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="place">Yer / Mekan</label>
                                    <input type="text" class="form-control" id="place" placeholder="İşi Yaptığınız Yer Mekan Bilgisi" name="place" value="<?= isset($form_error) ? set_value("place") : ""; ?>">
                                    <?php if (isset($form_error)){ ?>
                                        <small class="input-form-error pull-right"><?= form_error("place"); ?></small>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="portfolio_url">Yapılan İşin Bağlantısı ( URL )</label>
                                    <input type="text" class="form-control" id="portfolio_url" placeholder="Yapılan İşin İnternet Üzerindeki Bağlantısı" name="portfolio_url" value="<?= isset($form_error) ? set_value("portfolio_url") : ""; ?>">
                                    <?php if (isset($form_error)){ ?>
                                        <small class="input-form-error pull-right"><?= form_error("portfolio_url"); ?></small>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Açıklama</label>
                        <textarea  class="m-0" data-plugin="summernote" data-options="{height: 250}" name="description">
                            <?= isset($form_error) ? set_value("description") : ""; ?>
                        </textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
                    <a href="<?= base_url("portfolio"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>