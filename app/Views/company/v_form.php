<?php foreach ($company as $res) : ?>
    <form class="formcompany" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div style="border:1px solid #CED4DA;padding:15px;">
            <input type="hidden" name="co_id" value="<?= $res['co_id']; ?>">
            <div class="pl-2 pr-2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Instansi: <b class="text-danger">*</b></label>
                            <input type="text" name="co_nm" id="co_nm" class="form-control" placeholder="Nama Instansi" style="text-transform: capitalize;" value="<?= $res['co_nm']; ?>" onchange="remove(id)" readonly>
                            <div class="invalid-feedback errorName"></div>
                        </div>
                        <div class="form-group">
                            <label>No. Telepon: <b class="text-danger">*</b></label>
                            <input type="text" name="co_phone" id="co_phone" class="form-control" placeholder="No. Telepon" style="text-transform: capitalize;" value="<?= $res['co_phone']; ?>" onchange="remove(id)" readonly>
                            <div class="invalid-feedback errorPhone"></div>
                        </div>
                        <div class="form-group">
                            <label>e-Mail: <b class="text-danger">*</b></label>
                            <input type="text" name="co_email" id="co_email" class="form-control" placeholder="e-Mail" value="<?= $res['co_email']; ?>" onchange="remove(id)" readonly>
                            <div class="invalid-feedback errorEmail"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Alamat: <b class="text-danger">*</b></label>
                            <textarea name="co_address" id="co_address" class="form-control" placeholder="Alamat ..." readonly><?= $res['co_address']; ?></textarea>
                            <div class="invalid-feedback errorAddress"></div>
                        </div>
                        <div class="form-group">
                            <label>Logo Instansi: <b class="text-danger">*</b></label><br>
                            <div class="row text-center">
                                <div class="col-sm-12 col-12">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width:485px;height:150px;border:2px solid #e2e2e2;border-radius: 5px;">
                                            <img src="<?= base_url(); ?>/img/company/<?= $res['co_logo']; ?>" style="width:100%;height:100%;">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="width:485px;height:150px;border:2px solid #e2e2e2;"></div>
                                        <div id="btnImg" class="d-none">
                                            <span class="btn btn-outline-info btn-file" style="cursor:pointer;">
                                                <span class="fileinput-new" style="padding-left:30px;padding-right:30px;">Browse File</span>
                                                <span class="fileinput-exists mr-1">Change</span>
                                                <input type="file" name="co_logo" id="co_logo" />
                                                <input type="hidden" name="logoLama" value="<?= $res['co_logo']; ?>">
                                            </span>
                                            <a href="javascript:void(0)" class="btn btn-outline-danger fileinput-exists" data-dismiss="fileinput" style="cursor:pointer;" id="remove">Remove</a>
                                        </div>
                                        <small class="errorLogo" style="color:#dc3545;font-size: 80%;margin-top: 0.25rem;"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    </div>
                </div>
            </div>
            <div class="modal-footer pl-0 pr-0 pb-0 justify-content-center">
                <div class="btn-group" role="group" style="box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12) !important;">
                    <button style="min-width:100px;" type="submit" class="btn btn-info" id="btnSimpan">Simpan</button>
                    <button style="min-width:100px;" type="button" class="btn btn-success" id="btnUpdate">Update</button>
                    <button style="min-width:100px;" type="button" class="btn btn-outline-secondary" id="btnBatal">Batal</button>
                </div>
            </div>
        </div>
    </form>
<?php endforeach ?>

<script>
    $(document).ready(function() {
        $('#btnSimpan').hide();
        $('#btnBatal').hide();
        $('#btnUpdate').click(function() {
            $('#btnUpdate').hide();
            $('#btnSimpan').show();
            $('#btnBatal').show();
            $('#co_nm').removeAttr('readonly');
            $('#co_phone').removeAttr('readonly');
            $('#co_email').removeAttr('readonly');
            $('#co_address').removeAttr('readonly');
            $('#btnImg').removeClass('d-none');
        });
        $('#btnBatal').click(function() {
            $('#btnUpdate').show();
            $('#btnSimpan').hide();
            $('#btnBatal').hide();
            $('#co_nm').attr('readonly', 'true');
            $('#co_phone').attr('readonly', 'true');
            $('#co_email').attr('readonly', 'true');
            $('#co_address').attr('readonly', 'true');
            $('#btnImg').addClass('d-none');
            $('.errorLogo').html('');
        });
        $('#remove').click(function(e) {
            e.preventDefault();
            $('.errorLogo').html('');
        });
        $('.formcompany').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "<?= base_url('company/updatedata'); ?>",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(response) {
                    if (response.error) {
                        if (response.error.co_nm) {
                            $('#co_nm').addClass('is-invalid');
                            $('.errorName').html(response.error.co_nm);
                        } else {
                            $('#co_nm').removeClass('is-invalid');
                            $('.errorName').html('');
                        }
                        if (response.error.co_phone) {
                            $('#co_phone').addClass('is-invalid');
                            $('.errorPhone').html(response.error.co_phone);
                        } else {
                            $('#co_phone').removeClass('is-invalid');
                            $('.errorPhone').html('');
                        }
                        if (response.error.co_email) {
                            $('#co_email').addClass('is-invalid');
                            $('.errorEmail').html(response.error.co_email);
                        } else {
                            $('#co_email').removeClass('is-invalid');
                            $('.errorEmail').html('');
                        }
                        if (response.error.co_address) {
                            $('#co_address').addClass('is-invalid');
                            $('.errorAddress').html(response.error.co_address);
                        } else {
                            $('#co_address').removeClass('is-invalid');
                            $('.errorAddress').html('');
                        }
                        if (response.error.co_logo) {
                            $('.errorLogo').html(response.error.co_logo);
                        } else {
                            $('.errorLogo').html('');
                        }
                    } else {
                        datacompany();
                        Toast.fire({
                            icon: "success",
                            title: response.sukses,
                        });
                        $('#btnUpdate').show();
                        $('#btnSimpan').hide();
                        $('#btnBatal').hide();
                        $('#co_nm').attr('readonly', 'true');
                        $('#co_phone').attr('readonly', 'true');
                        $('#co_email').attr('readonly', 'true');
                        $('#co_address').attr('readonly', 'true');
                        $('#btnImg').addClass('d-none');
                        _getLogo();
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