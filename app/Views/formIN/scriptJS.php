<script src="<?= base_url(); ?>/assets/plugins/select2/js/select2.full.min.js"></script>
<script src="<?= base_url(); ?>/assets/flatpickr/flatpickr.min.js"></script>
<script src="<?= base_url(); ?>/assets/flatpickr/form-pickers.init.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/sweetalert2.all.min.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script type="text/javascript">
    $(".select2").select2();
    // SWAL TOASTR
    const Toast = Swal.mixin({
        toast: true,
        position: "top",
        showConfirmButton: false,
        timer: 3000,
    });
</script>