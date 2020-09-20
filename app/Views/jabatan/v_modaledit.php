<!-- MODAL -->
<div class="modal fade" id="modaledit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="icon-note mr-1"></i> Update Data Jabatan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="icon-close" style="font-size:22px;color:#000;"></i></span>
                </button>
            </div>
            <?= form_open('jabatan/updatedata', ['class' => 'formjabatan']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <input type="hidden" name="idJabatan" value="<?= $idJabatan; ?>">
                <div class="pl-2 pr-2">
                    <div class="form-group">
                        <label>Kode: <b class="text-danger">*</b></label>
                        <input type="text" name="kdJabatan" id="kdJabatan" class="form-control" placeholder="Kode Jabatan" value="<?= $kdJabatan; ?>" onchange="remove(id)">
                        <div class="invalid-feedback errorCode"></div>
                    </div>
                    <div class="form-group">
                        <label>Nama Jabatan: <b class="text-danger">*</b></label>
                        <input type="text" name="nmJabatan" id="nmJabatan" class="form-control" placeholder="Nama Jabatan" style="text-transform: capitalize;" value="<?= $nmJabatan; ?>" onchange="remove(id)">
                        <div class="invalid-feedback errorName"></div>
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
        if (id) {
            $('#' + id).removeClass('is-invalid');
        }
    };
    $(document).ready(function() {
        $('.formjabatan').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.error) {
                        if (response.error.kdJabatan) {
                            $('#kdJabatan').addClass('is-invalid');
                            $('.errorCode').html(response.error.kdJabatan);
                        } else {
                            $('#kdJabatan').removeClass('is-invalid');
                            $('.errorCode').html('');
                        }
                        if (response.error.nmJabatan) {
                            $('#nmJabatan').addClass('is-invalid');
                            $('.errorName').html(response.error.nmJabatan);
                        } else {
                            $('#nmJabatan').removeClass('is-invalid');
                            $('.errorName').html('');
                        }
                    } else {
                        Toast.fire({
                            icon: "success",
                            title: response.sukses,
                        });
                        $('#modaledit').modal('hide');
                        datajabatan();
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