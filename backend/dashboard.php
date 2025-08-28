<?php
include "../include/server.php";
session_start(); 

// Redirect if user not logged in (email required)
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header('Location: logout.php');
    exit();
}

$userEmail = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>
    <!-- base:css -->
    <link rel="stylesheet" href="../vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../images/favicon.png" />
    <link rel="stylesheet" href="../iziToast/css/iziToast.min.css">
    <script src="../iziToast/js/iziToast.min.js"></script>

    <!-- Mobile submenu visibility helper -->
    <style>
      @media (max-width: 991.98px){
        .bottom-navbar .submenu{ display:none; }
        .bottom-navbar .submenu.show{ display:block; }
      }
    </style>  
    <style>
      /* Preloader styles */
      #preloader {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background-color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
      }
      .spinner-border {
        width: 3rem;
        height: 3rem;
        color: #007bff;
      }
    </style>
  </head>
  <body>
    <!-- Preloader -->
    <div id="preloader">
      <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
    
    <div class="container-scroller">
				
		<!-- Navbar -->
    <div class="horizontal-menu">
      <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container-fluid">
          <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
            <ul class="navbar-nav navbar-nav-left">
              <li class="nav-item nav-search d-none d-lg-block ms-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="search">
                        <i class="mdi mdi-magnify"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control" placeholder="search" aria-label="search" aria-describedby="search">
                </div>
              </li>	
            </ul>
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="dashboard.php"><img src="../images/logo/logo.png" alt="logo"/></a>
                <a class="navbar-brand brand-logo-mini" href="dashboard.php"><img src="../images/logo-mini.svg" alt="logo"/></a>
            </div>
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                  <a class="nav-link" href="profile.php">
                    <span class="nav-profile-name">Abu Bilal</span>
                    <img src="../images/faces/face28.png" alt="profile"/>
                  </a>
                </li>

                
            <div>
                <a href="logout.php" class="nav-link btn"><i class="mdi mdi-power" style="font-size: xx-large;"></i></a>
            </div>

            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </div>
      </nav>
      <nav class="bottom-navbar">
        <div class="container">
          <ul class="nav page-navigation">
            <li class="nav-item active">
              <a class="nav-link active" href="dashboard.php">
                <i class="mdi mdi-view-dashboard menu-icon"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="categories.php" class="nav-link">
                <i class="mdi mdi-view-list menu-icon"></i>
                <span class="menu-title">Categories</span>
                <i class="menu-arrow"></i>
              </a>
            </li>

            <li class="nav-item">
              <a href="products.php" class="nav-link">
                <i class="mdi mdi-cube-outline menu-icon"></i>
                <span class="menu-title">Products</span>
                <i class="menu-arrow"></i>
              </a>
            </li>
            <li class="nav-item">
              <a href="users.php" class="nav-link">
                <i class="mdi mdi-account-group menu-icon"></i>
                <span class="menu-title">Users</span>
              </a>
            </li>
          </ul>

        </div>
      </nav>
    </div>
    <!-- partial -->

    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-6 mb-4 mb-xl-0">
              <div class="d-lg-flex align-items-center">
                <div>
                  <h3 class="text-dark font-weight-bold mb-2">Hi, welcome back!</h3>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="d-flex align-items-center justify-content-md-end">
                <div class="pe-1 mb-3 mb-xl-0">
                  <button type="button" class="btn btn-outline-inverse-info btn-icon-text">
                    Help
                    <i class="mdi mdi-help-circle-outline btn-icon-append"></i>                          
                  </button>
                </div>
                <div class="pe-1 mb-3 mb-xl-0">
                  <button type="button" class="btn btn-outline-inverse-info btn-icon-text">
                    Print
                    <i class="mdi mdi-printer btn-icon-append"></i>                          
                  </button>
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-4">
            <div class="col-sm-8 flex-column d-flex stretch-card">
              <div class="row">
                <div class="col-lg-4 d-flex grid-margin stretch-card">
                  <div class="card bg-primary">
                    <div class="card-body">
                      <h2 class="text-white mb-2 font-weight-bold">878643</h2>
                      <h4 class="card-title mb-2 text-white">Highest Bid Amount</h4>
                      <small style="color: aqua;">APRIL 2019</small>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 d-flex grid-margin stretch-card">
                  <div class="card blue">
                    <div class="card-body">
                      <h2 class="text-dark mb-2 font-weight-bold">45</h2>
                      <h4 class="card-title mb-2">Users</h4>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 d-flex grid-margin stretch-card">
                  <div class="card green">
                    <div class="card-body">
                      <h2 class="text-dark mb-2 font-weight-bold">75</h2>
                      <h4 class="card-title mb-2">Categories</h4>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 d-flex grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h2 class="text-dark mb-2 font-weight-bold">23</h2>
                      <h4 class="card-title mb-2">Products</h4>
                    </div>
                  </div>
                </div> 
              </div>
            </div>

            <div class="col-lg-4 mb-3 mb-lg-0">
              <div class="card congratulation-bg text-center">
                <div class="card-body pb-0">
                  <img src="../images/dashboard/face29.png" alt="School Management">  
                  <h2 class="mt-3 text-white mb-3 font-weight-bold">
                    Welcome Admin
                  </h2>
                  <p>You have successfully registered 120 new students this term. 
                    Manage teachers and exams from your dashboard.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
    </div>
    </div>

    <!-- base:js (includes jQuery & Bootstrap 4 bundle in Kapella) -->
    <script src="../vendors/base/vendor.bundle.base.js"></script>

    <!-- inject:js -->
    <script src="js/template.js"></script>

    <!-- plugin js for this page -->
    <script src="../vendors/chart.js/Chart.min.js"></script>
    <script src="../vendors/progressbar.js/progressbar.min.js"></script>
    <script src="../vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js"></script>
    <script src="../vendors/justgage/raphael-2.1.4.min.js"></script>
    <script src="../vendors/justgage/justgage.js"></script>
    <script src="../js/jquery.cookie.js" type="text/javascript"></script>
    <!-- Custom js for this page-->
    <script src="../js/dashboard.js"></script>

    <!-- Corrected script includes -->
