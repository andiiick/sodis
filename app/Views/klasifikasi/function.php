<script type="text/javascript">
    function dataklasifikasi() {
        $.ajax({
            url: "<?= site_url('klasifikasi/ambildata') ?>",
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
        dataklasifikasi();

        $('.btnTambah').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('klasifikasi/formtambah') ?>",
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