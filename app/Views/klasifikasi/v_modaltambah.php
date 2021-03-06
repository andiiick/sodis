<!-- MODAL -->
<div class="modal fade" id="modaltambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="icon-plus mr-1"></i> Tambah Data Klasifikasi Surat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="icon-close" style="font-size:22px;color:#000;"></i></span>
                </button>
            </div>
            <?= form_open('klasifikasi/simpandata', ['class' => 'formklasifikasi']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="pl-2 pr-2">
                    <div class="form-group">
                        <label>Kode: <b class="text-danger">*</b></label>
                        <input type="text" name="kdKlas" id="kdKlas" class="form-control" placeholder="Kode Klasifikasi Surat" onchange="remove(id)">
                        <div class="invalid-feedback errorCode"></div>
                    </div>
                    <div class="form-group">
                        <label>Nama Klasifikasi Surat: <b class="text-danger">*</b></label>
                        <input type="text" name="nmKlas" id="nmKlas" class="form-control" placeholder="Nama Klasifikasi Surat" style="text-transform: capitalize;" onchange="remove(id)">
                        <div class="invalid-feedback errorName"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <div class="row w-100">
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-block btn-success mb-2 btnSimpan">Simpan</button>
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
        if (id) {
            $('#' + id).removeClass('is-invalid');
        }
    };
    $(document).ready(function() {
        $('.formklasifikasi').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.error) {
                        if (response.error.kdKlas) {
                            $('#kdKlas').addClass('is-invalid');
                            $('.errorCode').html(response.error.kdKlas);
                        } else {
                            $('#kdKlas').removeClass('is-invalid');
                            $('.errorCode').html('');
                        }
                        if (response.error.nmKlas) {
                            $('#nmKlas').addClass('is-invalid');
                            $('.errorName').html(response.error.nmKlas);
                        } else {
                            $('#nmKlas').removeClass('is-invalid');
                            $('.errorName').html('');
                        }
                    } else {
                        Toast.fire({
                            icon: "success",
                            title: response.sukses,
                        });
                        $('#modaltambah').modal('hide');
                        dataklasifikasi();
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