# CCRC Community Portal

This application loads communities through an API and allows users to register to take control of managing those communities, as well as favoriting, contacting, and sharing those listings

## Running Locally with Docker

Create a .env file

```
cp .env.example .env
```

Make sure the docker port variables in .env are correctly set to an available port on your machine and the mysql database port matches your docker port

```
DOCKER_NGINX_PORT=8099
DOCKER_MYSQL_PORT=3399
...
DB_PORT=3399
```

Run docker-compose to bring up the docker container and start your app

```
docker-compose up
```

This command shell should now display the running instance data. 

In a new shell, get the docker id, and then use that id to bash into the application:

```
docker ps
```

find the id of the docker container named "bcdev/app", replace this id with the one below)

```
docker exec -it b53cfd7ffb21 bash
cd /var/www/html
```

In this new bash window, you can call any composer or artisan commands needed.

Install composer packages and generate a new key for your .env file:

```
composer install
php artisan key:generate
```

At this point, you should be able to see the application homepage by visiting:

```
http://localhost:8090 (Replace with the nginx port set in .env)
```

Then, you can run database migrations and generate fake users:

```
php artisan migrate
php artisan db:seed
```

**Note**: If the database fails to connect, I've been able to remedy by changing `DB_HOST=localhost` to your correct local IP when running `ipconfig`

You will now be able to login as a test user for each role:

Administrator:
```
email: admin@admin.com
pass: admin
```

Basic User:
```
email: authenticated@authenticated.com
pass: authenticated
```
