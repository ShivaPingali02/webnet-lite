# WebNet-lite — Generator Telemetry Dashboard

A cloud-native telemetry dashboard project simulating industrial generator monitoring using PHP, MariaDB, Docker, Kubernetes, Prometheus, and Google Cloud Platform (GCP).

This project demonstrates hands-on experience with Linux administration, backend API development, containerization, Kubernetes deployments, cloud networking, automation, troubleshooting, and observability.

---

## Project Overview

WebNet-lite simulates a lightweight industrial telemetry platform where generator devices continuously send telemetry data such as:

- Voltage
- Frequency
- Generator Load (kW)

Telemetry data is ingested through a REST API, stored in MariaDB, displayed on a live dashboard, and exposed as Prometheus-compatible metrics for monitoring.

The project evolved through multiple stages:

1. Rocky Linux VM on GCP
2. Apache + PHP + MariaDB stack
3. REST API telemetry ingestion
4. Automated telemetry generation using cron
5. Docker containerization
6. Kubernetes deployment using Minikube
7. Public cloud access using GCP firewall rules
8. Prometheus-based metrics monitoring

---

## Architecture

```text
Telemetry Script (Cron)
      |
      v
REST API (PHP)
      |
      v
MariaDB Database
      |
      v
Live Dashboard
      |
      v
Prometheus Metrics Endpoint
      |
      v
Prometheus Monitoring
```

```text
User Browser
      |
      v
GCP VM External IP :8080
      |
      v
kubectl port-forward
      |
      v
Kubernetes NodePort Service
      |
      v
PHP Application Pod
      |
      v
MariaDB Service (db)
      |
      v
MariaDB Pod
```

---

## Features

- Live generator telemetry dashboard
- REST API for telemetry ingestion
- Automated telemetry generation using cron jobs
- Randomized telemetry simulation
- Dockerized PHP application
- Kubernetes Deployments and Services
- MariaDB running inside Kubernetes
- Internal Kubernetes service discovery using DNS
- Public browser access through GCP firewall rules
- Prometheus-compatible `/metrics.php` endpoint
- Real-time telemetry observability
- Kubernetes monitoring integration

---

## Tech Stack

### Cloud & Infrastructure

- Google Cloud Platform (GCP)
- Rocky Linux 10
- Kubernetes with Minikube

### Backend

- PHP
- MariaDB
- REST API

### DevOps & Automation

- Docker
- Kubernetes
- Bash scripting
- Cron automation
- Linux system administration

### Observability

- Prometheus
- Custom metrics endpoint
- Real-time telemetry monitoring

---

## Kubernetes Components

### Deployments

- webnet-deployment
- db
- prometheus

### Services

- webnet-service
- db
- prometheus-service

### Networking

- NodePort exposure
- Internal Kubernetes DNS
- kubectl port-forward
- GCP firewall rules

---

## Project Structure

```text
webnet-lite/
├── api.php
├── index.php
├── metrics.php
├── Dockerfile
├── docker-compose.yml
├── README.md
├── architecture.txt
├── screenshots/
├── docs/
├── monitoring/
│   └── prometheus.yaml
├── scripts/
│   ├── deploy.sh
│   └── send_telemetry.sh
└── k8s/
    ├── deployment.yaml
    ├── service.yaml
    └── db.yaml
```

---

## Example API Request

```bash
curl -X POST http://<NODE-IP>:30080/api.php \
-H "Content-Type: application/json" \
-d '{
  "name":"K8s-Auto-Gen",
  "location":"Birmingham",
  "voltage":236,
  "frequency":50.1,
  "load_kw":125.5
}'
```

---

## Prometheus Metrics

The application exposes Prometheus-compatible metrics through:

```text
/metrics.php
```

Example metrics:

```text
webnet_database_connection_status 1
webnet_total_generators 41
webnet_latest_record_id 41
webnet_latest_voltage 223
webnet_latest_frequency 50.0
webnet_latest_load_kw 157.00
```

These metrics allow Prometheus to monitor:

- Database connection health
- Total telemetry records
- Latest voltage
- Latest frequency
- Latest generator load

---

## Monitoring & Observability

Prometheus is deployed inside Kubernetes and scrapes the application metrics endpoint in real time.

```text
Prometheus
      |
      v
Scrapes /metrics.php
      |
      v
Monitors telemetry and application health
```

This provides a lightweight observability setup that can later be extended with Grafana dashboards and alerting.

---

## Key Learning Outcomes

Through this project I gained hands-on experience with:

- Linux VM setup and package installation
- Apache, PHP, and MariaDB configuration
- REST API development
- Database integration and troubleshooting
- Bash scripting and cron automation
- Docker image creation
- Kubernetes Deployments and Services
- Kubernetes internal DNS and service discovery
- MariaDB deployment inside Kubernetes
- Public cloud networking using GCP firewall rules
- Prometheus-compatible metrics implementation
- Kubernetes monitoring and observability
- GitHub documentation and project presentation

---

## Challenges Solved

### Kubernetes Service Discovery

Initially the application failed to connect to MariaDB because Kubernetes services require DNS-based service discovery instead of hardcoded IP addresses.

Solution:

- Replaced hardcoded database IP with Kubernetes service name `db`
- Rebuilt Docker image
- Redeployed application using Kubernetes rollout restart

### Public Browser Access

External access initially failed due to GCP firewall restrictions.

Solution:

- Configured GCP firewall rule for port 8080
- Used kubectl port-forward for controlled external access

### Dynamic Telemetry Updates

Cron jobs initially sent telemetry to the old VM-based application instead of the Kubernetes-hosted API.

Solution:

- Updated telemetry script to target Kubernetes NodePort API endpoint

### Observability

The application originally had no monitoring endpoint.

Solution:

- Added `/metrics.php`
- Exposed Prometheus-compatible application metrics
- Deployed Prometheus inside Kubernetes
- Verified live telemetry metrics through Prometheus UI

---

## Screenshots

### Live Dashboard

<img width="1708" height="874" alt="image" src="https://github.com/user-attachments/assets/6b1a98e6-1ea0-4b7e-9f73-920ed34cc99a" />


### Kubernetes Pods

<img width="583" height="104" alt="image" src="https://github.com/user-attachments/assets/e7c35897-910d-4e73-945b-2b54512d3568" />


### Kubernetes Services

<img width="694" height="98" alt="image" src="https://github.com/user-attachments/assets/a11b1ac9-97c3-4e14-98ce-dd8444fef86a" />


### Prometheus Metrics

<img width="1898" height="880" alt="image" src="https://github.com/user-attachments/assets/3ecac175-888a-4e62-b5fb-98dc76deb387" />

---


## Author

Shiva Shankar Reddy  

