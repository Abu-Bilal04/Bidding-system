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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Products Record</title>

    <!-- base:css -->
    <link rel="stylesheet" href="../vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../vendors/base/vendor.bundle.base.css">

    <!-- inject:css -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../images/favicon.png" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="../iziToast/css/iziToast.min.css">
    <link rel="stylesheet" href="../iziToast/css/iziToast.min.css">
    <script src="../iziToast/js/iziToast.min.js"></script>

    <style>
      #preloader {
        position: fixed; left:0; top:0; width:100%; height:100%; z-index:9999; 
        background-color:#fff; display:flex; justify-content:center; align-items:center;
      }
      .spinner-border { width:3rem; height:3rem; color:#007bff; }
    </style>
</head>
<body>

<?php
if (isset($_GET['msg'])) {
    if ($_GET['msg'] === "success") echo "<script>iziToast.success({title:'Success', message:'Product added successfully!', position:'topRight'});</script>";
    elseif ($_GET['msg'] === "error") echo "<script>iziToast.error({title:'Error', message:'Failed to add product!', position:'topRight'});</script>";
    elseif ($_GET['msg'] === "exists") echo "<script>iziToast.warning({title:'Warning', message:'Product already exists!', position:'topRight'});</script>";
}
?>

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
            <li class="nav-item"><a class="nav-link" href="dashboard.php"><i class="mdi mdi-view-dashboard menu-icon"></i><span class="menu-title">Dashboard</span></a></li>
            <li class="nav-item"><a href="categories.php" class="nav-link"><i class="mdi mdi-view-list menu-icon"></i><span class="menu-title">Categories</span></a></li>
            <li class="nav-item active"><a href="products.php" class="nav-link active"><i class="mdi mdi-cube-outline menu-icon"></i><span class="menu-title">Products</span></a></li>
             <li class="nav-item">
              <a href="bidding.php" class="nav-link">
                <i class="mdi mdi-gavel menu-icon"></i>
                <span class="menu-title">Bidding</span>
                <i class="menu-arrow"></i>
              </a>
            </li>
            <li class="nav-item"><a href="users.php" class="nav-link"><i class="mdi mdi-account-group menu-icon"></i><span class="menu-title">Users</span></a></li>
          </ul>
        </div>
      </nav>
    </div>

    <!-- Main Content -->
    <div class="container mt-5">
      <div class="row">
        <!-- Add Product Form -->
        <div class="col-md-5">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title mb-4 text-primary">Add Product</h4>
              <form method="post" enctype="multipart/form-data">
                <div class="mt-3">
                  <label for="product">Product Name</label>
                  <input type="text" id="product" name="product_name" class="form-control" required>
                </div>
                <div class="mt-3">
                  <label for="description">Product Description</label>
                  <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
                </div>
                <div class="mt-3">
                  <label for="price">Product Price</label>
                  <input type="number" id="price" name="price" class="form-control" step="0.01" required>
                </div>
                <div class="mt-3">
                  <label for="deadline">Deadline</label>
                  <input type="datetime-local" id="deadline" name="deadline" class="form-control" required>
                </div>
                <div class="mt-3">
                  <label for="category">Product Category</label>
                  <select name="category_id" id="category" class="form-control" required>
                    <option value="">Select Category</option>
                    <?php
                    $categories = mysqli_query($dbcon, "SELECT * FROM categories");
                    while ($cat = mysqli_fetch_assoc($categories)) {
                        echo "<option value='{$cat['id']}'>{$cat['name']}</option>";
                    }
                    ?>
                  </select>
                </div>
                <div class="mt-3">
                  <label for="image">Product Image</label>
                  <input type="file" id="image" name="product_image" class="form-control" accept="image/*" required>
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-primary" name="add_product">Add Product</button>
                </div>
              </form>


            </div>
          </div>
        </div>

        <!-- Product List Table -->
        <div class="col-md-7">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title mb-4 text-primary">Product List</h4>
              <div class="table-responsive">
                <table id="productsTable" class="table table-striped table-bordered">
                  <thead class="table-light">
                    <tr>
                      <th>ID</th>
                      <th>Product</th>
                      <th>Price</th>
                      <th>Countdown</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                      $sn = 1;
                      $products = mysqli_query($dbcon, "
                        SELECT * FROM products 
                        WHERE deadline > NOW()  -- only fetch active products
                        ORDER BY id DESC
                      ");
                      while ($row = mysqli_fetch_assoc($products)) {
                          echo "<tr class='product-row'>
                                  <td>{$sn}</td>
                                  <td>{$row['product']}</td>
                                  <td>" . number_format($row['price']) . "</td>
                                  <td class='countdown' data-deadline='{$row['deadline']}'></td>
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
</div>

<!-- JS -->
<script src="../vendors/base/vendor.bundle.base.js"></script>
<script src="../js/template.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
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

<script>
$(document).ready(function() {
  $('#productsTable').DataTable({
    dom: 'Bfrtip',
    pageLength: 5,
    lengthMenu: [5,10,25,50],
    ordering: true,
    searching: true,
    buttons: [
      { extend:'excelHtml5', text:'Export Excel', className:'btn btn-success btn-sm' },
      { extend:'pdfHtml5', text:'Export PDF', className:'btn btn-danger btn-sm', orientation:'landscape', pageSize:'A4' }
    ]
  });
});
</script>
<script>
function startCountdown() {
  const timers = document.querySelectorAll(".countdown");

  timers.forEach(timer => {
    const deadline = new Date(timer.dataset.deadline).getTime();

    const interval = setInterval(() => {
      const now = new Date().getTime();
      const distance = deadline - now;

      if (distance <= 0) {
        clearInterval(interval);
        timer.innerHTML = "Expired";

        // hide the whole row when expired
        const row = timer.closest("tr");
        if (row) row.style.display = "none";
        return;
      }

      const days = Math.floor(distance / (1000 * 60 * 60 * 24));
      const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((distance % (1000 * 60)) / 1000);

      let timeStr = "";
      if (days > 0) timeStr += days + "d ";
      timeStr += hours + "h " + minutes + "m " + seconds + "s";

      timer.innerHTML = timeStr;
    }, 1000);
  });
}

document.addEventListener("DOMContentLoaded", startCountdown);
</script>

<script>
$(document).ready(function() {
    $('#productTable').DataTable({
      dom: 'Blfrtip',
      pageLength: 5,
      lengthMenu: [5,10,25,50],
      ordering: true,
      searching: true,
      buttons: [
        {extend:'excelHtml5', text:'Export Excel', className:'btn btn-success btn-sm'},
        {extend:'pdfHtml5', text:'Export PDF', className:'btn btn-danger btn-sm', orientation:'landscape', pageSize:'A4'}
      ]
    });
});
</script>

<script src="../js/preloader.js"></script>
</body>
</html>