<script src="../vendors/base/vendor.bundle.base.js"></script>

<!-- inject:js -->
<script src="../js/template.js"></script>

<!-- plugin js for this page -->
<script src="../vendors/chart.js/Chart.min.js"></script>
<script src="../vendors/progressbar.js/progressbar.min.js"></script>
<script src="../vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js"></script>
<script src="../vendors/justgage/raphael-2.1.4.min.js"></script>
<script src="../vendors/justgage/justgage.js"></script>
<script src="../js/jquery.cookie.js" type="text/javascript"></script>

<!-- Custom js for this page-->
<script src="../js/dashboard.js"></script>

<!-- Mobile submenu toggling + Active nav -->
  <script>
    (function ($) {
      function isMobile() { return window.innerWidth < 992; }

      // Toggle submenus on mobile
      $('.bottom-navbar .nav-item > .nav-link').on('click', function (e) {
        var $submenu = $(this).next('.submenu');
        if ($submenu.length && isMobile()) {
          e.preventDefault();
          $submenu.stop(true, true).slideToggle(150).toggleClass('show');
        }
      });

      // Close collapsed nav after selecting link (mobile)
      $('#navbarNavDropdown .nav-link[href]:not([href="#"])').on('click', function(){
        if (isMobile()) {
          $('#navbarNavDropdown').collapse('hide');
        }
      });

      // Highlight active nav
      var current = location.pathname.split("/").slice(-1)[0];
      $('.page-navigation .nav-link').each(function () {
        var link = $(this).attr('href');
        if (link === current) {
          $(this).closest('.nav-item').addClass('active');
          $(this).parents('.submenu').addClass('show');
        }
      });
    })(jQuery);
  </script>
    <script src="../js/preloader.js"></script>

  </body>
</html>
