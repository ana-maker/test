#!/bin/bash

CMD="bin/console ${1}"

docker-compose exec php $CMD
