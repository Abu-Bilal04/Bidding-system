<?php
include "../include/server.php";
session_start(); 

// Redirect if user not logged in
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header('Location: logout.php');
    exit();
}

$userEmail = $_SESSION['email'];

// Handle category submission
if (isset($_POST['add_category'])) {
    $name = trim(mysqli_real_escape_string($dbcon, $_POST['name']));

    // Check if category already exists
    $check = mysqli_query($dbcon, "SELECT * FROM categories WHERE name='$name'");
    if (mysqli_num_rows($check) > 0) {
        // header("Location: categories.php?msg=exists");
        exit();
    } else {
        $insert = mysqli_query($dbcon, "INSERT INTO categories (name) VALUES ('$name')");
        if ($insert) {
            header("Location: categories.php?msg=success");
            exit();
        } else {
            header("Location: categories.php?msg=error");
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
<title>Categories Record</title>

<!-- base:css -->
<link rel="stylesheet" href="../vendors/mdi/css/materialdesignicons.min.css">
<link rel="stylesheet" href="../vendors/base/vendor.bundle.base.css">
<link rel="stylesheet" href="../css/style.css">
<link rel="shortcut icon" href="../images/favicon.png" />

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
<link rel="stylesheet" href="../iziToast/css/iziToast.min.css">
<script src="../iziToast/js/iziToast.min.js"></script>

<style>
#preloader {
  position: fixed; left:0; top:0; width:100%; height:100%;
  z-index:9999; background-color:#fff; display:flex; justify-content:center; align-items:center;
}
.spinner-border { width:3rem; height:3rem; color:#007bff; }
</style>
</head>
<body>

<?php
if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
        case "success":
            echo "<script>iziToast.success({title:'Success', message:'Category added successfully!', position:'topRight'});</script>";
            break;
        case "exists":
            echo "<script>iziToast.warning({title:'Warning', message:'Category already exists!', position:'topRight'});</script>";
            break;
        case "error":
            echo "<script>iziToast.error({title:'Error', message:'An error occurred!', position:'topRight'});</script>";
            break;
        case "deleted":
            echo "<script>iziToast.success({title:'Success', message:'Category deleted successfully!', position:'topRight'});</script>";
            break;
        case "notfound":
            echo "<script>iziToast.warning({title:'Warning', message:'Category not found!', position:'topRight'});</script>";
            break;
    }
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
                  <span class="input-group-text" id="search"><i class="mdi mdi-magnify"></i></span>
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
                  <span class="nav-profile-name">Admin</span>
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
            <li class="nav-item"><a href="products.php" class="nav-link"><i class="mdi mdi-cube-outline menu-icon"></i><span class="menu-title">Products</span></a></li>
            <li class="nav-item"><a href="bidding.php" class="nav-link"><i class="mdi mdi-gavel menu-icon"></i><span class="menu-title">Bidding</span></a></li>
            <li class="nav-item"><a href="users.php" class="nav-link"><i class="mdi mdi-account-group menu-icon"></i><span class="menu-title">Users</span></a></li>
          </ul>
        </div>
      </nav>
    </div>

  <div class="container mt-5">
    <div class="row">
      <!-- Add Category Form -->
      <div class="col-md-5 mb-3">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title mb-4 text-primary">Register Category</h4>
            <form id="categoryForm" method="post">
              <div class="mb-3">
                <label for="categoryName" class="form-label">Category</label>
                <input type="text" class="form-control" id="categoryName" name="name" placeholder="Enter Category name">
              </div>
              <div class="text-end">
                <button type="submit" class="btn btn-primary" name="add_category">Add</button>
                <button type="reset" class="btn btn-light">Reset</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Categories DataTable -->
      <div class="col-md-7">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title mb-4 text-primary">Category List</h4>
            <div class="table-responsive">
              <table id="categoriesTable" class="table table-striped table-bordered">
                <thead class="table-light">
                  <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sn = 1;
                  $result = mysqli_query($dbcon, "SELECT * FROM categories");
                  while ($row = mysqli_fetch_assoc($result)) {
                  ?>
                  <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td>
                      <a href="delete_category.php?id=<?php echo $row['id']; ?>" 
                         onclick="return confirm('Are you sure you want to delete this category?');" 
                         class="btn btn-sm btn-danger">
                         <i class="mdi mdi-delete"></i> Delete
                      </a>
                    </td>
                  </tr>
                  <?php } ?>
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
  $('#categoriesTable').DataTable({
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

<script src="../js/preloader.js"></script>
</body>
</html>
