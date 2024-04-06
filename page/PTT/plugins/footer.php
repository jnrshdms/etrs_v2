 <footer class="main-footer">
    <strong>Copyright &copy; 2022. Developed by: JJ Buendia</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>
<?php
//MODALS
include '../../modals/logout.php';
include '../../modals/ptt/register.php';
include '../../modals/ptt/update_ptt.php';
include '../../modals/ptt/import_training_records.php';
include '../../modals/ptt/import_initial_training_records.php';
include '../../modals/ptt/import_final_training_records.php';
include '../../modals/ptt/import_initial_practice_training_records.php';
include '../../modals/ptt/import_final_practice_training_records.php';
include '../../modals/initial/update.php';
include '../../modals/initial/reupdate.php';
include '../../modals/final/update.php';
include '../../modals/final/reupdate.php';
include '../../modals/special/initial_practice.php';
include '../../modals/special/reupdate.php';
include '../../modals/special/final_practice.php';
include '../../modals/special/final_reupdate.php';
include '../../modals/accounts/register.php';
include '../../modals/accounts/update_account.php';
?>
<!-- jQuery -->
<!-- <script src="../../plugins/jquery/jquery.min.js"></script> -->
<script src="../../node_modules/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<!-- toastr -->
<script type="text/javascript" src="../../node_modules/sweetalert/dist/sweetalert.min.js"></script>
<script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.js"></script>

</body>
</html>