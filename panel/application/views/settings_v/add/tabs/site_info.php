<div role="tabpanel" class="tab-pane in active fade" id="tab-1">
    <h4 class="m-b-md">Site Bilgilerim</h4>

    <div class="row">
        <div class="form-group col-md-8">
            <label for="company_name">Şirket Adı</label>
            <input type="text" class="form-control" id="company_name" placeholder="Şirket veya Sitenizin Adı" name="company_name" value="<?= isset($form_error) ? set_value("company_name") : ""; ?>">
            <?php if (isset($form_error)){ ?>
                <small class="input-form-error pull-right"><?= form_error("company_name"); ?></small>
            <?php } ?>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-4">
            <label for="phone_1">Telefon 1</label>
            <input type="tel" class="form-control" id="phone_1" placeholder="Telefon Numaranız" name="phone_1" value="<?= isset($form_error) ? set_value("phone_1") : ""; ?>">
            <?php if (isset($form_error)){ ?>
                <small class="input-form-error pull-right"><?= form_error("phone_1"); ?></small>
            <?php } ?>
        </div>

        <div class="form-group col-md-4">
            <label for="phone_2">Telefon 2</label>
            <input type="tel" class="form-control" id="phone_2" placeholder="Diğer Telefon Numaranız ( Opsiyonel )" name="phone_2" value="<?= isset($form_error) ? set_value("phone_2") : ""; ?>">
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-4">
            <label for="fax_1">Fax 1</label>
            <input type="tel" class="form-control" id="fax_1" placeholder="Fax Numaranız" name="fax_1" value="<?= isset($form_error) ? set_value("fax_1") : ""; ?>">
        </div>

        <div class="form-group col-md-4">
            <label for="fax_2">Fax 2</label>
            <input type="tel" class="form-control" id="fax_2" placeholder="Diğer Fax Numaranız ( Opsiyonel )" name="fax_2" value="<?= isset($form_error) ? set_value("fax_2") : ""; ?>">
        </div>
    </div>

</div><!-- .tab-pane  -->