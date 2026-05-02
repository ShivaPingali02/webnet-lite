# WebNet-lite — Generator Telemetry Dashboard

## Overview
A mini IoT telemetry system simulating generator data ingestion and monitoring.

## Architecture
- PHP (Dashboard + API)
- MariaDB (Database)
- Cron (Automated telemetry ingestion)
- Bash script (simulated IoT data)
- Hosted on GCP VM (Rocky Linux)

## Features
- REST API for telemetry ingestion
- Live dashboard displaying generator data
- Automated telemetry every minute using cron
- Randomized data simulation (voltage/load)

## Sample Flow
Generator → API → Database → Dashboard

## Tech Stack
- Linux (Rocky)
- Apache (httpd)
- PHP
- MariaDB
- Bash scripting
- GCP Compute Engine

## How to Run
1. Start Apache + MariaDB
2. Place files in /var/www/html
3. Run telemetry script manually or via cron

## Future Improvements
- Add MQTT broker
- Dockerize application
- Deploy on Kubernetes (GKE)
- Add monitoring (Grafana + OpenTelemetry)

## Author
Shiva
