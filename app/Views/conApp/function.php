<script type="text/javascript">
    $(document).ready(function() {
        dataconapp();
    });

    function dataconapp() {
        $.ajax({
            url: "<?= site_url('conApp/ambildata') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            },
        });
    }
</script>