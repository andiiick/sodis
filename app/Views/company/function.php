<script type="text/javascript">
    $(document).ready(function() {
        datacompany();
    });

    function datacompany() {
        $.ajax({
            url: "<?= site_url('company/ambildata') ?>",
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