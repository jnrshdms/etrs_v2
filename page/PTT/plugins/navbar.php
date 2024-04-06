<?php 
//SESSION
include '../../process/session.php';
if($section == 'PTT'){
        // DO NOTHING
    }else{
        // RESTRICT THE USER IF NOT LEVEL 2 and 3
        session_unset();
        session_destroy();
        header('location: ../../index.php');
    }

?>  
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ETRS | ADMIN</title>

  <link rel="icon" href="../../dist/img/ETRS.png" type="image/x-icon" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="../../dist/css/font.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../plugins/ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <style>
  #training_data th:nth-child(16),
  #training_data td:nth-child(16),
  #initial_training_data th:nth-child(9),
  #initial_training_data td:nth-child(9),
  #initial_view_training_data th:nth-child(14),
  #initial_view_training_data td:nth-child(14),
  #initial_practice_training_data th:nth-child(9),
  #initial_practice_training_data td:nth-child(9),
  #initial_practice_view_training_data th:nth-child(14),
  #initial_practice_view_training_data td:nth-child(14),
  #final_training_data th:nth-child(9),
  #final_training_data td:nth-child(9),
  #final_view_training_data th:nth-child(14),
  #final_view_training_data td:nth-child(14),
  #final_practice_training_data th:nth-child(9),
  #final_practice_training_data td:nth-child(9),
  #final_practice_view_training_data th:nth-child(14),
  #final_practice_view_training_data td:nth-child(14)
   {
    display: none;
  }

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
    <img class="animation__shake" src="../../dist/img/ETRS.png" alt="SEPlogo" height="60" width="60">
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
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
  <!--     <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
    </ul>
  </nav>
  <!-- /.navbar -->