<?php
include "../include/server.php";
session_start(); 

// Redirect if user not logged in
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header('Location: logout.php');
    exit();
}

$userEmail = $_SESSION['email'];

// Handle product submission
if (isset($_POST['add_product'])) {
    $name = trim($_POST['product_name']);
    $description = trim($_POST['description']);
    $price = floatval($_POST['price']);
    $deadline = str_replace('T', ' ', $_POST['deadline']) . ':00';
    $category_id = intval($_POST['category_id']);

    // Check if product exists
    $check = mysqli_query($dbcon, "SELECT * FROM products WHERE name='$name'");
    if (mysqli_num_rows($check) > 0) {
        header("Location: products.php?msg=exists");
        exit();
    } else {
        $insert = mysqli_query($dbcon, "INSERT INTO products (name, description, price, deadline, category_id) 
                                        VALUES ('$name','$description',$price,'$deadline',$category_id)");
        if ($insert) {
            header("Location: products.php?msg=success");
            exit();
        } else {
            header("Location: products.php?msg=error");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Users Record</title>
    <!-- base:css -->
    <link rel="stylesheet" href="../vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../images/favicon.png" />
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="../iziToast/css/iziToast.min.css">
    <script src="../iziToast/js/iziToast.min.js"></script>
  
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
            <li class="nav-item">
              <a class="nav-link" href="dashboard.php">
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
              <a href="bidding.php" class="nav-link">
                <i class="mdi mdi-gavel menu-icon"></i>
                <span class="menu-title">Bidding</span>
                <i class="menu-arrow"></i>
              </a>
            </li>
            <li class="nav-item active">
              <a href="users.php" class="nav-link active">
                <i class="mdi mdi-account-group menu-icon"></i>
                <span class="menu-title">Users</span>
              </a>
            </li>
          </ul>

        </div>
      </nav>
    </div>

    <div class="container mx-auto mt-5">
          <div class="container mt-5">
            <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4 text-primary">Users List</h4>
                
                <div class="table-responsive">
                <table id="userTable" class="table table-striped table-bordered">
                    <thead class="table-light">
                    <tr>
                        <th>S/N</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Phone</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                      $sn = 1;
                      $users = mysqli_query($dbcon, "SELECT * FROM users ORDER BY id DESC");

                      while ($row = mysqli_fetch_assoc($users)) {
                          echo "<tr>
                                  <td>{$sn}</td>
                                  <td>{$row['fullname']}</td>
                                  <td>{$row['email']}</td>
                                  <td>{$row['username']}</td>
                                  <td>{$row['phone']}</td>
                                </tr>";
                          $sn++;
                      }
                      ?>
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>
    </div>

			</div>
			<!-- main-panel ends -->
		</div>
		<!-- page-body-wrapper ends -->
    </div>
		<!-- container-scroller -->
    <!-- base:js -->
    <script src="../vendors/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="js/template.js"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <!-- End plugin js for this page -->
    <script src="../vendors/chart.js/Chart.min.js"></script>
    <script src="../vendors/progressbar.js/progressbar.min.js"></script>
		<script src="../vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js"></script>
		<script src="../vendors/justgage/raphael-2.1.4.min.js"></script>
		<script src="../vendors/justgage/justgage.js"></script>
    <script src="../js/jquery.cookie.js" type="text/javascript"></script>
    <!-- Custom js for this page-->
    <script src="../js/dashboard.js"></script>
    <!-- End custom js for this page-->

    <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- DataTables + Buttons JS -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.php5.min.js"></script>

  <script>
   $('#userTable').DataTable({
  dom: 'Blfrtip', // Added "l" for length dropdown
  pageLength: 5,
  lengthMenu: [5, 10, 25, 50],
  ordering: true,
  searching: true,
  buttons: [
    {
      extend: 'excelHtml5',
      text: 'Export Excel',
      className: 'btn btn-success btn-sm'
    },
    {
      extend: 'pdfHtml5',
      text: 'Export PDF',
      className: 'btn btn-danger btn-sm',
      orientation: 'landscape',
      pageSize: 'A4'
    }
  ]
});

  </script>
  <script src="../js/preloader.js"></script>


  </body>
</html>