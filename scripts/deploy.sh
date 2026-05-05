#!/bin/bash

echo "Deploying WebNet-lite..."

sudo cp ~/webnet-lite/*.php /var/www/html/

sudo systemctl restart httpd

echo "Deployment complete"
