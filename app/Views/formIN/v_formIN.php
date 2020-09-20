<!-- WRAPPER -->
<div class="content-wrapper">
    <!-- TITLE & BREADCRUMB -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="icon-note"></i> <?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Form Surat</li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- END TITLE & BREADCRUMB -->
    <!-- MAIN CONTENT -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="formconapp" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <div style="border:1px solid #CED4DA;padding:15px;">
                                    <div class="pl-2 pr-2">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nomor Urut: <b class="text-danger">*</b></label>
                                                    <input type="text" name="noUrut" id="noUrut" class="form-control" placeholder="Nomor Urut Surat" style="text-transform: capitalize;">
                                                    <div class="invalid-feedback errorNomor"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Asal/Sumber Surat: <b class="text-danger">*</b></label>
                                                    <input type="text" name="koresponden" id="koresponden" class="form-control" placeholder="No. Telepon" style="text-transform: capitalize;">
                                                    <div class="invalid-feedback errorKoresponden"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nomor Surat:</label>
                                                    <input type="text" name="noSurat" id="noSurat" class="form-control" placeholder="Nomor Surat">
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Tanggal Surat:</label>
                                                            <input type="text" name="tglSurat" id="tglSurat" class="form-control bg-white tglSurat" placeholder="Tanggal Surat">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Tanggal Tempo:</label>
                                                            <input type="text" name="tglTempo" id="tglTempo" class="form-control bg-white tglSurat" placeholder="Tanggal Tempo Surat">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Klasifikasi Surat: <b class="text-danger">*</b></label>
                                                            <select class="form-control select2" name="idKlas" id="idKlas" data-placeholder="-- Pilih Klasifikasi Surat --" data-allow-clear="true" style="width:100%;" onchange="remove(id)">
                                                                <option value=""></option>
                                                                <?php foreach ($klasifikasi as $res) : ?>
                                                                    <option value="<?= $res['idKlas']; ?>">
                                                                        <?= '(' . $res['kdKlas'] . ') ' . $res['nmKlas']; ?>
                                                                    </option>
                                                                <?php endforeach ?>
                                                            </select>
                                                            <div class="invalid-feedback errorKlas"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Sifat Surat: <b class="text-danger">*</b></label>
                                                            <select class="form-control select2" name="idSifat" id="idSifat" data-placeholder="-- Pilih Sifat Surat --" data-allow-clear="true" style="width:100%;" onchange="remove(id)">
                                                                <option value=""></option>
                                                                <?php foreach ($sifat as $res) : ?>
                                                                    <option value="<?= $res['idSifat']; ?>">
                                                                        <?= $res['nmSifat']; ?>
                                                                    </option>
                                                                <?php endforeach ?>
                                                            </select>
                                                            <div class="invalid-feedback errorSifat"></div>
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
                                            <button style="min-width:100px;" type="submit" class="btn btn-success mr-1" id="btnSimpan">Simpan</button>
                                            <button style="min-width:100px;" type="reset" class="btn btn-outline-secondary ml-1" id="btnBatal">Batal</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END MAIN CONTENT -->
</div>
<!-- END WRAPPER -->
<div class="viewmodal" style="display: none;"></div>