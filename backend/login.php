<?php include "../include/server.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Bidding system</title>
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
</head>

<body>
  <?php if (isset($_GET['msg']) && $_GET['msg'] === "error") { ?>
  <script>
    iziToast.error({
      title: 'Error',
      message: 'An error occured!',
      position: 'topRight'
    });
  </script>
<?php } ?>

  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <!-- Left Side (Form) -->
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <div class="brand-logo mb-3">
                <img src="../images/logo/icon.png" alt="logo">
              </div>
              <h4>Welcome Back!</h4>
              <form class="pt-3" method="POST" action="">
                <!-- Email -->
                <div class="form-group">
                  <label>Email</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-account-outline text-primary"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control form-control-lg border-left-0" placeholder="Enter email" name="email">
                  </div>
                </div>
                <!-- Password -->
                <div class="form-group">
                  <label>Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-lock-outline text-primary"></i>
                      </span>
                    </div>
                    <input type="password" class="form-control form-control-lg border-left-0" id="passwordInput" placeholder="Enter password" name="password">
                  </div>
                </div>
                <!-- Show Password -->
                <div class="mb-4">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input" onclick="togglePassword()">
                      Show password
                    </label>
                  </div>
                </div>
                <!-- Sign In Button -->
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" name="login">SIGN IN</button>
                </div>
              </form>
            </div>
          </div>
          <!-- Right Side (Background Image or Illustration) -->
          <div class="col-lg-6 register-half-bg d-flex flex-row">
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- base:js -->
  <script src="../vendors/base/vendor.bundle.base.js"></script>
  <!-- inject:js -->
  <script src="../js/template.js"></script>
  <!-- custom JS for Show Password -->
  <script>
    function togglePassword() {
      const passwordInput = document.getElementById("passwordInput");
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
      } else {
        passwordInput.type = "password";
      }
    }
  </script>
</body>

</html>
