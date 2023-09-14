<?php

$servername = "localhost";
$port = 3306;
$username = "root";
$password = "";
$database = "ky040_db";

$conn = new mysqli($servername, $username, $password, $database, $port);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM ky040"; // Change to your table name

// Execute the query
$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    die("Query failed: " . $conn->error);
}
$data = array();
// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Loop through the rows and fetch data
    while ($row = $result->fetch_assoc()) {
        // Access the columns by name
        $data[] = $row;
    }
} else {
    echo "No results found.";
}
header('Content-Type: application/json');
echo json_encode(['sensorValue' => $data]);
?>