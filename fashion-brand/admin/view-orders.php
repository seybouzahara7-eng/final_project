<?php
session_start();
include "../config/db.php";

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['order_id'])) {

    $orderId = intval($_POST['order_id']);

    if (isset($_POST['accept'])) {
        $newStatus = "Accepted";
    }

    if (isset($_POST['decline'])) {
        $newStatus = "Declined";
    }

    $update = $conn->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
    $update->bind_param("si", $newStatus, $orderId);
    $update->execute();
    $stmt = $conn->prepare("SELECT email, phone FROM orders WHERE order_id = ?");
    $stmt->bind_param("i", $orderId);
    $stmt->execute();
    $result = $stmt->get_result();
    $order = $result->fetch_assoc();
    if (!empty($order['email'])) {
        $to = $order['email'];
        $subject = "Your Order Status";
        $message = "Hello,\n\nYour order has been $newStatus.\nThank you for shopping with us.";
        $headers = "From: no-reply@yourbrand.com";

        mail($to, $subject, $message, $headers);
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Orders</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body class="admin-body">

<div class="admin-container">
    <h2>Customer Orders</h2>
</div>
    <table class="admin-table">
        <tr>
            <th>Customer</th>
            <th>Phone</th>
            <th>Product</th>
            <th>Price</th>
            <th>Status</th>
            <th>Action</th>
        </tr>


    <?php
    $query = "SELECT * FROM orders ORDER BY order_id DESC";
    $result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($result)){
    ?>
        <tr>
            <td><?= $row['customer_name']; ?></td>
            <td><?= $row['phone']; ?></td>
            <td><?= $row['product_name']; ?></td>
            <td>$<?= $row['price']; ?></td>
            <td class="status-<?= strtolower($row['status']); ?>">
                <?= $row['status']; ?>
            </td>
            <td>
            <?php if ($row['status'] === 'Pending'): ?>
                <form method="post">
                    <input type="hidden" name="order_id" value="<?= $row['order_id']; ?>">
                    <button class="action-btn btn-accept" name="accept">Accept</button>
                    <button class="action-btn btn-decline" name="decline">Decline</button>
                </form>
            <?php else: ?>
                -
            <?php endif; ?>
            </td>
        </tr>
    <?php } ?>

    </table>
</div>

</body>
</html>
