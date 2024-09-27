<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);

    $usersFile = 'users.json';

    if (file_exists($usersFile)) {
        $users = json_decode(file_get_contents($usersFile), true);
    } else {
        echo "No registered users found.";
        exit;
    }

    foreach ($users as $user) {
        if ($user['username'] === $username && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;

            if ($remember) {
                setcookie('username', $username);
            }

            header("Location: application_form.php");
            exit;
        }
    }

    echo "Invalid username or password.";
}

$usernameValue = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div>
        <form method="POST">
            <h2>Login</h2>
            <label for="username">Username:</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($usernameValue); ?>" required><br><br>

            <label for="password">Password:</label>
            <input type="password" name="password" required><br><br>

            <label for="remember">Remember Me:</label>
            <input type="checkbox" name="remember" id="remember"><br><br>

            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</body>

</html>