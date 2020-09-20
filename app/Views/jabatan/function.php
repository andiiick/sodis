<script type="text/javascript">
    function datajabatan() {
        $.ajax({
            url: "<?= site_url('jabatan/ambildata') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            },
        });
    }
    $(document).ready(function() {
        datajabatan();

        $('.btnTambah').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('jabatan/formtambah') ?>",
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();
                    $('#modaltambah').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                },
            });
        });
    });
</script>