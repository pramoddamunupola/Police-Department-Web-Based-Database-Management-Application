<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "policedb";


// Create connection
$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$sql = "SELECT POLICE_AREA FROM POLICE_AREA";
$result = $conn->query($sql);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        body {
            font-family: 'Gill Sans', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        header {
            color: #333;
            text-align: center;
            padding: 20px 0;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        label {
            margin-bottom: 6px;
            display: block;
            font-weight: bold;
        }
        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="radio"] {
            margin-right: 5px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <h1>WELCOME TO THE REGISTRATION!</h1>
    </header>
    <form action="registerHandler.php" method="post">
        <label for="fname">Full Name:</label>
        <input type="text" id="fname" name="fname" required>
        
        <label for="person_id">NIC Number:</label>
        <input type="text" id="person_id" name="person_id" required>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required>

        <label for="telephone">Telephone Number:</label>
        <input type="text" id="telephone" name="telephone" required>

        <label for="occupation">Occupation:</label>
        <input type="text" id="occupation" name="occupation" required>

        <label for="police_area">Police Area:</label>
        <select id="police_area" name="police_area" required>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["POLICE_AREA"] . "'>" . $row["POLICE_AREA"] . "</option>";
                }
            }
            
$conn->close();
            ?>
        </select>

        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" id="date_of_birth" name="date_of_birth" required>

        
        <label for="Gender">Gender:</label>
        <select id="gender" name="gender" default = 'select' required>
        <option value="male">Male</option>
        <option value="female">Female</option>
        </select>
        
        
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="Password">Password:</label>
        <input type="text" id="password" name="password" required>

        <input type="submit" value="Submit"><br><br>

        <a href="loging.html">Already have an account? click here to logging</a>
    </form>
</body>
</html>
