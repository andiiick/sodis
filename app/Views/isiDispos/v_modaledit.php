<!-- MODAL -->
<div class="modal fade" id="modaledit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="icon-note mr-1"></i> Update Data Isi Disposisi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="icon-close" style="font-size:22px;color:#000;"></i></span>
                </button>
            </div>
            <?= form_open('isiDispos/updatedata', ['class' => 'formisi']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <input type="hidden" name="idIsi" value="<?= $idIsi; ?>">
                <div class="pl-2 pr-2">
                    <div class="form-group">
                        <label>Nama Isi Disposisi: <b class="text-danger">*</b></label>
                        <input type="text" name="nmDisposisi" id="nmDisposisi" class="form-control" placeholder="Nama Isi Disposisi" style="text-transform: capitalize;" value="<?= $nmDisposisi; ?>" onchange="remove(id)">
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
        $('.formisi').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.error) {
                        if (response.error.nmDisposisi) {
                            $('#nmDisposisi').addClass('is-invalid');
                            $('.errorName').html(response.error.nmDisposisi);
                        } else {
                            $('#nmDisposisi').removeClass('is-invalid');
                            $('.errorName').html('');
                        }
                    } else {
                        Toast.fire({
                            icon: "success",
                            title: response.sukses,
                        });
                        $('#modaledit').modal('hide');
                        dataisi();
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