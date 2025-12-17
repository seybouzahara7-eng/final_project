<?php
$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name    = trim($_POST['name']);
    $email   = trim($_POST['email']);
    $message = trim($_POST['message']);

    if ($name && $email && $message) {
        $success = "Thank you for contacting us. We’ll get back to you shortly.";
    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us | Adorné</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

<?php include "includes/header.php"; ?>

<section class="page">
    <h1>Contact Us</h1>
    <p>We would love to hear from you</p>

    <div class="admin-container" style="max-width:500px;margin:auto;">
        
        <?php if ($success): ?>
            <p style="color:green;"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>

        <?php if ($error): ?>
            <p style="color:red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="POST" class="admin-form">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea name="message" placeholder="Your Message" required></textarea>
            <button type="submit" class="btn">Send Message</button>
        </form>
    </div>
</section>

<?php include "includes/footer.php"; ?>

</body>
</html>
