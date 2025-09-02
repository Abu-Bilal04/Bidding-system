<?php
include "../include/server.php";
session_start();

// Check if product ID is provided
if (!isset($_GET['id'])) {
    die("No product selected.");
}

$product_id = intval($_GET['id']);

// Fetch product details
$query = "SELECT * FROM products WHERE id = $product_id";
$result = mysqli_query($dbcon, $query);
$product = mysqli_fetch_assoc($result);

// User info
$fullname = $_SESSION['name'] ?? 'Guest';
$email    = $_SESSION['email'] ?? 'Not available';
$phone    = $_SESSION['phone'] ?? 'Not available';

// Fetch highest bid for the product
$bid_result = mysqli_query($dbcon, "SELECT MAX(bid_price) AS highest_bid FROM bids WHERE product_id = $product_id");
$highest_bid_row = mysqli_fetch_assoc($bid_result);
$highest_bid = $highest_bid_row['highest_bid'] ?? $product['price']; // fallback to product price
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Bidding</title>
<link rel="stylesheet" href="../vendors/mdi/css/materialdesignicons.min.css">
<link rel="stylesheet" href="../vendors/base/vendor.bundle.base.css">
<link rel="stylesheet" href="../css/style.css">
<link rel="shortcut icon" href="../images/favicon.png" />
<link rel="stylesheet" href="../iziToast/css/iziToast.min.css">
<script src="../iziToast/js/iziToast.min.js"></script>
<style>
  @media (max-width: 991.98px){ 
    .bottom-navbar .submenu{ display:none; } 
    .bottom-navbar .submenu.show{ display:block; } 
  }
  #preloader { position: fixed; left:0; top:0; width:100%; height:100%; z-index:9999; background:#fff; display:flex; justify-content:center; align-items:center; }
  .spinner-border { width:3rem; height:3rem; color:#007bff; }
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
                <div class="input-group-prepend"><span class="input-group-text"><i class="mdi mdi-magnify"></i></span></div>
                <input type="text" class="form-control" placeholder="search">
              </div>
            </li>
          </ul>
          <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="dashboard.php"><img src="../images/logo/logo.png" alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href="dashboard.php"><img src="../images/logo-mini.svg" alt="logo"/></a>
          </div>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link" href="#">
                <!-- <span class="nav-profile-name">Abu Bilal</span> -->
                <img src="../images/faces/face.webp" alt="profile"/>
              </a>
            </li>
            <div><a href="logout.php" class="nav-link btn"><i class="mdi mdi-power" style="font-size: xx-large;"></i></a></div>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none" type="button"><span class="mdi mdi-menu"></span></button>
        </div>
      </div>
    </nav>

    <nav class="bottom-navbar">
      <div class="container">
        <ul class="nav page-navigation">
          <li class="nav-item"><a href="dashboard.php" class="nav-link"><i class="mdi mdi-gavel menu-icon"></i><span class="menu-title">Bidding</span></a></li>
          <li class="nav-item"><a href="products.php" class="nav-link"><i class="mdi mdi-cube-outline menu-icon"></i><span class="menu-title">Products</span></a></li>
        </ul>
      </div>
    </nav>
  </div>

  <!-- Main Content -->
  <div class="container-fluid page-body-wrapper">
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row mt-4">
          <div class="col-lg-9 d-flex grid-margin stretch-card mx-auto">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <img src="../backend/products/<?php echo htmlspecialchars($product['image']); ?>" class="card-img-top p-3" alt="Item Image">
                  </div>
                  <div class="col-md-6">
                    <h3><b>Place Bid</b></h3>
                    <div class="info-box">
                      <form method="post">
                        <p><strong>Product:</strong> <?php echo htmlspecialchars($product['product']); ?></p>
                        <p><strong>Open Price:</strong> $<?php echo number_format($product['price'],2); ?></p>
                        <p><strong>Current Price:</strong> $<?php echo number_format($highest_bid,2); ?></p>

                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                        <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['product']); ?>">
                        <input type="hidden" name="fullname" value="<?php echo htmlspecialchars($fullname); ?>">
                        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                        <input type="hidden" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                        <label><strong>Your Bid:</strong></label><br>
                        <input type="number" name="bid_price" placeholder="Enter your bid" class="form-control" step="0.01" required>
                        <br>
                        <button type="submit" class="btn btn-primary" name="place_bid">Submit Bid</button>
                      </form>
                    </div>
                  </div>
                </div> <!-- row -->
              </div>
            </div>
          </div>
        </div> <!-- row -->
      </div>
    </div>
  </div>
</div>

<script src="../vendors/base/vendor.bundle.base.js"></script>
<script src="../js/template.js"></script>
<script src="../js/preloader.js"></script>
<script>
  // Optional mobile menu toggle
  (function ($) {
    function isMobile() { return window.innerWidth < 992; }
    $('.bottom-navbar .nav-item > .nav-link').on('click', function (e) {
      var $submenu = $(this).next('.submenu');
      if ($submenu.length && isMobile()) { e.preventDefault(); $submenu.stop(true,true).slideToggle(150).toggleClass('show'); }
    });
  })(jQuery);
</script>
</body>
</html>
