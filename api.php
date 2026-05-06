<?php

$env_file = __DIR__ . "/.env";

if (file_exists($env_file)) {
    $env = parse_ini_file($env_file);
} else {
    $env = [];
}

$db_host = getenv("DB_HOST") ?: $env["DB_HOST"];
$db_user = getenv("DB_USER") ?: $env["DB_USER"];
$db_pass = getenv("DB_PASS") ?: $env["DB_PASS"];
$db_name = getenv("DB_NAME") ?: $env["DB_NAME"];

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);

$name = $data["name"];
$location = $data["location"];
$voltage = $data["voltage"];
$frequency = $data["frequency"];
$load_kw = $data["load_kw"];

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
