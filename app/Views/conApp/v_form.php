<?php foreach ($conapp as $res) : ?>
    <form class="formconapp" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div style="border:1px solid #CED4DA;padding:15px;">
            <input type="hidden" name="id" value="<?= $res['id']; ?>">
            <div class="pl-2 pr-2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Aplikasi: <b class="text-danger">*</b></label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Aplikasi" style="text-transform: capitalize;" value="<?= $res['nama']; ?>" onchange="remove(id)" readonly>
                            <div class="invalid-feedback errorName"></div>
                        </div>
                        <div class="form-group">
                            <label>No. Telepon: <b class="text-danger">*</b></label>
                            <input type="text" name="telepon" id="telepon" class="form-control" placeholder="No. Telepon" style="text-transform: capitalize;" value="<?= $res['telepon']; ?>" onchange="remove(id)" readonly>
                            <div class="invalid-feedback errorPhone"></div>
                        </div>
                        <div class="form-group">
                            <label>e-Mail: <b class="text-danger">*</b></label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="e-Mail" value="<?= $res['email']; ?>" onchange="remove(id)" readonly>
                            <div class="invalid-feedback errorEmail"></div>
                        </div>
                        <div class="form-group">
                            <label>Website: <b class="text-danger">*</b></label>
                            <input type="text" name="website" id="website" class="form-control" placeholder="Website" value="<?= $res['website']; ?>" onchange="remove(id)" readonly>
                            <div class="invalid-feedback errorWebsite"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Logo Aplikasi: <b class="text-danger">*</b></label><br>
                            <div class="row text-center">
                                <div class="col-sm-12 col-12">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width:485px;height:150px;border:2px solid #e2e2e2;border-radius: 5px;">
                                            <img src="<?= base_url(); ?>/img/aplikasi/<?= $res['logo']; ?>" style="width:100%;height:100%;">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="width:485px;height:150px;border:2px solid #e2e2e2;"></div>
                                        <div id="btnImg" class="d-none">
                                            <span class="btn btn-outline-info btn-file" style="cursor:pointer;">
                                                <span class="fileinput-new" style="padding-left:30px;padding-right:30px;">Browse File</span>
                                                <span class="fileinput-exists mr-1">Change</span>
                                                <input type="file" name="logo" id="logo" />
                                                <input type="hidden" name="logoLama" value="<?= $res['logo']; ?>">
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
    function remove(id) {
        if (id) {
            $('#' + id).removeClass('is-invalid');
        }
    };
    $(document).ready(function() {
        $('#btnSimpan').hide();
        $('#btnBatal').hide();
        $('#btnUpdate').click(function() {
            $('#btnUpdate').hide();
            $('#btnSimpan').show();
            $('#btnBatal').show();
            $('#nama').removeAttr('readonly');
            $('#telepon').removeAttr('readonly');
            $('#email').removeAttr('readonly');
            $('#website').removeAttr('readonly');
            $('#btnImg').removeClass('d-none');
        });
        $('#btnBatal').click(function() {
            $('#btnUpdate').show();
            $('#btnSimpan').hide();
            $('#btnBatal').hide();
            $('#nama').attr('readonly', 'true');
            $('#telepon').attr('readonly', 'true');
            $('#email').attr('readonly', 'true');
            $('#website').attr('readonly', 'true');
            $('#btnImg').addClass('d-none');
            $('.errorLogo').html('');
        });
        $('#remove').click(function(e) {
            e.preventDefault();
            $('.errorLogo').html('');
        });
        $('.formconapp').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "<?= base_url('conApp/updatedata'); ?>",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
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
                        if (response.error.telepon) {
                            $('#telepon').addClass('is-invalid');
                            $('.errorPhone').html(response.error.telepon);
                        } else {
                            $('#telepon').removeClass('is-invalid');
                            $('.errorPhone').html('');
                        }
                        if (response.error.email) {
                            $('#email').addClass('is-invalid');
                            $('.errorEmail').html(response.error.email);
                        } else {
                            $('#email').removeClass('is-invalid');
                            $('.errorEmail').html('');
                        }
                        if (response.error.website) {
                            $('#website').addClass('is-invalid');
                            $('.errorWebsite').html(response.error.website);
                        } else {
                            $('#website').removeClass('is-invalid');
                            $('.errorWebsite').html('');
                        }
                        if (response.error.logo) {
                            $('.errorLogo').html(response.error.logo);
                        } else {
                            $('.errorLogo').html('');
                        }
                    } else {
                        dataconapp();
                        Toast.fire({
                            icon: "success",
                            title: response.sukses,
                        });
                        $('#btnUpdate').show();
                        $('#btnSimpan').hide();
                        $('#btnBatal').hide();
                        $('#nama').attr('readonly', 'true');
                        $('#telepon').attr('readonly', 'true');
                        $('#email').attr('readonly', 'true');
                        $('#website').attr('readonly', 'true');
                        $('#btnImg').addClass('d-none');
                        _getLogoApp();
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