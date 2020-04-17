<div role="tabpanel" class="tab-pane fade" id="tab-5">
    <h4 class="m-b-md">Sosyal Medya</h4>
    <div class="row">
        <div class="form-group col-md-8">
            <label for="email">E-Posta Adresiniz</label>
            <input type="email" class="form-control" id="email" placeholder="Şirketinize Ait E-Posta Adresiniz" name="email" value="<?= isset($form_error) ? set_value("email") : ""; ?>">
            <?php if (isset($form_error)){ ?>
                <small class="input-form-error pull-right"><?= form_error("email"); ?></small>
            <?php } ?>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-4">
            <label for="facebook">Facebook</label>
            <input type="text" class="form-control" id="facebook" placeholder="Facebook Adresiniz" name="facebook" value="<?= isset($form_error) ? set_value("facebook") : ""; ?>">
        </div>

        <div class="form-group col-md-4">
            <label for="twitter">Twitter</label>
            <input type="text" class="form-control" id="twitter" placeholder="Twitter Adresiniz" name="twitter" value="<?= isset($form_error) ? set_value("twitter") : ""; ?>">
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-4">
            <label for="instagram">İnstagram</label>
            <input type="text" class="form-control" id="instagram" placeholder="İnstagram Adresiniz" name="instagram" value="<?= isset($form_error) ? set_value("instagram") : ""; ?>">
        </div>

        <div class="form-group col-md-4">
            <label for="linkedin">Linkedin </label>
            <input type="text" class="form-control" id="linkedin" placeholder="Linkedin Adresiniz" name="linkedin" value="<?= isset($form_error) ? set_value("linkedin") : ""; ?>">
        </div>
    </div>
</div><!-- .tab-pane  -->