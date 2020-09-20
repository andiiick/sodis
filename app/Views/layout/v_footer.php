<aside class="control-sidebar control-sidebar-dark">
    <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
    </div>
</aside>
<!-- FOOTER -->
<footer class="main-footer text-sm">
    <div class="float-right d-none d-sm-inline">
        Blaa..blaa..blaa
    </div>
    <strong>Copyright &copy;2020 <a href="https://www.instagram.com/andiiick/" target="_blank">andiiick</a>.</strong> All rights reserved.
</footer>
<!-- END FOOTER -->
</div>
<!-- END MAIN WRAPPER -->

<!-- JQUERY -->
<script src="<?= base_url(); ?>/assets/plugins/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>/assets/dist/js/adminlte.min.js"></script>

<script>
    const API_URL = 'http://localhost:8080';
    $(document).ready(function() {
        _getLogoApp()
    })

    // function _getLogo() {
    //     $.ajax({
    //         url: API_URL + `/company/ambil_logo`,
    //         dataType: "json",
    //         success: function(response) {
    //             const logo = response.logo
    //             const path = `${API_URL}/img/company/${logo}`
    //             document.getElementById("logo").src = path
    //         },
    //         error: function(xhr, ajaxOptions, thrownError) {

    //         },
    //     });
    // }

    function _getLogoApp() {
        $.ajax({
            url: API_URL + `/conApp/ambil_logo`,
            dataType: "json",
            success: function(response) {
                const logo = response.logo
                const path = `${API_URL}/img/aplikasi/${logo}`
                document.getElementById("logo").src = path
            },
            error: function(xhr, ajaxOptions, thrownError) {

            },
        });
    }
</script>
</body>

</html>