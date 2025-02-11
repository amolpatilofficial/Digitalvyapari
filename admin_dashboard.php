<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}
require 'config.php';

$query = "SELECT * FROM User_details";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col items-center bg-gray-200 min-h-screen p-4">
    <h1 class="text-3xl mb-6">Admin Dashboard</h1>
    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2 border">First Name</th>
                <th class="py-2 border">Last Name</th>
                <th class="py-2 border">Mobile Number</th>
                <th class="py-2 border">State</th>
                <th class="py-2 border">District</th>
                <th class="py-2 border">Taluka</th>
                <th class="py-2 border">Village</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td class="py-2 border"><?php echo $row['first_name']; ?></td>
                <td class="py-2 border"><?php echo $row['last_name']; ?></td>
                <td class="py-2 border"><?php echo $row['mobile_no']; ?></td>
                <td class="py-2 border"><?php echo $row['state']; ?></td>
                <td class="py-2 border"><?php echo $row['district']; ?></td>
                <td class="py-2 border"><?php echo $row['taluka']; ?></td>
                <td class="py-2 border"><?php echo $row['village']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
