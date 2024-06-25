<?php
session_start();

$error = '';
function validate_password($password) {
    if (strlen($password) < 8) {
        return 'Password must be at least 8 characters long.';
    }
    if (!preg_match('/[A-Z]/', $password)) {
        return 'Password must contain at least one uppercase letter.';
    }
    if (!preg_match('/[a-z]/', $password)) {
        return 'Password must contain at least one lowercase letter.';
    }
    if (!preg_match('/[0-9]/', $password)) {
        return 'Password must contain at least one number.';
    }
    return '';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    $password_error = validate_password($password);
    if ($password_error) {
        $error = $password_error;
    } else {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $file = fopen('users.txt', 'r');
        $username_exists = false;
        $email_exists = false;

        if ($file) {
            while (($line = fgets($file)) !== false) {
                $user_data = explode(',', trim($line));

                if (count($user_data) === 3) {
                    list($stored_username, $stored_email, $stored_password_hash) = $user_data;

                    if ($username === $stored_username) {
                        $username_exists = true;
                    }

                    if ($email === $stored_email) {
                        $email_exists = true;
                    }

                    if ($username_exists || $email_exists) {
                        break;
                    }
                }
            }
            fclose($file);
        }

        if ($username_exists) {
            $error = 'Username is already taken. Please choose another username.';
        } elseif ($email_exists) {
            $error = 'Email is already in use. Please choose another email.';
        } else {
            $userData = "$username,$email,$password_hash\n";
            file_put_contents('users.txt', $userData, FILE_APPEND | LOCK_EX);

            $_SESSION['username'] = $username;

            header('Location: posts_list.php');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="signup-container">
        <h2>Sign Up</h2>
        <?php if ($error): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form action="signup.php" method="post">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Sign Up</button>
        </form>
    </div>
</body>
</html>
