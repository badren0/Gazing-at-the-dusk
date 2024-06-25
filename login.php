<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    
    $file = fopen('users.txt', 'r');
    if ($file) {
        $login_successful = false;
        
        while (($line = fgets($file)) !== false) {
            $user_data = explode(',', trim($line));
            
            if (count($user_data) === 3) {
                list($stored_username, $stored_email, $stored_password_hash) = $user_data;

                if ($username === $stored_username && password_verify($password, $stored_password_hash)) {
                    $_SESSION['username'] = $username;
                    $login_successful = true;
                    break;
                }
            }
        }
        
        fclose($file);
        
        if ($login_successful) {
            header('Location: posts_list.php');
            exit;
        } else {
            echo "Invalid username or password";
        }
    } else {
        echo "Unable to open the users file.";
    }
} else {
    echo "Invalid request method.";
}
?>
