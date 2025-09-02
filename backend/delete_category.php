<?php
include '../include/db_connection.php'; // your db connection file

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Optional: Check if category exists
    $check = "SELECT * FROM categories WHERE id = $id";
    $res = mysqli_query($dbcon, $check);
    if (mysqli_num_rows($res) > 0) {
        // Delete category
        $delete = "DELETE FROM categories WHERE id = $id";
        if (mysqli_query($dbcon, $delete)) {
            echo "<script>window.location.href = 'categories.php?msg=deleted';</script>";
            exit();
        } else {
            echo "Error deleting category: " . mysqli_error($dbcon);
        }
    } else {
        echo "<script>window.location.href = 'categories.php?msg=notfound';</script>";
        exit();
    }
} else {
    echo "<script>window.location.href = 'categories.php';</script>";
    exit();
}
?>
