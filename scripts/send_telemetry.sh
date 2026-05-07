#!/bin/bash

VOLTAGE=$((220 + RANDOM % 21))
LOAD=$((80 + RANDOM % 81))

curl -X POST http://34.89.61.1/api.php \
-H "Content-Type: application/json" \
-d "{\"name\":\"Auto-Gen\",\"location\":\"Birmingham\",\"voltage\":$VOLTAGE,\"frequency\":50.0,\"load_kw\":$LOAD}"
