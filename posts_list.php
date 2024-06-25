<?php
// Read posts from file
$file = 'posts.txt';
$posts = file_get_contents($file);

$postEntries = explode("\n---\n", trim($posts));

foreach ($postEntries as $key => $entry) {
    if (substr($entry, -3) === '---') {
        $postEntries[$key] = rtrim($entry, '---');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Posts</title>
    <link rel="stylesheet" href="mainstyle.css">
</head>
<body>
    <div class="container">
        <div class="write-post">
            <a href="post_form.php" class="write-post-link">Write a New Post</a>
        </div>
        <h2>All Posts</h2>
        <div class="posts-list">
            <?php
            foreach ($postEntries as $key => $entry) {
                if (!empty($entry)) {
                    echo '<div class="post">' . nl2br(htmlspecialchars($entry)) . '</div>';
                }
            }
            ?>
        </div>
        
    </div>
    <div class="contact-box">
        <p>For contacting use: <a href="mailto:m.h.tooti@gmail.com">m.h.tooti@gmail.com</a></p>
        <p>this site was created on 26 June 2024, equal to 1403/4/6</p>
        <a href="explain.html">how does this site function?</a>
    </div>
</body>
</html>
