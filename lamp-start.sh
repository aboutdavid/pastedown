#!/bin/bash

.mysql/run-mysqld.sh &
.apache2/run-apache2.sh &

wait
