#!/bin/bash

CMD="composer ${1}"

docker-compose exec php $CMD
