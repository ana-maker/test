#!/bin/bash

CMD="yarn ${1}"

docker run -it --rm --name ph_server_yarn -v "$PWD/..":/usr/src/app -w /usr/src/app node:14 $CMD