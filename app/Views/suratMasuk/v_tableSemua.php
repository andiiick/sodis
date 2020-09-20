<table id="table_semua" class="table table-bordered table-hover w-100">
    <thead>
        <tr>
            <th>Semua Surat Masuk</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($surat as $res) : ?>
            <tr>
                <td>
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modal_detailSM" data-id="10816" id="getSM" class="media-list-link" style="color:#525F7F !important;">
                        <div class="media pd-10-force">
                            <div style="width:40px;height:40px;border-radius:50%;float:left;background-color:#23BF08;">
                                <span class="tx-20 tx-white" style="display:block;text-align:center;margin-top:5px;font-weight:500 !important">
                                    <?= substr($res['koresponden'], 0, 1); ?>
                                </span>
                            </div>
                            <div class="media-body">
                                <div style="margin-bottom:0 !important;">
                                    <p style="width:100%;line-height:16px;">
                                        <b><?= strtoupper($res['koresponden']); ?></b>
                                    </p>
                                    <span style="text-align:end;width:100%;line-height:13px;">
                                        10 Feb 2020 <br> 11:26 WIB
                                    </span>
                                </div>
                                <p style="line-height:16px;width:95%;font-size:13px;margin-bottom:0px;">
                                    <?= $res['perihal']; ?>
                                </p>

                                <span class="square-8 bg-success mg-r-0 rounded-circle"></span>
                                <span style="color:#23BF08;font-size:11px;"><b>Selesai</b></span>
                            </div>
                        </div>
                    </a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $("#table_semua").DataTable({
            responsive: true,
            autoWidth: false,
        });
    });
</script>