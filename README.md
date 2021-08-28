# Laravel Api using Sanctum for authentication

REST API in laravel with an endpoint to fetch information about a shipping

## Installation and Use

Change the *.env.example* to *.env* and add your database info i personally used sqlite with the default port

For SQLite, add (theese are the default settings)
```
DB_CONNECTION=sqlite
DB_HOST=127.0.0.1
DB_PORT=3306
```

Create a _database.sqlite_ file in the _database_ directory

```
# Run the webserver on port 8000 with the following command
php artisan serve
```

## Routes

```
# Public Routes

GET   /api/paquetes
GET   /api/paquetes/:id

POST   /api/login
@body: email, password

POST   /api/register
@body: name, email, password, password_confirmation


# Protected Routes

POST   /api/paquetes
@body: name, tracking, adress, price

PUT   /api/products/:id
@body: ?name, ?tracking, ?adress, ?price

DELETE  /api/paquetes/:id

POST    /api/logout
```

# Tests
To execute a basic test to the PackageController execute the following command
```
$ vendor/bin/phpunit
```