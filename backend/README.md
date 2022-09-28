# WORD GAME 

Word game is a simple web application

Application should score the word by the following rules:
a) Give 1 point for each unique letter.
b) Give 3 extra points if the word is a palindrome.
c) Give 2 extra points if the word is “almost palindrome”. Definition of “almost palindrome”: if by removing
at most one letter from the word, the word will be a true palindrome.



# SETTING UP DEV ENVIRONMENT
## Prerequisites

* docker 20.10.16
* docker-compose v2.6.0

## Configure

### .env

Create `.env` file inside root folder of this project (based on `.env.dist` file).

### Docker

Create `docker-compose.yml` file inside `.docker` folder of this project (based on `.docker/docker-compose.yml.dist` file). For MacOS we have to use different image for mysql as main mysql repository still doesn't support new architecture.

### Run docker container

From the `.docker` folder run:
```
$ docker-compose up --build
```
All docker related command should be run from the `.docker` folder not the project root if not stated otherwise.

### Run following commands in docker php container

#### Install dependencies with composer
Make sure you have .env or it will fail to run scripts.
```
$ docker-compose exec php bash -c "composer install"
```

or run the commands from docker

```
$ docker-compose exec php bash
$ composer install
```

## Setup hostname

Edit your hosts file so that dragana-word-game.test points to the docker ip address. 0.0.0.0 by default.
On Linux and MacOS it's located at `/etc/hosts`

```
$ sudo nano /etc/hosts
```

/etc/hosts example
```
0.0.0.0 word-game.api.test
```

## Testing

Test are stored in ```tests/``` folder, in subdirectory defined by type of test (eg. ```Unit```), then reflecting folder
test would be stored in ```tests/<testType>/```).

### Run Tests
Run all(Unit and Functional) tests from docker bash
```
$ php bin/phpunit 
```
