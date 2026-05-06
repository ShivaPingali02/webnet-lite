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

$sql = "SELECT * FROM generators";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>WebNet Dashboard</title>
    <style>
        body {
            font-family: Arial;
            background-color: #f4f6f8;
            padding: 20px;
        }

        h2 {
            color: #333;
        }

        table {
            border-collapse: collapse;
            width: 90%;
            background: white;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: white;
        }
    </style>
</head>
<body>

<h2>⚡Generator Telemetry Dashboard</h2>

<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Location</th>
    <th>Voltage</th>
    <th>Frequency</th>
    <th>Load kW</th>
</tr>

<?php
while($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['location']}</td>
            <td>{$row['voltage']} V</td>
            <td>{$row['frequency']} Hz</td>
            <td>{$row['load_kw']} kW</td>
          </tr>";
}
?>

</table>

</body>
</html>
