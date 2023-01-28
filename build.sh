#!/bin/bash

echo "Building docker for form project"

echo "Docker build"
docker-compose up -d

echo "Docker ssh"
docker exec -it form-webserver bash
