<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_user = mysqli_real_escape_string($conn, $_POST['admin_user']);
    $admin_pass = mysqli_real_escape_string($conn, $_POST['admin_pass']);

    $query = "SELECT * FROM Admins WHERE username='$admin_user' AND password=SHA('$admin_pass')";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $_SESSION['admin'] = $admin_user;
        header("Location: admin_dashboard.php");
    } else {
        echo "<script>alert('Invalid credentials');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-200">
    <div class="bg-white p-10 rounded shadow-lg">
        <h2 class="text-2xl mb-4">Admin Login</h2>
        <form action="" method="post">
            <div class="mb-4">
                <label class="block text-gray-700">Username</label>
                <input type="text" name="admin_user" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Password</label>
                <input type="password" name="admin_pass" class="w-full p-2 border rounded" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Login</button>
        </form>
    </div>
</body>
</html>
