<script type="text/javascript">
    $(document).ready(function() {
        function datasemuasurat() {
            $.ajax({
                url: "<?= site_url('suratMasuk/ambildataSemua') ?>",
                dataType: "json",
                success: function(response) {
                    $('.viewdata').html(response.data);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                },
            });
        }
        datasemuasurat();
    });
</script>