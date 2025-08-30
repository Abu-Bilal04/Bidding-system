<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Product Record</title>

    <!-- base:css -->
    <link rel="stylesheet" href="../vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../vendors/base/vendor.bundle.base.css">

    <!-- inject:css -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../images/favicon.png" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">

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
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                      <a class="dropdown-item">
                        <i class="mdi mdi-settings text-primary"></i>
                        Settings
                      </a>
                      <a class="dropdown-item">
                        <i class="mdi mdi-logout text-primary"></i>
                        Logout
                      </a>
                  </div>
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
              <a href="dashboard.html" class="nav-link">
                <i class="mdi mdi-gavel menu-icon"></i>
                <span class="menu-title">Bidding</span>
              </a>
            </li>

            <li class="nav-item active">
              <a href="products.html" class="nav-link active">
                <i class="mdi mdi-cube-outline menu-icon"></i>
                <span class="menu-title">Products</span>
                <i class="menu-arrow"></i>
              </a>
            </li>
          </ul>

        </div>
      </nav>
    </div>
    <!-- Main Content (Form + DataTable) -->
    <div class="container mt-5">
      <div class="row">

        <!-- products DataTable -->
        <div class="col-md-7">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title mb-4 text-primary">Product List</h4>
              <div class="table-responsive">
                <table id="productTable" class="table table-striped table-bordered">
                  <thead class="table-light">
                    <tr>
                      <th>ID</th>
                      <th>Product</th>
                      <th>Price</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Goods</td>
                      <td>$8740</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- base:js -->
    <script src="../vendors/base/vendor.bundle.base.js"></script>
    <script src="../js/template.js"></script>

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
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

    <!-- DataTable Init -->
    <script>
      $(document).ready(function() {
        $('#productTable').DataTable({
          dom: 'Blfrtip',
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
      });
    </script>

    <script src="../js/preloader.js"></script>

  </body>
</html>
