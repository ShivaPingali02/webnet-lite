<?php

// Load .env file
$env = parse_ini_file(__DIR__ . "/.env");

// Read database config from .env
$db_host = $env["DB_HOST"];
$db_user = $env["DB_USER"];
$db_pass = $env["DB_PASS"];
$db_name = $env["DB_NAME"];

// Connect to database
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Read values
$name = $data["name"];
$location = $data["location"];
$voltage = $data["voltage"];
$frequency = $data["frequency"];
$load_kw = $data["load_kw"];

// Insert data using prepared statement
$stmt = $conn->prepare(
    "INSERT INTO generators (name, location, voltage, frequency, load_kw)
     VALUES (?, ?, ?, ?, ?)"
);

$stmt->bind_param("ssidd", $name, $location, $voltage, $frequency, $load_kw);

if ($stmt->execute()) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error"]);
}

$stmt->close();
$conn->close();

?>
