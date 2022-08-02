#!/bin/bash

docker-compose down
docker-compose up -d --remove-orphans --force-recreate
