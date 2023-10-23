FROM openswoole/swoole:latest-dev

WORKDIR /usr/src/app

COPY . .

RUN apt-get update

RUN apt-get install inotify-tools -y && apt-get install procps -y

RUN chmod +x bin/start_server_development.sh
