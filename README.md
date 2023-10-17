## Run

TECH STACK : LARAVEL
Database : MYSQL

Git Clone

type this command to run:

```Shell
git clone https://github.com/prasetyama/qtasnim.git
```

```Shell
composer install
```

Create file .env and change with your database config

```Shell
cp .env.example .env
```

Migrate Database

```Shell
php artisan migrate
```

Add Products and Orders Seeder
```Shell
php artisan db:seed --class=CreateProductsSeeder

php artisan db:seed --class=CreateOrdersSeeder
```

## Run this Project
```Shell
php artisan serve
```

```Shell
Go to http://localhost:8000/products or http://localhost:8000/orders
```

And also run with another port for API, In this project api use port 3001

Open new tab terminal, and then go to folder project and run this command

```Shell
php artisan serve --port 3001
```
