# Docker LAMP environment boilerplate

## Container explanation

[Docker compose](https://docs.docker.com/compose/) project that has three services to allow lamp web development with ease. The three images are the following ones:

 - php:8.1.10-apache
 - mysql
 - phpmyadmin

### PHP
The php environment is modified by a Dockerfile to update the image, install composer and xdebug. The server is accessible on localhost:8080.

### MYSQL
Just the default image from docker. This image accepts SQL files on initialization that has to be placed into .docker/mysql folder.

### PHPMYADMIN
Just the default image from docker linked to MYSQL image. This is accessible on localhost:8081. The default credentials are "root" for the username and "password" for the password. 

## Run Project (local environment)
All comands to run the project are into a Makefile. The first part of that file are commands to manage the containers. The second part are commands to manage a Laravel app, you can ignore that commands if you are not developing a Laravel app.

### Needed commands

Check that you have make, docker and docker-compose installed on your system running the following commands:
- make -v
- docker -v
- docker-compose -v

### Set up steps

1. Download or clone the code in this repository
2. Execute ``make build`` to build docker containers
3. Execute ``make run`` to actually run the containers

### Acces the app

If all the setup steps gone well the url to acces the web server is [localhost:8080](http://localhost:8080) and the url to access the data base (phpMyAdmin) is [localhost:8081](http://localhost:8081).

## Stop Project

To stop the project containers just run the command
``make stop`` or if you want to remove all stopped containers and networks run ``make down``.

## Author

Roger Medico Piqué - [roger.medico@gmail.com](mailto:roger.medico@gmail.com)
