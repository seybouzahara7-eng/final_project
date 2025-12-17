<?php
include "config/db.php";

if(isset($_POST['order'])){
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $product = $_POST['product'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $total = $price * $quantity;

    $stmt = $conn->prepare(
        "INSERT INTO orders 
        (customer_name, phone, product_name, price, quantity, total_price) 
        VALUES (?, ?, ?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "sssdis",
        $name,
        $phone,
        $product,
        $price,
        $quantity,
        $total
    );

    $stmt->execute();

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Place Order</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<h2>Place Your Order</h2>

<?php 
if(isset($success)) echo "<p style='color:green;'>$success</p>";
if(isset($error)) echo "<p style='color:red;'>$error</p>";
?>

<form method="POST">
    <input type="text" name="name" placeholder="Your Name" required><br><br>
    <input type="text" name="phone" placeholder="Phone Number" required><br><br>
    <input type="text" name="product" placeholder="Product Name" required><br><br>
    <input type="number" name="quantity" placeholder="Quantity" min="1" value="1" required><br><br>
    <input type="number" step="0.01" name="price" placeholder="Price" required><br><br>
    <button type="submit" name="order">Place Order</button>
</form>

</body>
</html>
