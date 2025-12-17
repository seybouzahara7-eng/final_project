<?php
include 'includes/header.php';
include 'config/db.php';

$query = "SELECT * FROM products ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<section class="page">
    <h1>Shop Our Collection</h1>
    <p>Handcrafted slippers and thoughtfully designed clothing.</p>

    <div class="product-grid">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="product-card">
                <img src="assets/images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                <h3><?php echo $row['name']; ?></h3>
                <p class="price">$<?php echo $row['price']; ?></p>
                <a href="order.php?id=<?php echo $row['id']; ?>" class="btn small">Order</a>
            </div>
        <?php } ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
