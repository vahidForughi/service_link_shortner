#!/bin/bash

echo "checking healthy ..."
if [[ -z "$DB_HOST" "$DB_PORT" ]]; then
  echo "Database is reachable"
else
  echo "Database is not reachable"
  exit 1
fi

if [[ -z "$REDIS_HOST" "$REDIS_PORT" ]]; then
  echo "Redis is reachable"
else
  echo "Redis is not reachable"
  exit 1
fi

#if [ $(curl -o /dev/null -L -s -w "%{http_code}\n" http://localhost/docker-health-check) = "200" ]; then
#    exit 0
#else
#    exit 1
#fi
