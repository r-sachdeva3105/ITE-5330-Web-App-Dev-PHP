<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $usersFile = 'users.json';

    if (!file_exists($usersFile)) {
        file_put_contents($usersFile, json_encode([], JSON_PRETTY_PRINT));
    }

    $users = json_decode(file_get_contents($usersFile), true);

    foreach ($users as $user) {
        if ($user['username'] === $username || $user['email'] === $email) {
            echo "Username or email already exists.";
            exit;
        }
    }

    $users[] = [
        'username' => $username,
        'email' => $email,
        'password' => $password
    ];

    $saveStatus = file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));

    if ($saveStatus === false) {
        echo "Error writing to users.json.";
    } else {
        echo "User registered successfully!";
    }
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div>
        <form method="POST">
            <h2>Register</h2>
            <label for="username">Username:</label>
            <input type="text" name="username" required><br><br>

            <label for="email">Email:</label>
            <input type="email" name="email" required><br><br>

            <label for="password">Password:</label>
            <input type="password" name="password" required><br><br>

            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>

</html>