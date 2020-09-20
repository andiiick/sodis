<script type="text/javascript">
    function datajenis() {
        $.ajax({
            url: "<?= site_url('jenis/ambildata') ?>",
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
        datajenis();

        $('.btnTambah').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('jenis/formtambah') ?>",
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