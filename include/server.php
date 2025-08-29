<?php
session_start();
include 'db_connection.php';



if (isset($_POST['login'])) {
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  
       $check_user = "SELECT * FROM admin WHERE email = '$email' AND password='$password'";
       $run = mysqli_query($dbcon,$check_user);
       if (mysqli_num_rows($run)>0) {
        $_SESSION['email'] = $email;
          echo "<script>window.open('dashboard.php','_self')</script>";
        }else{
         echo "<script>window.open('login.php?msg=error','_self')</script>";
      } 
}

if (isset($_POST['add_category'])) {
    $name = trim($_POST['name']);

    // Check if category already exists
    $check = "SELECT * FROM categories WHERE name = '$name'";
    $result = mysqli_query($dbcon, $check);

    if (mysqli_num_rows($result) > 0) {
        // Category already exists
        echo "<script>window.open('categories.php?msg=exists','_self');</script>";
    } else {
        // Insert new category
        $sql = "INSERT INTO categories (name) VALUES ('$name')";
        if (mysqli_query($dbcon, $sql)) {
            echo "<script>window.open('categories.php?msg=success','_self');</script>";
        } else {
            echo "<script>window.open('categories.php?msg=error','_self');</script>";
        }
    }
}


if (isset($_POST['add_product'])) {
    $product = trim($_POST['product']);
    $description = trim($_POST['description']);
    $price = floatval($_POST['price']);
    $deadline = $_POST['deadline'];
    $category_id = intval($_POST['category_id']);

    // Convert datetime-local to MySQL DATETIME
    $deadline = str_replace('T', ' ', $deadline) . ':00';

    // Check if product already exists
    $check = "SELECT * FROM products WHERE product = '$product'";
    $result = mysqli_query($dbcon, $check);

    if (mysqli_num_rows($result) > 0) {
        // Product already exists
        echo "<script>window.open('products.php?msg=exists','_self');</script>";
    } else {
        // Insert new product
        $sql = "INSERT INTO products (product, description, price, deadline, category_id) 
                VALUES ('$product', '$description', $price, '$deadline', $category_id)";
        if (mysqli_query($dbcon, $sql)) {
            echo "<script>window.open('products.php?msg=success','_self');</script>";
        } else {
            echo "<script>window.open('products.php?msg=error','_self');</script>";
        }
    }
}

if (isset($_POST['signup'])) {

    // Sanitize inputs
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');

    // ✅ Check required fields
    if (empty($fullname) || empty($email) || empty($phone) || empty($username) || empty($password)) {
        header("Location: signup.php?msg=missing_fields");
        exit();
    }

    // ✅ Check if passwords match
    if ($password !== $confirm_password) {
        header("Location: signup.php?msg=password_mismatch");
        exit();
    }

    // ✅ Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: signup.php?msg=invalid_email");
        exit();
    }

    // ✅ Check if user already exists
    $stmt = $dbcon->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // User already exists
        header("Location: signup.php?msg=exists");
        exit();
    }

    // ✅ Hash password before saving
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // ✅ Insert new user securely
    $stmt = $dbcon->prepare("INSERT INTO users (fullname, email, phone, username, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $fullname, $email, $phone, $username, $hashed_password);

    if ($stmt->execute()) {
        header("Location: login.php?msg=success");
        exit();
    } else {
        header("Location: signup.php?msg=error");
        exit();
    }
}


if (isset($_POST['signin'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $check_user = "SELECT * FROM users WHERE email = '$email' AND password='$password'";
    $run = mysqli_query($dbcon,$check_user);
    if (mysqli_num_rows($run)>0) {
        $_SESSION['email'] = $email;
        echo "<script>window.open('users/dashboard.php','_self')</script>";
    }else{
        echo "<script>window.open('login.php?msg=error','_self')</script>";
    }
}
?>