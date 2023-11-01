<?php
require_once('config/config.php');

session_start();

// Periksa apakah pengguna sudah login dan memiliki peran yang sesuai (misalnya 'group_user')
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'group_user') {
    header('Location: login.php'); // Redirect jika pengguna tidak memiliki akses
    exit();
}

if (isset($_POST['press_bell'])) {
    $user_id = $_SESSION['user_id'];

    // Periksa apakah data sudah ada dalam tabel button_presses untuk pengguna yang sama
    $check_sql = "SELECT COUNT(*) FROM button_presses WHERE user_id = '$user_id'";
    $count_result = $conn->query($check_sql);

    if ($count_result && $count_result->fetch_row()[0] == 0) {
        $sql = "INSERT INTO button_presses (user_id, timestamp) VALUES ('$user_id', NOW())";

        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Tombol ditekan.");</script>';
        } else {
            echo '<script>alert("Error: ' . $sql . '\n' . $conn->error . '");</script>';
        }
    } else {
        echo '<script>alert("Anda sudah menekan tombol sebelumnya.");</script>';
    }
}


if (isset($_POST['logout'])) {
    session_destroy(); // Hentikan sesi pengguna
    header('Location: login.php'); // Redirect ke halaman login setelah logout
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
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

    .dashboard-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        text-align: center;
        max-width: 400px;
        width: 100%;
    }

    .logout-button {
        float: right;
        background-color: #dc3545;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 15px;
        cursor: pointer;
        padding: 5px 10px;
        transition: background-color 0.3s;
    }

    .logout-button:hover {
        background-color: #c82333;
    }

    .bell-button {
        display: block;
        margin: 0 auto 20px;
        background-color: #007BFF;
        color: #fff;
        border: none;
        border-radius: 50%;
        /* Membuatnya menjadi tombol bulat */
        width: 150px;
        /* Lebar dan tinggi sesuai preferensi Anda */
        height: 150px;
        font-size: 24px;
        /* Ukuran teks ikon */
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: background-color 0.3s;
    }

    .bell-button:hover {
        background-color: #0056b3;
    }

    .icon-bell {
        font-size: 80px;
        /* Ukuran ikon bel sesuai preferensi Anda */
    }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <form method="post">
            <button class="logout-button" type="submit" name="logout">
                <i class="fas fa-sign-out-alt icon-logout"></i>
            </button>
        </form>
        <br>
        <h2><?= $_SESSION['username'] ?></h2>
        <form method="post">
            <button class="bell-button" type="submit" name="press_bell">
                <i class="fas fa-bell icon-bell"></i>
            </button>
        </form>
    </div>
</body>

</html>