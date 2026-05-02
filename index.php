<?php

$conn = new mysqli("localhost", "webuser", "Webnet123!", "webnet");

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
        body { font-family: Arial; background-color: #f4f6f8; padding: 20px; }
        h2 { color: #333; }
        table { border-collapse: collapse; width: 90%; background: white; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); }
        th, td { padding: 12px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background-color: #007BFF; color: white; }
    </style>
</head>
<body>

<h2>⚡ Generator Telemetry Dashboard</h2>

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

<?php
$conn->close();
?>
