<?php include "include/server.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>User Login</title>
  
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
      max-width: 400px;
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

<?php if (isset($_GET['msg']) && $_GET['msg'] === "success") { ?>
  <script>
    iziToast.success({
      title: 'Success',
      message: 'Signup successful!',
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
<?php } ?>

  <div class="login-card">
    <div class="text-center">
      <img src="images/logo/icon.png" alt="logo" style="width:50%">
    </div>
    <h4 class="text-center mb-4">Sign in to continue</h4>
    
    <form>
      <!-- Username -->
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="email" class="form-control" id="username" name="email" placeholder="Enter your username">
      </div>

      <!-- Password -->
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
      </div>

      <!-- Submit Button -->
      <div class="d-grid">
        <button type="submit" class="btn btn-primary btn-lg" name="signin">SIGN IN</button>
      </div>

      <div class="mt-3">
        <p class="mb-0">Don't have an account? <a href="signup.php" class="text-decoration-none">Sign up</a></p>
      </div>
    </form>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
