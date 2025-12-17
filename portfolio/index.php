<?php
include "config.php";
$about = null;
$aboutRes = $conn->query("SELECT * FROM portfolio_content WHERE type='about' ORDER BY created_at DESC LIMIT 1");
if ($aboutRes && $aboutRes->num_rows > 0) {
    $about = $aboutRes->fetch_assoc();
}

$projectsRes = $conn->query("SELECT * FROM portfolio_content WHERE type='project' ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>My Portfolio</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header>
    <nav>
        <a href="#about">About</a>
        <a href="#projects">Projects</a>
        <a href="#contact">Contact</a>
    </nav>
</header>

<section id="about">
<h2>About Me</h2>
<?php if ($about): ?>
    <img src="assets/images/<?= htmlspecialchars($about['image']) ?>">
    <h3><?= htmlspecialchars($about['title']) ?></h3>
    <p><?= nl2br(htmlspecialchars($about['description'])) ?></p>
<?php else: ?>
    <p>No about info yet.</p>
<?php endif; ?>
</section>

<section id="projects">
<h2>Projects</h2>
<div class="projects">
<?php if ($projectsRes && $projectsRes->num_rows > 0): ?>
<?php while ($p = $projectsRes->fetch_assoc()): ?>
    <div class="card">
        <img src="assets/images/<?= htmlspecialchars($p['image']) ?>">
        <h3><?= htmlspecialchars($p['title']) ?></h3>
        <p><?= nl2br(htmlspecialchars($p['description'])) ?></p>
        <?php if ($p['link']): ?>
            <a href="<?= htmlspecialchars($p['link']) ?>" target="_blank">View Project</a>
        <?php endif; ?>
    </div>
<?php endwhile; ?>
<?php else: ?>
<p>No projects yet.</p>
<?php endif; ?>
</div>
</section>

<section id="contact">
<h2>Contact</h2>
<p>Email: eedinam7@email.com</p>
</section>
<footer>© 2025 Elsie Edinam</footer>
<script src="assets/js/script.js"></script>
</body>
</html>
