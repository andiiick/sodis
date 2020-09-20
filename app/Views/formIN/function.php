<script type="text/javascript">
    $(document).ready(function() {
        formIN();
    });

    function formIN() {
        $.ajax({
            url: "<?= site_url('formIN/tampildata') ?>",
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