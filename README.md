# How to run #

Once you're done, simply `cd` to your project and run `docker-compose up -d`. This will initialise and start all the
containers, then leave them running in the background.

After you create docker container you must install composer packages. And generate .env

**composer install**

**cp .env.example .env**

Go to php container and migrate all db

**php artisan migrate**


## Services exposed outside your environment ##

You can access your application via **`localhost`**. Mailhog and nginx both respond to any hostname, in case you want to
add your own hostname on your `/etc/hosts`

Service|Address outside containers
-------|--------------------------
Webserver|[localhost:41000](http://localhost:41000)
MySQL|**host:** `localhost`; **port:** `41002`

## Hosts within your environment ##

You'll need to configure your application to use any services you enabled:

Service|Hostname|Port number
------|---------|-----------
php-fpm|php-fpm|9000
MySQL|mysql|3306 (default)

## Web routes ##

**/register** - register

**/login** - login

**/survey/create** - create survey

**/survey/edit/{id}** - edit survey by id

**/survey/delete/{id}** - delete survey by id

**/survey/take/{id}** - take survey by id

**/survey/own** - your survey

## Api routes ##

**/survey/random** - random survey and answer for options