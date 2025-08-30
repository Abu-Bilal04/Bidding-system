<?php include "../include/server.php"; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bidding</title>
    <!-- base:css -->
    <link rel="stylesheet" href="../vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../images/favicon.png" />

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
                <a class="navbar-brand brand-logo" href="dashboard.html"><img src="../images/logo/logo.png" alt="logo"/></a>
                <a class="navbar-brand brand-logo-mini" href="dashboard.html"><img src="../images/logo-mini.svg" alt="logo"/></a>
            </div>
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                  <a class="nav-link" href="profile.html">
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
              <a href="dashboard.html" class="nav-link active">
                <i class="mdi mdi-gavel menu-icon"></i>
                <span class="menu-title">Bidding</span>
              </a>
            </li>

            <li class="nav-item">
              <a href="products.html" class="nav-link">
                <i class="mdi mdi-cube-outline menu-icon"></i>
                <span class="menu-title">Products</span>
                <i class="menu-arrow"></i>
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
          </div>
          <div class="row mt-4">
          <?php
            $query = "
              SELECT p.*, c.name AS category_name
              FROM products p
              JOIN categories c ON p.category_id = c.id
              ORDER BY p.id DESC
            ";
            $products = mysqli_query($dbcon, $query);

            while ($row = mysqli_fetch_assoc($products)) {
                echo '
                  <div class="col-lg-3 d-flex grid-margin stretch-card">
                    <div class="card">
                      <img src="../backend/products/' . $row['image'] . '" class="card-img-top p-3" alt="Item Image">
                      <div class="card-body">
                        <h5 class="card-title">' . $row['product'] . '</h5>
                        <p class="card-text mb-1"><strong>Category:</strong> ' . $row['category_name'] . '</p>
                        <p class="card-text mb-1"><strong>Price:</strong> $' . $row['price'] . '</p>
                        <p class="card-text mb-3"><strong>Time Left:</strong> 02:15:20</p>
                        <a href="#" class="btn btn-primary btn-sm w-100">Place Bid</a>
                      </div>
                    </div>
                  </div>';
            }
            ?>


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
