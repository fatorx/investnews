# InvestNews

### Technologies
- PHP 8.3 with Laravel
- MySQL 8.0.32

## Instructions for run this app:

### First time

Clone project in your projects folder.
```shell script
$ git clone git@github.com:fatorx/app-investnews.git && cd app-investnews
```
Copy .env.dist to .env and adjust values in the .env file to your preferences.
```shell script
cp .env.dist .env 
```

Add permissions to folder data (MySQL) and api/data (logs, storage files), this is where the persistence files will be kept.
```shell script
chmod 755 data
chmod 755 api/storage
```

Mount the environment based in docker-compose.yml.
```shell script
docker compose up -d --build
```

Execute this commands

```shell script
docker exec app-invest-php-fpm php composer.phar install
```

```shell script
docker exec app-invest-php-fpm php artisan db:seed
```


------
### Working routine
```shell script
docker-compose up -d
```

------
### Access Frontend
```shell script
http://localhost:8081
```

------
### Execute tests
```shell script
docker exec app-invest-php-fpm php artisan test
```
------

------
### View API docs
```shell script
http://localhost:8007/docs/api
```
------


