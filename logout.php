<?php
session_start();

session_destroy();

header('Location: initial-page.html');
exit;
?>
