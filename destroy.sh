#!/bin/bash

docker kill form-database form-phpmyadmin form-webserver
docker rm form-database form-phpmyadmin form-webserver
docker rmi form-server