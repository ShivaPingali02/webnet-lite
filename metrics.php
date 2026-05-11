<?php

header("Content-Type: text/plain");

$env = parse_ini_file(__DIR__ . "/.env");

$db_host = $env["DB_HOST"];
$db_user = $env["DB_USER"];
$db_pass = $env["DB_PASS"];
$db_name = $env["DB_NAME"];

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    echo "# HELP webnet_database_connection_status Database connection status. 1 means connected, 0 means failed.\n";
    echo "# TYPE webnet_database_connection_status gauge\n";
    echo "webnet_database_connection_status 0\n";
    exit;
}

echo "# HELP webnet_database_connection_status Database connection status. 1 means connected, 0 means failed.\n";
echo "# TYPE webnet_database_connection_status gauge\n";
echo "webnet_database_connection_status 1\n";

$total = $conn->query("SELECT COUNT(*) AS total FROM generators")->fetch_assoc();

echo "# HELP webnet_total_generators Total number of telemetry records.\n";
echo "# TYPE webnet_total_generators gauge\n";
echo "webnet_total_generators " . $total["total"] . "\n";

$latest = $conn->query("SELECT * FROM generators ORDER BY id DESC LIMIT 1")->fetch_assoc();

if ($latest) {
    echo "# HELP webnet_latest_record_id Latest telemetry record ID.\n";
    echo "# TYPE webnet_latest_record_id gauge\n";
    echo "webnet_latest_record_id " . $latest["id"] . "\n";

    echo "# HELP webnet_latest_voltage Latest generator voltage.\n";
    echo "# TYPE webnet_latest_voltage gauge\n";
    echo "webnet_latest_voltage " . $latest["voltage"] . "\n";

    echo "# HELP webnet_latest_frequency Latest generator frequency.\n";
    echo "# TYPE webnet_latest_frequency gauge\n";
    echo "webnet_latest_frequency " . $latest["frequency"] . "\n";

    echo "# HELP webnet_latest_load_kw Latest generator load in kW.\n";
    echo "# TYPE webnet_latest_load_kw gauge\n";
    echo "webnet_latest_load_kw " . $latest["load_kw"] . "\n";
}

$conn->close();

?>
