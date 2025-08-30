<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>User Profile - MLS</title>

  <!-- base:css -->
  <link rel="stylesheet" href="../vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../vendors/base/vendor.bundle.base.css">

  <!-- inject:css -->
  <link rel="stylesheet" href="../css/style.css">
  <link rel="shortcut icon" href="../images/favicon.png" />

  <style>
    /* Preloader */
    #preloader {
      position: fixed;
      left: 0; top: 0;
      width: 100%; height: 100%;
      z-index: 9999;
      background-color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .spinner-border {
      width: 3rem; height: 3rem;
      color: #007bff;
    }
    .profile-card {
      text-align: center;
      padding: 30px;
    }
    .profile-card img {
      border-radius: 50%;
      width: 120px;
      height: 120px;
      object-fit: cover;
      margin-bottom: 15px;
    }
    .profile-info {
      text-align: left;
      margin-top: 20px;
    }
    .profile-info h5 {
      color: #007bff;
      margin-bottom: 15px;
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
                <a href="#" class="nav-link"><i class="mdi mdi-power" style="font-size: xx-large;"></i></a>
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
              <a class="nav-link" href="dashboard.html">
                <i class="mdi mdi-file-document-box menu-icon"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="mdi mdi-clipboard-account menu-icon"></i>
                <span class="menu-title">Teachers</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="submenu">
                <ul>
                  <li class="nav-item"><a class="nav-link" href="register_teacher.html">Register</a></li>
                  <li class="nav-item"><a class="nav-link" href="manage_teacher.html">Manage</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="mdi mdi-account-multiple menu-icon"></i>
                <span class="menu-title">Students</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="submenu">
                <ul>
                  <li class="nav-item"><a class="nav-link" href="register_student.html">Register</a></li>
                  <li class="nav-item"><a class="nav-link" href="manage_student.html">Manage</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a href="classes.html" class="nav-link">
                <i class="mdi mdi-format-line-spacing menu-icon"></i>
                <span class="menu-title">Classes</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="subjects.html" class="nav-link">
                <i class="mdi mdi-book-open-variant menu-icon"></i>
                <span class="menu-title">Subjects</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="mdi mdi-grid menu-icon"></i>
                <span class="menu-title">Time-table</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="submenu">
                <ul>
                  <li class="nav-item"><a class="nav-link" href="create_table.html">Create</a></li>
                  <li class="nav-item"><a class="nav-link" href="manage_table.html">Manage</a></li>
                </ul>
              </div>
            </li>            
            <li class="nav-item">
              <a href="result.html" class="nav-link">
                <i class="mdi mdi-file-document menu-icon"></i>
                <span class="menu-title">Results</span>
              </a>
            </li>
          </ul>
        </div>
      </nav>
    </div>

    <!-- Profile Content -->
    <div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card shadow-lg border-0 rounded-4 p-4">
        <div class="row g-4 align-items-center">
          
          <!-- Profile Image -->
          <div class="col-md-4 text-center">
            <img src="../images/faces/face28.png" 
                 alt="User Profile" 
                 class="img-fluid rounded-circle shadow"
                 style="width: 180px; height: 180px; object-fit: cover;">
            <h4 class="mt-3 text-primary">Muhammad Ibrahim Musa</h4>
            <p class="text-muted">Administrator</p>
          </div>

          <!-- Profile Info -->
          <div class="col-md-8">
            <h5 class="mb-3 text-secondary border-bottom pb-2">Profile Information</h5>
            <div class="row">
              <div class="col-md-6 mb-2">
                <strong>Email:</strong> <input type="text" class="form-control" value="mibrahimmusa34@gmail.com" placeholder="Enter email">
              </div>
              <div class="col-md-6 mb-2">
                <strong>Phone:</strong> <input type="number" class="form-control" value="08012345678" placeholder="Enter phone number">
              </div>
              <div class="col-md-6 mb-2">
                <strong>Role:</strong> Administrator
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-4">
              <button class="btn btn-danger">
                <i class="mdi mdi-logout"></i> Logout
              </button>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

  <!-- base:js -->
  <script src="../vendors/base/vendor.bundle.base.js"></script>
  <script src="../js/template.js"></script>
  <script src="../js/preloader.js"></script>
</body>
</html>
