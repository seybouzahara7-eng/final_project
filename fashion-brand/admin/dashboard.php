<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body class="admin-body">

<div class="admin-container">
    <h1>Admin Dashboard</h1>

    <div class="admin-actions">
        <a href="add-product.php" class="btn">Add New Product</a>
        <a href="view-orders.php" class="btn">View Orders</a>
        <a href="logout.php" class="btn danger">Logout</a>
    </div>
</div>

</body>

</html>
