<footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            <p>2020 &copy; Voler</p>
        </div>
        <div class="float-end">
            <p>Crafted with <span class='text-danger'><i data-feather="heart"></i></span> by <a href="http://ahmadsaugi.com">Akademi Komunitas Negeri Seni Dan Budaya Yogyakarta</a></p>
        </div>
    </div>
</footer>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" charset="utf-8"></script>
<script src="<?= base_url('assets/admin_panel/') ?>assets/js/feather-icons/feather.min.js"></script>
<script src="<?= base_url('assets/admin_panel/') ?>assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?= base_url('assets/admin_panel/') ?>assets/js/app.js"></script>

<script src="<?= base_url('assets/admin_panel/') ?>assets/vendors/chartjs/Chart.min.js"></script>
<script src="<?= base_url('assets/admin_panel/') ?>assets/vendors/apexcharts/apexcharts.min.js"></script>
<script src="<?= base_url('assets/admin_panel/') ?>assets/js/pages/dashboard.js"></script>
<script src="<?= base_url('assets/admin_panel/') ?>assets/js/main.js"></script>
<script src="https://kit.fontawesome.com/7f8e14bcae.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>


<script>
    $('.form-check-input').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');

        $.ajax({
            url: "<?= base_url('admin/changeaccess'); ?>",
            type: 'post',
            data: {
                menuId: menuId,
                roleId: roleId,
            },
            success: function() {
                document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleId;
            }
        });
    });
</script>
<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>

</body>

</html>