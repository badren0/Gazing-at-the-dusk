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
            foreach ($postEntries as $entry) {
                if (!empty($entry)) {
                    $lines = explode("\n", trim($entry));
                    $title = '';
                    $author = '';
                    $date = '';
                    $body = '';

                    foreach ($lines as $line) {
                        if (strpos($line, 'Title: ') === 0) {
                            $title = substr($line, strlen('Title: '));
                        } elseif (strpos($line, 'Author: ') === 0) {
                            $author = substr($line, strlen('Author: '));
                        } elseif (strpos($line, 'Date: ') === 0) {
                            $date = substr($line, strlen('Date: '));
                        } elseif (strpos($line, 'Body: ') === 0) {
                            $body = substr($line, strlen('Body: '));
                        } else {
                            $body .= "\n" . $line;
                        }
                    }
                    
                    echo '<div class="post">';
                    echo '<h3>' . htmlspecialchars($title) . '</h3>';
                    echo '<p><strong>Author:</strong> ' . htmlspecialchars($author) . '</p>';
                    echo '<p><strong>Date:</strong> ' . htmlspecialchars($date) . '</p>';
                    echo '<p>' . nl2br(htmlspecialchars(trim($body))) . '</p>';
                    echo '</div>';
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
