#!/bin/bash

SWOOLE_PID=""

start_server() {
  php "$PWD/bootstrap/server.php" & SWOOLE_PID=$!
}

restart_server() {
  if [ -n "$SWOOLE_PID" ]; then
    kill $SWOOLE_PID
    start_server
  else
    start_server
  fi
}

start_server

echo "$PWD"

while inotifywait -r -e modify,move,create,delete "$PWD"; do
  restart_server
done

