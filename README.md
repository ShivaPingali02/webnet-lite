# WebNet-lite — Generator Telemetry Dashboard

A cloud-native telemetry dashboard project simulating industrial generator monitoring using PHP, MariaDB, Docker, Kubernetes, and Google Cloud Platform (GCP).

This project was built to gain hands-on practical experience with:

- Linux system administration
- Backend API development
- Containerization using Docker
- Kubernetes deployments and networking
- Cloud infrastructure on GCP
- DevOps and Site Reliability Engineering (SRE) workflows
- Real-world troubleshooting and debugging

---

# Project Overview

WebNet-lite simulates a lightweight industrial telemetry platform where generator devices continuously send telemetry data such as:

- Voltage
- Frequency
- Generator Load (kW)

Telemetry data is ingested through a REST API, stored in MariaDB, and displayed live through a browser dashboard.

The project evolved through multiple stages:

1. Single Rocky Linux VM deployment
2. Apache + PHP + MariaDB stack
3. REST API ingestion
4. Automated telemetry generation using cron
5. Docker containerization
6. Kubernetes deployment using Minikube
7. Public cloud exposure using GCP firewall rules

---

# Architecture

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

# Features

- Live telemetry dashboard
- REST API for telemetry ingestion
- Automated telemetry generation using cron jobs
- Randomized telemetry simulation
- Dockerized PHP application
- Kubernetes Deployments and Services
- MariaDB running inside Kubernetes
- Internal Kubernetes service discovery using DNS
- Public browser access through GCP firewall rules
- Dynamic telemetry updates every minute

---

# Tech Stack

## Cloud & Infrastructure
- Google Cloud Platform (GCP)
- Rocky Linux 10
- Kubernetes (Minikube)

## Backend
- PHP
- MariaDB
- REST API

## DevOps & SRE
- Docker
- Kubernetes
- Cron automation
- Linux system administration
- Kubernetes networking
- Service discovery

---

# Kubernetes Components

## Deployments
- webnet-deployment
- db

## Services
- webnet-service
- db

## Networking
- NodePort exposure
- Internal Kubernetes DNS
- kubectl port-forward

---

# Project Structure

```text
webnet-lite/
├── api.php
├── index.php
├── Dockerfile
├── docker-compose.yml
├── README.md
├── architecture.txt
├── screenshots/
├── scripts/
│   ├── deploy.sh
│   └── send_telemetry.sh
└── k8s/
    ├── deployment.yaml
    ├── service.yaml
    └── db.yaml
```

---

# Example API Request

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

# Key Learning Outcomes

Through this project I gained hands-on experience with:

- Docker image creation and containerization
- Kubernetes Deployments and Services
- Pod-to-pod communication
- Kubernetes internal DNS and service discovery
- MariaDB deployment inside Kubernetes
- Linux administration and troubleshooting
- GCP firewall configuration
- API debugging and database connectivity troubleshooting
- Kubernetes rollout restarts and image rebuilding
- Cron automation and telemetry simulation
- Public exposure of Kubernetes-hosted applications

---

# Challenges Solved

## Kubernetes Service Discovery
Initially the application failed to connect to MariaDB because Kubernetes services require DNS-based service discovery instead of hardcoded IP addresses.

Solution:
- Replaced hardcoded database IP with Kubernetes service name (`db`)
- Rebuilt Docker image
- Redeployed application using Kubernetes rollout restart

## Public Browser Access
External access initially failed due to GCP firewall restrictions.

Solution:
- Configured GCP firewall rule for port 8080
- Used kubectl port-forward for controlled external access

## Dynamic Telemetry Updates
Cron jobs initially sent telemetry to the old VM-based application instead of the Kubernetes-hosted API.

Solution:
- Updated telemetry scripts to target Kubernetes NodePort API endpoint


---

# Screenshots

Add screenshots here:
- Live dashboard
- kubectl get pods
- Kubernetes services

---

# Author

Shiva Shankar Reddy  

