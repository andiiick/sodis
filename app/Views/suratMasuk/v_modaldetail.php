<!-- MODAL -->
<div class="modal fade" id="modaldetail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="icon-user mr-1"></i> Profil Pengguna</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="icon-close" style="font-size:22px;color:#000;"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card bg-light mb-0" style="border-radius:10px;">
                    <div class="card-header text-muted border-bottom-0"></div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-7">
                                <h2 class="lead mb-0"><b><?= $nama; ?></b></h2>
                                <p class="text-muted text-sm mb-0"><?= $nmJabatan; ?></p>
                                <p class="text-muted text-sm"><?= $nip; ?></p>
                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                    <li class="small mb-2">
                                        <span class="fa-li">
                                            <i class="icon-home" style="font-size: 1.33333em;line-height: .75em;vertical-align: -.0667em;font-weight:bold;color:rgb(3, 172, 14);"></i>
                                        </span>
                                        <?php
                                        if (!empty($alamat)) {
                                            echo '' . $alamat . '';
                                        } else {
                                            echo '<small class="text-danger"><i>Belum ada data yang ditambahkan.</i></small>';
                                        }
                                        ?>
                                    </li>
                                    <li class="small mb-1">
                                        <span class="fa-li">
                                            <i class="icon-phone" style="font-size: 1.33333em;line-height: .75em;vertical-align: -.0667em;font-weight:bold;color:rgb(3, 172, 14);"></i>
                                        </span>
                                        <?php
                                        if (!empty($telepon)) {
                                            echo '' . $telepon . '';
                                        } else {
                                            echo '<small class="text-danger"><i>Belum ada data yang ditambahkan.</i></small>';
                                        }
                                        ?>
                                    </li>
                                    <li class="small mb-1">
                                        <span class="fa-li">
                                            <i class="icon-envelope" style="font-size: 1.33333em;line-height: .75em;vertical-align: -.2667em;font-weight:bold;color:rgb(3, 172, 14);"></i>
                                        </span>
                                        <?php
                                        if (!empty($email)) {
                                            echo '' . $email . '';
                                        } else {
                                            echo '<small class="text-danger"><i>Belum ada data yang ditambahkan.</i></small>';
                                        }
                                        ?>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-5 text-center">
                                <?php
                                if (empty($foto) && $jenisKelamin == 'Laki-Laki') {
                                    echo '<img src="' . base_url() . '/img/user/avatar.png" class="img-circle img-fluid">';
                                } else if (empty($foto) && $jenisKelamin == 'Perempuan') {
                                    echo '<img src="' . base_url() . '/img/user/avatar3.png" class="img-circle img-fluid">';
                                } else if (!empty($foto)) {
                                    echo '<img src="' . base_url() . '/img/user/' . $foto . '" class="img-circle img-fluid">';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="card-footer">
                        <div class="text-right">
                            <a href="#" class="btn btn-sm bg-teal">
                                <i class="fas fa-comments"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-primary">
                                <i class="fas fa-user"></i> View Profile
                            </a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL -->