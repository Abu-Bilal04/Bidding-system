<?php
include "../include/server.php";
session_start(); 

// Redirect if user not logged in
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header('Location: logout.php');
    exit();
}

$userEmail = $_SESSION['email'];

// Handle update
if (isset($_POST['update_admin'])) {
    $username = mysqli_real_escape_string($dbcon, $_POST['username']);
    $email    = mysqli_real_escape_string($dbcon, $_POST['email']);
    $password = mysqli_real_escape_string($dbcon, $_POST['password']);

    // Handle profile picture upload
    $ppic_name = "";
    if (isset($_FILES['ppic']) && $_FILES['ppic']['error'] == 0) {
        $ext = pathinfo($_FILES['ppic']['name'], PATHINFO_EXTENSION);
        $ppic_name = "admin_" . time() . "." . $ext;
        move_uploaded_file($_FILES['ppic']['tmp_name'], "passport/" . $ppic_name);
    }

    // Build SQL query
    $sql = "UPDATE admin SET 
                username='$username',
                email='$email',
                password='$password'";

    if (!empty($ppic_name)) {
        $sql .= ", ppic='$ppic_name'";
    }

    $sql .= " WHERE email='$userEmail'";

    if (mysqli_query($dbcon, $sql)) {
    $userEmail = $email; // update session email if changed
    echo "<script>
            setTimeout(function(){ window.location.href = 'profile.php'; }, 1000); // reload after 1.5s
          </script>";
} else {
    echo "";
}
}

// Fetch admin record
$query = mysqli_query($dbcon, "SELECT * FROM admin WHERE email='$userEmail' LIMIT 1");
$admin = mysqli_fetch_assoc($query);
$ppic = !empty($admin['ppic']) ? "passport/" . $admin['ppic'] : "../images/faces/default.png";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Profile</title>

<link rel="stylesheet" href="../vendors/mdi/css/materialdesignicons.min.css">
<link rel="stylesheet" href="../vendors/base/vendor.bundle.base.css">
<link rel="stylesheet" href="../css/style.css">
<link rel="shortcut icon" href="../images/favicon.png" />
<link rel="stylesheet" href="../iziToast/css/iziToast.min.css">
<script src="../iziToast/js/iziToast.min.js"></script>

<style>
  #preloader {
    position: fixed; left: 0; top: 0; width: 100%; height: 100%; 
    background-color: #fff; display: flex; justify-content: center; align-items: center; z-index: 9999;
  }
  .spinner-border { width: 3rem; height: 3rem; color: #007bff; }
  .profile-card { text-align: center; padding: 30px; }
  .profile-card img { border-radius: 50%; width: 180px; height: 180px; object-fit: cover; margin-bottom: 15px; }
  .profile-info { text-align: left; margin-top: 20px; }
  .profile-info h5 { color: #007bff; margin-bottom: 15px; }
</style>
</head>
<body>

<div id="preloader">
  <div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>
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
                  <span class="input-group-text" id="search"><i class="mdi mdi-magnify"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="search" aria-label="search">
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
                <span class="nav-profile-name"><?= htmlspecialchars($admin['username']) ?></span>
                <img src="<?= $ppic ?>" alt="profile"/>
              </a>
            </li>
            <div>
              <a href="logout.php" class="nav-link btn"><i class="mdi mdi-power" style="font-size: xx-large;"></i></a>
            </div>
          </ul>
        </div>
      </div>
    </nav>

    <nav class="bottom-navbar">
      <div class="container">
        <ul class="nav page-navigation">
          <li class="nav-item"><a class="nav-link" href="dashboard.php"><i class="mdi mdi-view-dashboard menu-icon"></i><span class="menu-title">Dashboard</span></a></li>
          <li class="nav-item"><a class="nav-link" href="categories.php"><i class="mdi mdi-view-list menu-icon"></i><span class="menu-title">Categories</span></a></li>
          <li class="nav-item"><a class="nav-link" href="products.php"><i class="mdi mdi-cube-outline menu-icon"></i><span class="menu-title">Products</span></a></li>
          <li class="nav-item"><a class="nav-link" href="bidding.php"><i class="mdi mdi-gavel menu-icon"></i><span class="menu-title">Bidding</span></a></li>
          <li class="nav-item"><a class="nav-link" href="users.php"><i class="mdi mdi-account-group menu-icon"></i><span class="menu-title">Users</span></a></li>
        </ul>
      </div>
    </nav>
  </div>

  <!-- Profile Content -->
  <form method="post" enctype="multipart/form-data">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card shadow-lg border-0 rounded-4 p-4">
          <div class="row g-4 align-items-center">
            
            <!-- Profile Image -->
            <div class="col-md-4 text-center">
              <img src="<?= $ppic ?>" alt="User Profile" class="img-fluid rounded-circle shadow">
              <h4 class="mt-3 text-primary"><?= htmlspecialchars($admin['username']) ?></h4>
              <p class="text-muted">Administrator</p>
            </div>

            <!-- Profile Info -->
            <div class="col-md-8">
              <h5 class="mb-3 text-secondary border-bottom pb-2">Profile Information</h5>
              <div class="row">
                <div class="col-md-12 mb-2">
                  <strong>Username:</strong> 
                  <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($admin['username']) ?>">
                </div>
                <div class="col-md-6 mb-2">
                  <strong>Email:</strong> 
                  <input type="text" name="email" class="form-control" value="<?= htmlspecialchars($admin['email']) ?>">
                </div>
                <div class="col-md-6 mb-2">
                  <strong>Password:</strong> 
                  <input type="text" name="password" class="form-control" value="<?= htmlspecialchars($admin['password']) ?>">
                </div>
                <div class="col-md-12 mb-2">
                  <strong>Change profile image:</strong> 
                  <input type="file" name="ppic" class="form-control">
                </div>
              </div>

              <div class="mt-4">
                <button class="btn btn-primary" type="submit" name="update_admin">Update</button>
                <a href="logout.php" class="btn btn-danger"><i class="mdi mdi-logout"></i> Logout</a>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  </form>

</div>

<script src="../vendors/base/vendor.bundle.base.js"></script>
<script src="../js/template.js"></script>
<script src="../js/preloader.js"></script>
</body>
</html>
