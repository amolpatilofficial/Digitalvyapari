<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}
require 'config.php';

// Fetch user count per state
$state_query = "SELECT state, COUNT(*) as count FROM User_details GROUP BY state";
$state_result = $conn->query($state_query);
$states = [];
$state_counts = [] ;
while ($row = $state_result->fetch_assoc()) {
    $states[] = $row['state'];
    $state_counts[] = $row['count'];
}

// Fetch user details
$user_query = "SELECT * FROM User_details";
$user_result = $conn->query($user_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="flex flex-col items-center bg-gray-200 min-h-screen p-4">
    <h1 class="text-3xl mb-6">Admin Dashboard</h1>
    
    <!-- User Registrations by State Chart -->
    <div class="container mx-auto mt-6">
        <h2 class="text-2xl font-bold mb-4">User Registrations by State</h2>
        <canvas id="stateChart"></canvas>
    </div>

    <table class="min-w-full bg-white mt-8">
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
            <?php while ($row = $user_result->fetch_assoc()): ?>
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

    <script>
        const ctx = document.getElementById('stateChart').getContext('2d');
        const stateChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($states); ?>,
                datasets: [{
                    label: '# of Users',
                    data: <?php echo json_encode($state_counts); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
