<script type="text/javascript">
    function datasifat() {
        $.ajax({
            url: "<?= site_url('sifat/ambildata') ?>",
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
        datasifat();

        $('.btnTambah').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('sifat/formtambah') ?>",
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