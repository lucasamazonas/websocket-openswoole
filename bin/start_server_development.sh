#!/bin/bash

DIR="$PWD"
SWOOLE_PID=""

start_server() {
  php "$DIR/server.php" & SWOOLE_PID=$!
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

while inotifywait -e modify,move,create,delete "$DIR"; do
  restart_server
done

