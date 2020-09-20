<!-- MODAL -->
<div class="modal fade" id="modaledit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="icon-note mr-1"></i> Update Data Pengguna</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="icon-close" style="font-size:22px;color:#000;"></i></span>
                </button>
            </div>
            <?= form_open('user/updatedata', ['class' => 'formuser']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <input type="hidden" name="idUser" value="<?= $idUser; ?>">
                <div class="pl-2 pr-2">
                    <div class="form-group">
                        <label>NIP/NIK: <b class="text-danger">*</b></label>
                        <input type="text" name="nip" id="nip" class="form-control" placeholder="NIP/NIK" value="<?= $nip; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap: <b class="text-danger">*</b></label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Lengkap" style="text-transform: capitalize;" value="<?= $nama; ?>" onchange="remove(id)">
                        <div class="invalid-feedback errorName"></div>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin: <b class="text-danger">*</b></label>
                        <select class="form-control select2" name="jenisKelamin" id="jenisKelamin" data-placeholder="-- Pilih Jenis Kelamin --" data-allow-clear="true" style="width: 100%;" onchange="remove(id)">
                            <option value="Laki-Laki" <?php if ($jenisKelamin == 'Laki-Laki') echo "selected"; ?>>Laki-Laki</option>
                            <option value="Perempuan" <?php if ($jenisKelamin == 'Perempuan') echo "selected"; ?>>Perempuan</option>
                        </select>
                        <div class="invalid-feedback errorGender"></div>
                    </div>
                    <div class="form-group">
                        <label>Akses: <b class="text-danger">*</b></label>
                        <select class="form-control select2" name="akses" id="akses" data-placeholder="-- Pilih Akses Pengguna --" data-allow-clear="true" style="width: 100%;" onchange="remove(id)">
                            <option value="Super User" <?php if ($akses == 'Super User') echo "selected"; ?>>Super User</option>
                            <option value="Administrator" <?php if ($akses == 'Administrator') echo "selected"; ?>>Administrator</option>
                            <option value="User" <?php if ($akses == 'User') echo "selected"; ?>>User</option>
                        </select>
                        <div class="invalid-feedback errorAkses"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <div class="row w-100">
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-block btn-info mb-2 btnUpdate">Update</button>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-block btn-outline-secondary mb-2" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<!-- END MODAL -->

<!-- SCRIPT -->
<script>
    function remove(id) {
        if (id != 'jenisKelamin' && id != 'akses') {
            $('#' + id).removeClass('is-invalid');
        } else {
            $('#' + id).removeClass('is-invalid');
            $('#' + id + '+ span').removeClass("is-invalid");
            $('#' + id + '+ span').focus(function() {
                $(this).removeClass("is-invalid");
            });
        }
    };
    $(document).ready(function() {
        $("#akses").select2();
        $("#jenisKelamin").select2();
        $('.formuser').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.error) {
                        if (response.error.nama) {
                            $('#nama').addClass('is-invalid');
                            $('.errorName').html(response.error.nama);
                        } else {
                            $('#nama').removeClass('is-invalid');
                            $('.errorName').html('');
                        }
                        if (response.error.jenisKelamin) {
                            $("#jenisKelamin + span").addClass("is-invalid");
                            $("#jenisKelamin + span").focus(function() {
                                $(this).addClass("is-invalid");
                            });
                            $('.errorGender').html(response.error.jenisKelamin);
                        } else {
                            $('#jenisKelamin').removeClass('is-invalid');
                            $("#jenisKelamin + span").removeClass("is-invalid");
                            $("#jenisKelamin + span").focus(function() {
                                $(this).removeClass("is-invalid");
                            });
                            $('.errorGender').html('');
                        }
                        if (response.error.akses) {
                            $("#akses + span").addClass("is-invalid");
                            $("#akses + span").focus(function() {
                                $(this).addClass("is-invalid");
                            });
                            $('.errorAkses').html(response.error.akses);
                        } else {
                            $('#akses').removeClass('is-invalid');
                            $("#akses + span").removeClass("is-invalid");
                            $("#akses + span").focus(function() {
                                $(this).removeClass("is-invalid");
                            });
                            $('.errorAkses').html('');
                        }
                    } else {
                        Toast.fire({
                            icon: "success",
                            title: response.sukses,
                        });
                        $('#modaledit').modal('hide');
                        datauser();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                },
            });
            return false;
        });
    });
</script>
<!-- END SCRIPT -->