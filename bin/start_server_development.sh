#!/bin/bash

sleep 3

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

while inotifywait -r -e modify,move,create,delete "$PWD/app"; do
  restart_server
done

