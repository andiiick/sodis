<table id="table_isi" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th width='10' class="text-center">No.</th>
            <th>Nama Isi Disposisi</th>
            <th width='50' class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($isi as $res) : ?>
            <tr>
                <td class="text-center"><?= $no++; ?>.</td>
                <td><?= $res['nmDisposisi']; ?></td>
                <td class="text-center">
                    <button class="btn btn-sm btn-light" data-toggle="dropdown" href="#">
                        <i class="icon-options"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <a href="javascript:void(0)" class="dropdown-item" onclick="edit('<?= $res['idIsi']; ?>')">
                            <i class="icon-note mr-2"></i> Update
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0)" class="dropdown-item" onclick="hapus('<?= $res['idIsi']; ?>' , '<?= $res['nmDisposisi']; ?>')">
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
        $("#table_isi").DataTable({
            responsive: true,
            autoWidth: false,
        });
    });

    function edit(idIsi) {
        $.ajax({
            type: "post",
            url: "<?= site_url('isiDispos/formedit') ?>",
            data: {
                idIsi: idIsi
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

    function hapus(idIsi, nama) {
        Swal.fire({
            title: 'Hapus Data?',
            html: `Anda akan menghapus data isi disposisi:<br> <b>${nama}</b>`,
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
                    url: "<?= site_url('isiDispos/hapusdata') ?>",
                    data: {
                        idIsi: idIsi
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Toast.fire({
                                icon: "success",
                                title: response.sukses,
                            });
                            datajenis();
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