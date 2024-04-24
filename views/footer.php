</main>
<!--   Core JS Files   -->

<script src="../public/assets/js/core/popper.min.js"></script>
<script src="../public/assets/js/core/bootstrap.min.js"></script>
<script src="../public/assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../public/assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="../public/assets/js/plugins/chartjs.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<!-- <script src="../public/assets/js/jquery-3.6.0.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<script src="../public/assets/js/datatables.js"></script>
<script src="../public/assets/js/datatables.min.js"></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="../public/assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../public/assets/js/main.js"></script>
<script src="../public/assets/js/effects.js"></script>
<script src="../public/assets/js/ajax.js"></script>

<?php if ($flash = getFlash('success')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: "<?php echo $flash; ?>",
            showConfirmButton: true,
        });
    </script>
<?php endif; ?>

<?php if ($flash = getFlash('failed')) : ?>
    <script>
        Swal.fire({
            icon: 'warning',
            title: "<?php echo $flash; ?>",
            showConfirmButton: true,
        });
    </script>
<?php endif; ?>

<script>
    $(document).ready(function() {
        $("#example").DataTable();
    });
    $(document).ready(function() {
        $("#example1").DataTable();
    });
    $(document).ready(function() {
        $("#example2").DataTable();
    });
    $(document).ready(function() {
        $("#example3").DataTable();
    });
    $(document).ready(function() {
        $("#example4").DataTable();
    });
</script>
</body>

</html>