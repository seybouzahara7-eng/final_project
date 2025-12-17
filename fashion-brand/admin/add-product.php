<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp, "../assets/images/" . $image);

    $query = "INSERT INTO products (name, price, category, image, description)
              VALUES ('$name', '$price', '$category', '$image', '$description')";

    mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body class="admin-body">
    <div class="admin-container">

        <h2>Add New Product</h2>

        <form method="POST" enctype="multipart/form-data" class="admin-form">            <input type="text" name="name" placeholder="Product name" required><br><br>
            <input type="number" step="0.01" name="price" placeholder="Price" required><br><br>

            <select name="category">
                <option>Slippers</option>
                <option>Clothes</option>
            </select><br><br>

            <input type="file" name="image" required><br><br>

            <textarea name="description" placeholder="Description"></textarea><br><br>

            <button name="add">Publish Product</button>
        </form>
    </div>
</body>
</html>
