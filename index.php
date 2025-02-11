<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database configuration file
require 'config.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$first_name = $last_name = $mobile_no = $state = $district = $taluka = $village = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $mobile_no = mysqli_real_escape_string($conn, $_POST['mobile_no']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $district = mysqli_real_escape_string($conn, $_POST['district']);
    $taluka = mysqli_real_escape_string($conn, $_POST['taluka']);
    $village = mysqli_real_escape_string($conn, $_POST['village']);

    // Check if mobile number already exists
    $check_query = "SELECT * FROM User_details WHERE mobile_no='$mobile_no'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        echo "<script>alert('Error: Mobile number already exists.');</script>";
    } else {
        // Insert query
        $sql = "INSERT INTO User_details (first_name, last_name, mobile_no, state, district, taluka, village) 
                VALUES ('$first_name', '$last_name', '$mobile_no', '$state', '$district', '$taluka', '$village')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Registration successful!');</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(to right, #667eea, #764ba2);
        }
        .fadeIn {
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .flashing-banner {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            padding: 15px;
            border-radius: 10px;
            color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
            animation: flash 1s infinite alternate;
        }
        @keyframes flash {
            0% { background-color: red; }
            100% { background-color: yellow; color: black; }
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen px-4">
    <div class="flex flex-col items-center space-y-6 fadeIn">
        <div class="flashing-banner">
            🚀 Register and Get Money on PhonePe/Paytm! 1 Rs to 100 rs
        </div>

        <div class="bg-white p-10 rounded-2xl shadow-2xl max-w-lg w-full text-center">
            <p class="text-gray-700 text-lg leading-relaxed mt-4">
                📢 <span class="font-semibold">Get Exclusive Offers in Your Local Area!</span> 🎉
            </p>
            <div class="mt-6 text-gray-700 text-left text-lg font-Medium">
                <p class="flex items-center"><span class="text-blue-500 text-xl mr-2">🛒</span> Supermarket Discounts</p>
                <p class="flex items-center"><span class="text-green-500 text-xl mr-2">👕</span> Clothing Store Deals</p>
                <p class="flex items-center"><span class="text-yellow-500 text-xl mr-2">🌾</span> Special Offers for Farmers</p>
                <p class="flex items-center"><span class="text-red-500 text-xl mr-2">🍲</span> Restaurant & Food Discounts</p>
                <p class="flex items-center"><span class="text-indigo-500 text-xl mr-2">🏦</span> Insurance Policy Discounts</p>
                <p class="flex items-center"><span class="text-orange-500 text-xl mr-2">🏪</span> Local Shops Discounts</p>
                <p class="flex items-center"><span class="text-teal-500 text-xl mr-2">👟</span> Footwear Shops Discounts</p>
                <p class="flex items-center"><span class="text-brown-500 text-xl mr-2">🪑</span> Furniture Shops Discounts</p>
            </div>
            <form action="" method="post" class="mt-8 space-y-6">
                <div class="space-y-2">
                    <label class="block text-left text-gray-700 font-semibold">First Name</label>
                    <input type="text" name="first_name" class="w-full p-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm" required>
                </div>
                <div class="space-y-2">
                    <label class="block text-left text-gray-700 font-semibold">Last Name</label>
                    <input type="text" name="last_name" class="w-full p-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm" required>
                </div>
                <div class="space-y-2">
                    <label class="block text-left text-gray-700 font-semibold">Mobile Number</label>
                    <input type="text" name="mobile_no" pattern="[0-9]{10}" class="w-full p-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="block text-left text-gray-700 font-semibold">State</label>
                        <input type="text" name="state" class="w-full p-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm" required>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-left text-gray-700 font-semibold">District</label>
                        <input type="text" name="district" class="w-full p-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm" required>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="block text-left text-gray-700 font-semibold">Taluka</label>
                        <input type="text" name="taluka" class="w-full p-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm" required>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-left text-gray-700 font-semibold">Village</label>
                        <input type="text" name="village" class="w-full p-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm" required>
                    </div>
                </div>
                <button type="submit" class="bg-gradient-to-r from-blue-500 to-purple-600 text-white py-4 w-full rounded-lg text-lg font-bold hover:shadow-xl transition-all">
                    Register Now
                </button>
            </form>
        </div>
    </div>
</body>
</html>
