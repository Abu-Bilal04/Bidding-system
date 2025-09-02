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
    // Sanitize inputs
    $product     = mysqli_real_escape_string($dbcon, trim($_POST['product_name']));
    $description = mysqli_real_escape_string($dbcon, trim($_POST['description']));
    $price       = floatval($_POST['price']);
    $deadline    = $_POST['deadline'];
    $category_id = intval($_POST['category_id']);

    // Convert datetime-local to MySQL DATETIME
    $deadline = str_replace('T', ' ', $deadline) . ':00';

    // Handle image upload
    $image = $_FILES['product_image']['name'];
    $tmp_name = $_FILES['product_image']['tmp_name'];
    $folder = "products/";

    // Generate unique filename to avoid conflicts
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $image_name = uniqid("prod_", true) . "." . strtolower($image_ext);
    $image_path = $folder . $image_name;

    // Check if product already exists
    $check = "SELECT * FROM products WHERE product = '$product'";
    $result = mysqli_query($dbcon, $check);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>window.open('products.php?msg=exists','_self');</script>";
    } else {
        // Move uploaded image
        if (move_uploaded_file($tmp_name, $image_path)) {
            // Insert new product with image
            $sql = "INSERT INTO products (product, description, price, deadline, category_id, image) 
                    VALUES ('$product', '$description', $price, '$deadline', $category_id, '$image_name')";

            if (mysqli_query($dbcon, $sql)) {
                echo "<script>window.open('products.php?msg=success','_self');</script>";
            } else {
                echo "<script>window.open('products.php?msg=error','_self');</script>";
            }
        } else {
            echo "<script>window.open('products.php?msg=image_error','_self');</script>";
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

    //  Check required fields
    if (empty($fullname) || empty($email) || empty($phone) || empty($username) || empty($password)) {
        header("Location: signup.php?msg=missing_fields");
        exit();
    }

    //  Check if passwords match
    if ($password !== $confirm_password) {
        header("Location: signup.php?msg=password_mismatch");
        exit();
    }

    //  Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: signup.php?msg=invalid_email");
        exit();
    }

    //  Check if user already exists
    $stmt = $dbcon->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // User already exists
        header("Location: signup.php?msg=exists");
        exit();
    }

    //  Hash password before saving
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert new user securely
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
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $check_user = "SELECT * FROM users WHERE email = '$email'";
    $run = mysqli_query($dbcon,$check_user);
    if (mysqli_num_rows($run)>0) {
        $row = mysqli_fetch_assoc($run);
        if (password_verify($password, $row['password'])) {
            $_SESSION['email'] = $email;
            echo "<script>window.open('users/dashboard.php','_self')</script>";
        } else {
            echo "<script>window.open('login.php?msg=error','_self')</script>";
        }
    }else{
        echo "<script>window.open('login.php?msg=error','_self')</script>";
    }
}


if (isset($_POST['place_bid'])) {
    $product_id    = intval($_POST['product_id']);
    $product_name  = mysqli_real_escape_string($dbcon, $_POST['product_name']);
    $bid_price     = floatval($_POST['bid_price']);
    $fullname      = mysqli_real_escape_string($dbcon, $_POST['fullname']);
    $email         = mysqli_real_escape_string($dbcon, $_POST['email']);
    $phone         = mysqli_real_escape_string($dbcon, $_POST['phone']);

    // Get the current price (highest bid or product price)
    $bid_result = mysqli_query($dbcon, "SELECT MAX(bid_price) as highest_bid FROM bids WHERE product_id = $product_id");
    $highest_bid_row = mysqli_fetch_assoc($bid_result);
    $current_price = $highest_bid_row['highest_bid'] ?? 0;

    // Fallback to original product price if no bids yet
    if ($current_price <= 0) {
        $product_result = mysqli_query($dbcon, "SELECT price FROM products WHERE id = $product_id");
        $product_row = mysqli_fetch_assoc($product_result);
        $current_price = $product_row['price'];
    }

    // Validate bid
    if ($bid_price > $current_price) {
        $query = "
            INSERT INTO bids (product_id, product_name, current_price, bid_price, fullname, email, phone, created_at)
            VALUES ('$product_id', '$product_name', '$current_price', '$bid_price', '$fullname', '$email', '$phone', NOW())
        ";

        if (mysqli_query($dbcon, $query)) {
            echo "<script>alert('Your bid of $$bid_price has been recorded successfully!'); window.location='dashboard.php';</script>";
        } else {
            echo "<script>alert('Error recording your bid. Please try again.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Your bid must be higher than the current price of $$current_price.'); window.history.back();</script>";
    }
}

?>