<?php
require_once('config/config.php');

session_start();

// Periksa apakah pengguna sudah login dan memiliki peran yang sesuai (misalnya 'group_user')
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect jika pengguna tidak memiliki akses
    exit();
}

if (isset($_POST['logout'])) {
    session_destroy(); // Hentikan sesi pengguna
    header('Location: login.php'); // Redirect ke halaman login setelah logout
    exit();
}

if (isset($_POST['reset'])) {
    // Perintah SQL untuk menghapus semua data dari tabel button_presses
    $reset_sql = "DELETE FROM button_presses";
    if ($conn->query($reset_sql) === TRUE) {
        echo '<script>alert("Data tombol telah di-reset.");</script>';
        echo '<script>window.location.href = "index.php";</script>'; // Me-reload halaman
    } else {
        echo '<script>alert("Error: ' . $reset_sql . '\n' . $conn->error . '");</script>';
    }
}


?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <script type="text/javascript">
    function reloadData() {
        setTimeout(function() {
            location.reload();
        }, 5000);
    }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0 40px;
        padding: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .index-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        text-align: left;
        max-width: 800px;
        width: 100%;
    }

    .logout-button {
        float: right;
        background-color: #dc3545;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
        padding: 5px 10px;
        transition: background-color 0.3s;
    }

    .reset-button {
        background-color: #007BFF;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
        padding: 5px 10px;
        transition: background-color 0.3s;
    }

    .reset-button:hover,
    .logout-button:hover {
        background-color: #0056b3;
    }

    .table-container {
        margin-top: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #ccc;
    }

    table th,
    table td {
        padding: 8px;
        text-align: left;
        border: 1px solid #ccc;
    }

    table th {
        background-color: #f5f5f5;
    }

    .icon-logout {
        font-size: 16px;
    }
    </style>
</head>

<body onload="reloadData()">
    <div class="index-container">
        <form method="post">
            <button class="logout-button" type="submit" name="logout">
                <i class="fas fa-sign-out-alt icon-logout"></i>
            </button>
            <?php
            if ($_SESSION['role'] === 'admin') {
                echo '<button class="reset-button" type="submit" name="reset">';
                echo '<i class="fas fa-sync-alt"></i>'; // Ganti dengan ikon reset yang sesuai
                echo '</button>';
            }
            ?>
        </form>

        <div class="table-container">
            <h2>Monitoring Board</h2>
            <table>
                <tr>
                    <th>Username</th>
                    <th>Timestamp</th>
                </tr>
                <?php
                $sql = "SELECT u.username, bp.timestamp
                        FROM button_presses bp
                        JOIN users u ON bp.user_id = u.id
                        ORDER BY bp.timestamp ASC";

                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['timestamp']; ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</body>

</html>