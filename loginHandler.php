<?php
session_start(); // Start the session

// Include database configuration
require_once('conect.php');

// Sanitize user input
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$role = $_POST['selectwho'];

// Establish database connection
try {
    $conn = new PDO("mysql:host=127.0.0.1;dbname=policedb", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

// Prepared statement for login query
if ($role === "individual") {
    $sql = "SELECT * FROM individual_users WHERE username = :username AND password = :password";
} elseif ($role === "police") {
    $sql = "SELECT * FROM police_users WHERE username = :username AND password = :password";
} else {
    echo "Invalid role";
    exit();
}

$stmt = $conn->prepare($sql);
$stmt->bindParam(':username', $username, PDO::PARAM_STR);
$stmt->bindParam(':password', $password, PDO::PARAM_STR);

// Execute the query
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    // Start a session and store user data
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $role;

    // Redirect users based on their role
    if ($role === "police") {
        header("Location: police_dashboard.php");
        exit;
    } elseif ($role === "individual") {
        header("Location: individual_dashboard.php");
        exit;
    }
} else {
    // Handle invalid login attempt
    echo "Invalid username or password";
}

// Close database connection
$conn = null;
?>
