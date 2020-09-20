<table id="table_user" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th width='10' class="text-center">No.</th>
            <th>Data Pengguna</th>
            <th width='50' class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($user as $res) : ?>
            <tr>
                <td class="text-center"><?= $no++; ?>.</td>
                <td>
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        <li class="item" style="background: transparent;padding: 0;">
                            <div class="product-img" style="margin-top: 5px;">
                                <a href="javascript:void(0)" onclick="detail('<?= $res['idUser']; ?>','<?= $res['nmJabatan']; ?>')">
                                    <?php
                                    if (empty($res['foto']) && $res['jenisKelamin'] == 'Laki-Laki') {
                                        echo '<img src="' . base_url() . '/img/user/avatar.png" class="img-circle img-size-50">';
                                    } else if (empty($res['foto']) && $res['jenisKelamin'] == 'Perempuan') {
                                        echo '<img src="' . base_url() . '/img/user/avatar3.png" class="img-circle img-size-50">';
                                    } else if (!empty($res['foto'])) {
                                        echo '<img src="' . base_url() . '/img/user/' . $res['foto'] . '" class="img-circle img-size-50">';
                                    }
                                    ?>
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title" onclick="detail('<?= $res['idUser']; ?>','<?= $res['nmJabatan']; ?>')"><?= $res['nama']; ?></a>
                                <span class="product-description text-dark">
                                    <p style="font-size: 90%;margin-bottom: 0"><?= $res['nmJabatan']; ?></p>
                                    <p style="font-size: 90%;margin-bottom: 0"><?= $res['nip']; ?></p>
                                    <p style="font-size: 80%;margin-bottom: 0">
                                        <?php
                                        if ($res['status_cd'] == 'normal') {
                                            echo '<span class="badge bg-success" style="padding:4px;">Aktif</span>';
                                        } else {
                                            echo '<span class="badge bg-danger" style="padding:4px;">Non-Aktif</span>';
                                        }
                                        ?>
                                    </p>
                                </span>
                            </div>
                        </li>
                    </ul>
                </td>
                <td class="text-center">
                    <button class="btn btn-sm btn-light" data-toggle="dropdown" href="#">
                        <i class="icon-options"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <a href="javascript:void(0)" class="dropdown-item" onclick="edit('<?= $res['idUser']; ?>')">
                            <i class="icon-note mr-2"></i> Update
                        </a>
                        <?php if ($res['status_cd'] == 'normal') { ?>
                            <div class="dropdown-divider"></div>
                            <a href="javascript:void(0)" class="dropdown-item" onclick="deactive(' <?= $res['idUser']; ?>','<?= $res['nama']; ?>')">
                                <i class="icon-user-unfollow mr-2"></i> Deactive
                            </a>
                        <?php } ?>
                        <?php if ($res['status_cd'] == 'deactive') { ?>
                            <div class="dropdown-divider"></div>
                            <a href="javascript:void(0)" class="dropdown-item" onclick="active(' <?= $res['idUser']; ?>','<?= $res['nama']; ?>')">
                                <i class="icon-user-following mr-2"></i> Active
                            </a>
                        <?php } ?>
                        <?php if (session()->get('idUser') != $res['idUser']) { ?>
                            <div class="dropdown-divider"></div>
                            <a href="javascript:void(0)" class="dropdown-item" onclick="hapus(' <?= $res['idUser']; ?>','<?= $res['nama']; ?>')">
                                <i class="icon-close mr-2"></i> Delete
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $("#table_user").DataTable({
            responsive: true,
            autoWidth: false,
        });
    });

    function edit(idUser) {
        $.ajax({
            type: "post",
            url: "<?= site_url('user/formedit') ?>",
            data: {
                idUser: idUser
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaledit').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            },
        });
    }

    function deactive(idUser, nama) {
        Swal.fire({
            title: 'Nonaktif Akun?',
            html: `Anda akan menonaktifkan akun pengguna:<br> <b>${nama}</b>`,
            icon: 'warning',
            showCancelButton: true,
            showConfirmButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            cancelButtonText: 'Tidak, batalkan',
            confirmButtonText: 'Ya, proses',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('user/deactive') ?>",
                    data: {
                        idUser: idUser
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Toast.fire({
                                icon: "success",
                                title: response.sukses,
                            });
                            datauser();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    },
                });
            }
        });
    }

    function active(idUser, nama) {
        Swal.fire({
            title: 'Aktivasi Akun?',
            html: `Anda akan mengaktifkan akun pengguna:<br> <b>${nama}</b>`,
            icon: 'warning',
            showCancelButton: true,
            showConfirmButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            cancelButtonText: 'Tidak, batalkan',
            confirmButtonText: 'Ya, proses',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('user/active') ?>",
                    data: {
                        idUser: idUser
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Toast.fire({
                                icon: "success",
                                title: response.sukses,
                            });
                            datauser();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    },
                });
            }
        });
    }

    function hapus(idUser, nama) {
        Swal.fire({
            title: 'Hapus Data?',
            html: `Anda akan menghapus data pengguna:<br> <b>${nama}</b>`,
            icon: 'warning',
            showCancelButton: true,
            showConfirmButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            cancelButtonText: 'Tidak, batalkan',
            confirmButtonText: 'Ya, hapus',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('user/hapusdata') ?>",
                    data: {
                        idUser: idUser
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Toast.fire({
                                icon: "success",
                                title: response.sukses,
                            });
                            datauser();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    },
                });
            }
        });
    }

    function detail(idUser, nmJabatan) {
        $.ajax({
            type: "post",
            url: "<?= site_url('user/detail') ?>",
            data: {
                idUser: idUser,
                nmJabatan: nmJabatan
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaldetail').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            },
        });
    }
</script>