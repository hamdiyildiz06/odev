<div role="tabpanel" class="tab-pane fade" id="tab-6">
    <h4 class="m-b-md">Adres Bilgilerim</h4>
    <div class="form-group">
        <label for="address">Adres Bilgilerim</label>
        <textarea  class="m-0" data-plugin="summernote" data-options="{height: 250}" name="address">
                                    <?= isset($form_error) ? set_value("company_name") : $item->address; ?>
                                </textarea>
    </div>
</div><!-- .tab-pane  -->