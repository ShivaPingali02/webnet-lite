<?php

$conn = new mysqli("localhost", "webuser", "Webnet123!", "webnet");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);

$name = $data['name'];
$location = $data['location'];
$voltage = $data['voltage'];
$frequency = $data['frequency'];
$load_kw = $data['load_kw'];

$sql = "INSERT INTO generators (name, location, voltage, frequency, load_kw)
VALUES ('$name', '$location', '$voltage', '$frequency', '$load_kw')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error"]);
}

$conn->close();

?>
