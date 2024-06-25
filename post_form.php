<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: initial-page.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link rel="stylesheet" href="mainstyle.css">
</head>
<body class="makepost">
    <div class="post-container">
        <h2>Create Post</h2>
        <form action="submit_post.php" method="post">
            <div class="input-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="input-group">
                <label for="body">Body</label>
                <textarea id="body" name="body" required></textarea>
            </div>
            <div class="button-center">
            <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
