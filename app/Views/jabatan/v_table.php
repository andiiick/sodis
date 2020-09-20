<table id="table_jabatan" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th width='10' class="text-center">No.</th>
            <th width='50'>Kode</th>
            <th>Nama Jabatan</th>
            <th width='50' class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($jabatan as $res) : ?>
            <tr>
                <td class="text-center"><?= $no++; ?>.</td>
                <td><?= $res['kdJabatan']; ?></td>
                <td><?= $res['nmJabatan']; ?></td>
                <td class="text-center">
                    <button class="btn btn-sm btn-light" data-toggle="dropdown" href="#">
                        <i class="icon-options"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <a href="javascript:void(0)" class="dropdown-item" onclick="edit('<?= $res['idJabatan']; ?>')">
                            <i class="icon-note mr-2"></i> Update
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0)" class="dropdown-item" onclick="hapus('<?= $res['idJabatan']; ?>' , '<?= $res['nmJabatan']; ?>')">
                            <i class="icon-close mr-2"></i> Delete
                        </a>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $("#table_jabatan").DataTable({
            responsive: true,
            autoWidth: false,
        });
    });

    function edit(idJabatan) {
        $.ajax({
            type: "post",
            url: "<?= site_url('jabatan/formedit') ?>",
            data: {
                idJabatan: idJabatan
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

    function hapus(idJabatan, nama) {
        Swal.fire({
            title: 'Hapus Data?',
            html: `Anda akan menghapus data jabatan:<br> <b>${nama}</b>`,
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
                    url: "<?= site_url('jabatan/hapusdata') ?>",
                    data: {
                        idJabatan: idJabatan
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Toast.fire({
                                icon: "success",
                                title: response.sukses,
                            });
                            datajabatan();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    },
                });
            }
        });
    }
</script>