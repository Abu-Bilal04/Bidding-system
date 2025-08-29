<?php include "include/server.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Create account</title>
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Icons (optional) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="iziToast/css/iziToast.min.css">
  <script src="iziToast/js/iziToast.min.js"></script>

  <style>
    body {
      background: #f8f9fa;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .login-card {
      max-width: 60%;
      width: 100%;
      padding: 2rem;
      border-radius: 1rem;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      background: #fff;
    }
    .brand-logo img {
      max-width: 120px;
      margin-bottom: 1rem;
    }
  </style>
</head>

<body>
  
<?php if (isset($_GET['msg']) && $_GET['msg'] === "exists") { ?>
  <script>
    iziToast.warning({
      title: 'Warning',
      message: 'User already exists!',
      position: 'topRight'
    });
  </script>

<?php } elseif (isset($_GET['msg']) && $_GET['msg'] === "error") { ?>
  <script>
    iziToast.error({
      title: 'Error',
      message: 'An error occurred!',
      position: 'topRight'
    });
  </script>

<?php } elseif (isset($_GET['msg']) && $_GET['msg'] === "password_mismatch") { ?>
  <script>
    iziToast.warning({
      title: 'Warning',
      message: 'Password didn\'t match!',
      position: 'topRight'
    });
  </script>

<?php } elseif (isset($_GET['msg']) && $_GET['msg'] === "missing_fields") { ?>
  <script>
    iziToast.warning({
      title: 'Warning',
      message: 'Please fill in all fields!',
      position: 'topRight'
    });
  </script>


<?php } elseif (isset($_GET['msg']) && $_GET['msg'] === "invalid_email") { ?>
  <script>
    iziToast.warning({
      title: 'Warning',
      message: 'Email is invalid',
      position: 'topRight'
    });
  </script>
<?php } ?>
  <div class="login-card">
    <div class="text-center brand-logo">
      <img src="images/logo/icon.png" alt="logo" style="width:50%">
    </div>
    <h4 class="text-center mb-4">Create an account</h4>

    <form method="POST">
      <div class="row">
        <div class="col-md-6">
          <!-- fullname -->
          <div class="mb-3">
            <label for="fullname" class="form-label">Fullname</label>
            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter fullname">
          </div>
        </div>

        <div class="col-md-6">
          <!-- email -->
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
          </div>
        </div>

        <div class="col-md-6">
          <!-- phone -->
          <div class="mb-3">
            <label for="phone" class="form-label">Phone number</label>
            <input type="tel" class="form-control" id="phone" name="phone" name="phone" placeholder="Enter phone number">
          </div>
        </div>

        <div class="col-md-6">
          <!-- username -->
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
          </div>
        </div>

        <div class="col-md-6">
          <!-- password -->
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Enter password">
          </div>
        </div>


        <div class="col-md-6">
          <!-- Confirm password -->
          <div class="mb-3">
            <label for="confirm-password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirm-password" placeholder="Confirm password">
          </div>
        </div>
      </div>

      <div class="text-center">
        <button type="submit" class="btn btn-primary form-control" name="signup">Sign Up</button>
      </div>

      <div class="mt-3">
        <p>Already have an account? <a href="login.php">Login here</a></p>
      </div>
    </form>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
