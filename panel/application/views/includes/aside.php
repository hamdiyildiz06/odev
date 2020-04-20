<?php $user = get_active_user(); ?>
<?php $settings = get_settings(); ?>

<aside id="menubar" class="menubar light">
    <div class="app-user">
        <div class="media">
            <div class="media-left">
                <div class="avatar avatar-md avatar-circle">
                    <a href="<?= base_url(); ?>">
                        <img class="img-responsive" src="<?= base_url("assets"); ?>/assets/images/221.jpg"
                             alt="<?= convertToSEO($settings->company_name); ?>"/>
                    </a>
                </div><!-- .avatar -->
            </div>
            <div class="media-body">
                <div class="foldable">
                    <h5><a href="<?= base_url(); ?>" class="username"><?= $user->title; ?></a></h5>
                    <ul>
                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle usertitle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <small>İşlemler</small>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu animated flipInY">
                                <li>
                                    <a class="text-color" href="<?= base_url("logout"); ?>">
                                        <span class="m-r-xs"><i class="fa fa-power-off"></i></span>
                                        <span>Çıkış</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div><!-- .media-body -->
        </div><!-- .media -->
    </div><!-- .app-user -->

    <div class="menubar-scroll">
        <div class="menubar-scroll-inner">
            <ul class="app-menu">

                <li>
                    <a href="<?= base_url(); ?>">
                        <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>

                <?php if ($user->rutbe == 1){ ?>
                <li class="has-submenu">
                    <a href="javascript:void(0)" class="submenu-toggle">
                        <i class="menu-icon fa fa-asterisk"></i>
                        <span class="menu-text">Fakülte ve Bölümler</span>
                        <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                    </a>
                    <ul class="submenu">
                        <li><a href="<?= base_url("portfolio_categories"); ?>"><span class="menu-text">Fakülte Ekle</span></a></li>
                        <li><a href="<?= base_url("portfolio"); ?>"><span class="menu-text">Bölüm ekle</span></a></li>
                    </ul>
                </li>
                <?php } ?>

                <?php if ($user->rutbe == 1){ ?>
                <li>
                    <a href="<?= base_url("brands"); ?>">
                        <i class="menu-icon zmdi zmdi-puzzle-piece zmdi-hc-lg"></i>
                        <span class="menu-text">Sınıf işlemleri</span>
                    </a>
                </li>
                <?php } ?>

                <?php if ($user->rutbe == 1){ ?>
                <li>
                    <a href="<?= base_url("ogrenci"); ?>">
                        <i class="menu-icon fa fa-user-secret"></i>
                        <span class="menu-text">Ögrenci Kayıt</span>
                    </a>
                </li>
                <?php } ?>

                <?php if ($user->rutbe == 1){ ?>
                <li>
                    <a href="<?= base_url("courses"); ?>">
                        <i class="menu-icon fa fa-calendar"></i>
                        <span class="menu-text">Sınav İşlemleri</span>
                    </a>
                </li>
                <?php } ?>
            </ul><!-- .app-menu -->
        </div><!-- .menubar-scroll-inner -->
    </div><!-- .menubar-scroll -->
</aside>