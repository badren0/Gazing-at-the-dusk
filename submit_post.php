<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: initial-page.html');
    exit;
}

$title = htmlspecialchars($_POST['title']);
$body = htmlspecialchars($_POST['body']);
$username = htmlspecialchars($_SESSION['username']);
$date = date('Y-m-d H:i:s');

$post = "Title: $title\nAuthor: $username\nDate: $date\nBody: $body\n---\n";

$file = 'posts.txt';
file_put_contents($file, $post, FILE_APPEND | LOCK_EX);

header('Location: posts_list.php');
exit;
?>
