<?php
include "../config.php";

if (isset($_POST['add'])) {
    $type = $_POST['type'];
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $link = $_POST['link'];

    $img = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "../assets/images/$img");

    $stmt = $conn->prepare(
        "INSERT INTO portfolio_content (type,title,description,image,link)
         VALUES (?,?,?,?,?)"
    );
    $stmt->bind_param("sssss", $type, $title, $desc, $img, $link);
    $stmt->execute();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<style>
body{
    font-family:Arial;
    padding:30px;
    
}
input,textarea,select,button{
    display:block;
    margin:10px 0;
    padding:10px;
    width:400px;
}
button{
background:#b57111;
color:white;
border:none;
}
</style>
</head>
<body>

<h2>Admin Dashboard</h2>

<form method="POST" enctype="multipart/form-data">
<select name="type">
    <option value="about">About</option>
    <option value="project">Project</option>
</select>

<input name="title" placeholder="Title" required>
<textarea name="description" placeholder="Description" required></textarea>
<input name="link" placeholder="Project link (optional)">
<input type="file" name="image" required>
<button name="add">Add Content</button>
</form>

</body>
</html>
