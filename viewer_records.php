
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ETRS | Viewer</title>
  <link rel="icon" href="dist/img/ETRS.png" type="image/x-icon" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="dist/css/font.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <style>
    .loader {
      border: 16px solid #f3f3f3;
      border-radius: 50%;
      border-top: 16px solid #536A6D;
      width: 50px;
      height: 50px;
      -webkit-animation: spin 2s linear infinite;
      animation: spin 2s linear infinite;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(1080deg); }
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/ETRS.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
     
    </ul>

    <!-- Right navbar links -->
   
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/ETRS.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">VIEWER</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="viewer.php" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                View Training Records

              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="viewer_records.php" class="nav-link active">
              <i class="nav-icon fas fa-download"></i>
              <p>
                Export Training Records

              </p>
            </a>
          </li>
        </ul>
      
      
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <section class="content">
      <div class="container-fluid">
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">View Training Records</h1>
            <br>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">ViewTraining Records</li>
            </ol>
          </div><!-- /.col -->         
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
       <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">

                     <div class="row">
                      <div class="col-2">
                        <label>Batch  No:</label><input type="text" name="batch_no_viewer"  id="batch_no_viewer" class="form-control">
                      </div>
                      <div class="col-2">
                        <label>SP ID Number:</label><input type="text" name="emp_num_view" id="sp_id_view"  class="form-control">
                      </div>
                      <div class="col-2">
                        <label>FALP ID Number:</label><input type="text" name="emp_num_view" id="emp_num_view"  class="form-control">
                      </div>
                      <div class="col-2">
                        <label>Full Name:</label><input type="text" name="fname_view" id="fname_view"  class="form-control">
                      </div>
                      <div class="col-2">
                        <label>Department:</label><input type="text" name="dept_view" id="dept_view"  class="form-control">
                      </div>
                  </div>

                </h3> 
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 100px;">
                    <button class="btn btn-primary" id="searchReqBtn" onclick="viewer_export_training_record()">Search <i class="fas fa-search"></i></button> 
                  </div>
                </div>
              </div>
                <div class="row">
                    <div class="col-sm-6">
                      &nbsp;<button class="btn btn-success " onclick="export_viewer_records('export_view')">Export</button>
                    </div>
                  </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 500px;">
                <table class="table table-head-fixed text-nowrap table-hover" id="export_view">
                <thead style="text-align:center;">
                     <th>#</th>
                    <th>Batch No </th>
                    <th>SP ID Number </th>
                    <th>FALP ID Number </th>
                    <th>Maiden Name </th>
                    <th>Full Name </th>
                    <th>Gender </th>
                    <th>Department </th>
                    <th>Position </th>
                    <th>SP Date Hired</th>
                    <th>FALP Date Hired</th>
                    <th>Theory Training Status</th>
                    <th>Theory Training Start Date </th>
                    <th>Theory Training End Date </th>
                    <th>Theory TrainingRemarks</th>
                    <th>Initial Training Process</th>
                    <th>Initial Training Status</th>
                    <th>Initial Training Start Date </th>
                    <th>Initial Training End Date </th>
                    <th>Initial Training Remarks</th>
                    <th>Final Training Process</th>
                    <th>Final Training Status</th>
                    <th>Final Training Start Date </th>
                    <th>Final Training End Date </th>
                    <th>Final Training Remarks</th>
                    <th>Special Batch Initial Training Process</th>
                    <th>Special Batch Initial Training Status</th>
                    <th>Special Batch Initial Training Start Date </th>
                    <th>Special Batch Initial Training End Date </th>
                    <th>Special Batch Initial Training Remarks</th>
                    <th>Special Batch Final Training Process</th>
                    <th>Special Batch Final Training Status</th>
                    <th>Special Batch Final Training Start Date </th>
                    <th>Special Batch Final Training End Date </th>
                    <th>Special Batch Final Training Remarks</th>
            </thead>
            <tbody id="viewer_export_data" style="text-align:center;"></tbody>
                </table>
                 <div class="row">
                  <div class="col-6">
                    
                  </div>
                  <div class="col-6">
                      <input type="hidden" name="" id="audit_data">
                      <input type="hidden" name="" id="unique_id">
                    <div class="spinner" id="spinner" style="display:none;">
                        
                        <div class="loader float-sm-center"></div>    
                    </div>
             
                  </div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
</div>
</div>
</section>
  <!-- /.content-wrapper -->
 <footer class="main-footer">
    <strong>Copyright &copy; 2022. Developed by: JJ Buendia</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<?php 
include 'modals/viewer/status.php';

?>
<!-- jQuery -->
<script src="node_modules/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<!-- toastr -->
<script type="text/javascript" src="node_modules/sweetalert/dist/sweetalert.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<script type="text/javascript">

  const viewer_export_training_record =()=>{
    var employee_num = document.getElementById('emp_num_view').value;
  var full_name = document.getElementById('fname_view').value;
  var batch_no = document.getElementById('batch_no_viewer').value;
  var department = document.getElementById('dept_view').value;
  var sp_id = document.getElementById('sp_id_view').value;
  $('#spinner').css('display','block');

     $.ajax({
      url: 'process/viewer.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_export_viewer',
                    employee_num:employee_num,
                    full_name:full_name,
                    batch_no:batch_no,
                    department:department,
                    sp_id:sp_id
                },success:function(response){
                   document.getElementById('viewer_export_data').innerHTML = response;
                        $('#spinner').fadeOut(function(){                       
                   });
                }
              });
  }

function export_viewer_records(table_id, separator = ',') {
    // Select rows from table_id
    var rows = document.querySelectorAll('table#' + table_id + ' tr');
    // Construct csv
    var csv = [];
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll('td, th');
        for (var j = 0; j < cols.length; j++) {
            var data = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, '').replace(/(\s\s)/gm, ' ')
            data = data.replace(/"/g, '""');
            // Push escaped string
            row.push('"' + data + '"');
        }
        csv.push(row.join(separator));
    }
    var csv_string = csv.join('\n');
    // Download it
    var filename = 'Training_Record_Details'+ '_' + new Date().toLocaleDateString() + '.csv';
    var link = document.createElement('a');
    link.style.display = 'none';
    link.setAttribute('target', '_blank');
    link.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv_string));
    link.setAttribute('download', filename);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
} 



</script>
</body>
</html>
