        <!-- SIDEBAR MENU -->
        <aside class="main-sidebar sidebar-light-primary elevation-4 text-sm">
            <a href="javascript:void(0)" class="brand-link">
                <img id='logo' src="" class="brand-image d-nonew" style="opacity: .8;min-height:40px;width:100%;margin-left:0 !important;margin-right:0 !important;">
            </a>
            <div class="sidebar">
                <div class="user-panel mt-3 pb-2 mb-0 d-flex">
                    <div class="image" style="margin-top: 7px;">
                        <?php
                        if (empty(session()->get('foto')) && session()->get('jenisKelamin') == 'Laki-Laki') {
                            echo '<img src="' . base_url() . '/img/user/avatar.png" class="img-circle elevation-2">';
                        } else if (empty(session()->get('foto')) && session()->get('jenisKelamin') == 'Perempuan') {
                            echo '<img src="' . base_url() . '/img/user/avatar3.png" class="img-circle elevation-2">';
                        } else if (!empty(session()->get('foto'))) {
                            echo '<img src="' . base_url() . '/img/user/' . session()->get('foto') . '" class="img-circle elevation-2">';
                        }
                        ?>
                    </div>
                    <div class="info">
                        <small class="d-block" style="line-height:1.2;font-size:90%;"><b><?= session()->get('nama'); ?></b></small>
                        <small class="d-block"><?= session()->get('nmJabatan'); ?></small>
                        <small class="d-block"><?= session()->get('nip'); ?></small>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-header"><b style="font-size:13px;">Menu Navigasi</b></li>
                        <!-- MENU -->
                        <li class="nav-item">
                            <?php
                            if ($isi == 'v_dashboard') {
                                echo '<a href="' . base_url('dashboard') . '" class="nav-link active">';
                            } else {
                                echo '<a href="' . base_url('dashboard') . '" class="nav-link">';
                            } ?>
                            <i class="nav-icon icon-home"></i>
                            <p>Dashboard</p>
                            </a>
                        </li>
                        <?php
                        if ($isi == 'jabatan/v_jabatan' || $isi == 'klasifikasi/v_klasifikasi' || $isi == 'jenis/v_jenis' || $isi == 'sifat/v_sifat' || $isi == 'isiDispos/v_isiDispos') {
                            echo '<li class="nav-item has-treeview menu-open">';
                        } else {
                            echo '<li class="nav-item has-treeview">';
                        } ?>
                        <?php
                        if ($isi == 'jabatan/v_jabatan' || $isi == 'klasifikasi/v_klasifikasi' || $isi == 'jenis/v_jenis' || $isi == 'sifat/v_sifat' || $isi == 'isiDispos/v_isiDispos') {
                            echo '<a href="#" class="nav-link active">';
                        } else {
                            echo '<a href="#" class="nav-link">';
                        } ?>
                        <i class="nav-icon icon-folder"></i>
                        <p>
                            Master Data
                            <i class="right icon-arrow-left" style="font-size: 12px !important;margin-top: 1px !important;"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <?php
                                if ($isi == 'jabatan/v_jabatan') {
                                    echo '<a href="' . base_url('jabatan') . '" class="nav-link active">';
                                } else {
                                    echo '<a href="' . base_url('jabatan') . '" class="nav-link">';
                                } ?>
                                <i class="nav-icon icon-options" style="margin-left: 10px;font-size: 12px;"></i>
                                <p>Jabatan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <?php
                                if ($isi == 'jenis/v_jenis') {
                                    echo '<a href="' . base_url('jenis') . '" class="nav-link active">';
                                } else {
                                    echo '<a href="' . base_url('jenis') . '" class="nav-link">';
                                } ?>
                                <i class="nav-icon icon-options" style="margin-left: 10px;font-size: 12px;"></i>
                                <p>Jenis Surat</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <?php
                                if ($isi == 'klasifikasi/v_klasifikasi') {
                                    echo '<a href="' . base_url('klasifikasi') . '" class="nav-link active">';
                                } else {
                                    echo '<a href="' . base_url('klasifikasi') . '" class="nav-link">';
                                } ?>
                                <i class="nav-icon icon-options" style="margin-left: 10px;font-size: 12px;"></i>
                                <p>Klasifikasi Surat</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <?php
                                if ($isi == 'sifat/v_sifat') {
                                    echo '<a href="' . base_url('sifat') . '" class="nav-link active">';
                                } else {
                                    echo '<a href="' . base_url('sifat') . '" class="nav-link">';
                                } ?>
                                <i class="nav-icon icon-options" style="margin-left: 10px;font-size: 12px;"></i>
                                <p>Sifat Surat</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <?php
                                if ($isi == 'isiDispos/v_isiDispos') {
                                    echo '<a href="' . base_url('isiDispos') . '" class="nav-link active">';
                                } else {
                                    echo '<a href="' . base_url('isiDispos') . '" class="nav-link">';
                                } ?>
                                <i class="nav-icon icon-options" style="margin-left: 10px;font-size: 12px;"></i>
                                <p>Isi Disposisi Surat</p>
                                </a>
                            </li>
                        </ul>
                        </li>
                        <li class="nav-item">
                            <?php
                            if ($isi == 'user/v_user') {
                                echo '<a href="' . base_url('user') . '" class="nav-link active">';
                            } else {
                                echo '<a href="' . base_url('user') . '" class="nav-link">';
                            } ?>
                            <i class="nav-icon icon-people"></i>
                            <p>Data Pengguna</p>
                            </a>
                        </li>

                        <li class="nav-header" style="padding:0.5rem;font-size:13px;"><b>Data Surat</b></li>
                        <?php
                        if ($isi == 'formIN/v_formIN') {
                            echo '<li class="nav-item has-treeview menu-open">';
                        } else {
                            echo '<li class="nav-item has-treeview">';
                        } ?>
                        <?php
                        if ($isi == 'formIN/v_formIN') {
                            echo '<a href="#" class="nav-link active">';
                        } else {
                            echo '<a href="#" class="nav-link">';
                        } ?>
                        <i class="nav-icon icon-note"></i>
                        <p>
                            Form Surat
                            <i class="right icon-arrow-left" style="font-size: 12px !important;margin-top: 1px !important;"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <?php
                                if ($isi == 'formIN/v_formIN') {
                                    echo '<a href="' . base_url('formIN') . '" class="nav-link active">';
                                } else {
                                    echo '<a href="' . base_url('formIN') . '" class="nav-link">';
                                } ?>
                                <i class="nav-icon icon-options" style="margin-left: 10px;font-size: 12px;"></i>
                                <p>Surat Masuk</p>
                                </a>
                            </li>
                        </ul>
                        </li>
                        <?php
                        if ($isi == 'suratMasuk/v_suratMasuk') {
                            echo '<li class="nav-item has-treeview menu-open">';
                        } else {
                            echo '<li class="nav-item has-treeview">';
                        } ?>
                        <?php
                        if ($isi == 'suratMasuk/v_suratMasuk') {
                            echo '<a href="#" class="nav-link active">';
                        } else {
                            echo '<a href="#" class="nav-link">';
                        } ?>
                        <i class="nav-icon icon-drawer"></i>
                        <p>
                            Surat Masuk
                            <i class="right icon-arrow-left" style="font-size: 12px !important;margin-top: 1px !important;"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <?php
                                if ($isi == 'suratMasuk/v_suratMasuk') {
                                    echo '<a href="' . base_url('suratMasuk') . '" class="nav-link active">';
                                } else {
                                    echo '<a href="' . base_url('suratMasuk') . '" class="nav-link">';
                                } ?>
                                <i class="nav-icon icon-options" style="margin-left: 10px;font-size: 12px;"></i>
                                <p>Semua Surat</p>
                                </a>
                            </li>
                        </ul>
                        </li>

                        <li class="nav-header" style="padding:0.5rem;font-size:13px;"><b>Konfigurasi</b></li>
                        <?php
                        if ($isi == 'conApp/v_conApp' || $isi == 'company/v_company') {
                            echo '<li class="nav-item has-treeview menu-open">';
                        } else {
                            echo '<li class="nav-item has-treeview">';
                        } ?>
                        <?php
                        if ($isi == 'conApp/v_conApp' || $isi == 'company/v_company') {
                            echo '<a href="#" class="nav-link active">';
                        } else {
                            echo '<a href="#" class="nav-link">';
                        } ?>
                        <i class="nav-icon icon-settings"></i>
                        <p>
                            Pengaturan
                            <i class="right icon-arrow-left" style="font-size: 12px !important;margin-top: 1px !important;"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <?php
                                if ($isi == 'conApp/v_conApp') {
                                    echo '<a href="' . base_url('conApp') . '" class="nav-link active">';
                                } else {
                                    echo '<a href="' . base_url('conApp') . '" class="nav-link">';
                                } ?>
                                <i class="nav-icon icon-options" style="margin-left: 10px;font-size: 12px;"></i>
                                <p>Konfigurasi Aplikasi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <?php
                                if ($isi == 'company/v_company') {
                                    echo '<a href="' . base_url('company') . '" class="nav-link active">';
                                } else {
                                    echo '<a href="' . base_url('company') . '" class="nav-link">';
                                } ?>
                                <i class="nav-icon icon-options" style="margin-left: 10px;font-size: 12px;"></i>
                                <p>Instansi</p>
                                </a>
                            </li>
                        </ul>
                        </li>
                        <hr style="width: 100%;border-top: 1px solid #dee2e6;margin-top: 8px;margin-bottom: 10px;">
                        <li class="nav-item" style="padding-bottom: 50px;;">
                            <a href="<?= base_url('login/logout'); ?>" class="nav-link">
                                <i class="nav-icon icon-logout"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                        <!-- END MENU -->
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END SIDEBAR MENU -->