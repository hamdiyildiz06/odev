<?php
$user  = get_active_user();
if ($stdid){
    $user->id = $stdid;
    $master = true;
}else{
    $user  = get_active_user();
}


?>
<div class="row">

    <div class="col-md-12">
        <h4 class="m-b-lg">
            Yeni Ders Ekle
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <table class="table table-hover table-bordered table-striped content-container">
                    <thead>
                    <tr>
                        <th class="w50">#id</th>
                        <th>Başlık</th>
                        <th class="text-center">İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <th class="text-center"><?= $item->id; ?></th>
                            <td><?= $item->title; ?></td>
                            <td class="text-center w100">
                                <?php
                                if ($master == true){
                                    $link = base_url("course_operations/save/{$item->id}/{$user->id}/{$master}");
                                }else{
                                    $link = base_url("course_operations/save/{$item->id}/{$user->id}");
                                }
                                ?>
                                <a href="<?= $link; ?>" class="btn btn-sm btn-info btn-outline"><i class="fa fa-pencil-square-o"></i> Ekle</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>