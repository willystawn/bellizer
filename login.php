<?php
require_once('config/config.php');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Login berhasil
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            // Arahkan pengguna berdasarkan peran (role)
            if ($row['role'] === 'admin') {
                header('Location: index.php'); // Redirect ke halaman admin
            } elseif ($row['role'] === 'group_user') {
                header('Location: dashboard.php'); // Redirect ke halaman dashboard pengguna grup
            }
            exit();
        } else {
            $error_message = "Password salah.";
        }
    } else {
        $error_message = "Pengguna tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0 40px;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .login-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        text-align: center;
        max-width: 400px;
        width: 100%;
    }

    .login-container h2 {
        margin: 0;
        color: #333;
    }

    .error-message {
        color: red;
    }

    .login-form {
        margin-top: 20px;
    }

    .form-group {
        margin-bottom: 10px;
        text-align: left;
    }

    .form-group label {
        display: block;
        font-weight: bold;
    }

    .form-group input {
        width: 93%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    .form-group input[type="submit"] {
        background-color: #007BFF;
        color: #fff;
        cursor: pointer;
        width: 100%;
    }

    .form-group input[type="submit"]:hover {
        background-color: #0056b3;
    }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if (isset($error_message)) { ?>
        <p class="error-message"><?php echo $error_message; ?></p>
        <?php } ?>
        <form class="login-form" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" required>
            </div>

            <div class="form-group">
                <input type="submit" name="login" value="Login">
            </div>
        </form>
    </div>
</body>

</html>