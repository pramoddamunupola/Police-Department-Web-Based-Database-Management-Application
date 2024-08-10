<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "policedb";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Retrieving POST data
$Full_name = $_POST['fname'];
$NIC_number = $_POST['person_id'];
$Address = $_POST['address'];
$Telephone = $_POST['telephone'];
$Occupation = $_POST['occupation'];
$PoliceArea = $_POST['police_area'];
$DateOfBirth = $_POST['date_of_birth'];
$Gender = $_POST['gender'];
$Username = $_POST['username'];
$pass = $_POST['password'];

// Check if username already exists
$query_username = "SELECT * FROM individual_users WHERE USERNAME='$Username'";
$result_username = $conn->query($query_username);

// Check if PERSON_ID already exists
$query_person_id = "SELECT * FROM individual_users WHERE PERSON_ID='$NIC_number'";
$result_person_id = $conn->query($query_person_id);

// Check if full name already exists
$query_full_name = "SELECT * FROM individuals WHERE NAME='$Full_name'";
$result_full_name = $conn->query($query_full_name);

if ($result_username->num_rows > 0 || $result_person_id->num_rows > 0 || $result_full_name->num_rows > 0) {
    echo "Error: This user already exists. Please check your input data!";
} else {
    // Insert into individuals table
    $sql_individuals = "INSERT INTO individuals (PERSON_ID, NAME, ADDRESS, TELE_NO, DATE_OF_BIRTH, GENDER, OCCUPATION, POLICE_AREA) VALUES ('$NIC_number', '$Full_name', '$Address', '$Telephone', '$DateOfBirth', '$Gender', '$Occupation', '$PoliceArea')";
    if ($conn->query($sql_individuals) === TRUE) {
        echo "<br>"."New records created successfully in table 'individuals'"."<br>";
    } else {
        echo "Error: " . $sql_individuals . "<br>" . $conn->error;
    }

    // Insert into individual_users table
    $sql_individual_users = "INSERT INTO individual_users (USERNAME, PASSWORD, PERSON_ID) VALUES ('$Username','$pass','$NIC_number')";
    if ($conn->query($sql_individual_users) === TRUE) {
        echo "New records created successfully in table 'individual_users'";
    } else {
        echo "Error: " . $sql_individual_users . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();

?>
