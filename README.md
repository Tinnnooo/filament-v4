## Installation

Clone the repo locally:

```sh
git clone https://github.com/Tinnnooo/filament-v4.git && cd filament-v4
```

Install PHP dependencies:

```sh
composer install
```

Setup configuration:

```sh
cp .env.example .env
```

Generate application key:

```sh
php artisan key:generate
```

Create an SQLite database. You can also use another database (MySQL, Postgres), simply update your configuration accordingly.

```sh
touch database/database.sqlite
```

Run database migrations:

```sh
php artisan migrate
```

Run database seeder:

```sh
php artisan db:seed
```

> **Note**  
> If you get an "Invalid datetime format (1292)" error, this is probably related to the timezone setting of your database.  
> Please see https://dba.stackexchange.com/questions/234270/incorrect-datetime-value-mysql

Run the dev server (the output will give the address):

```sh
composer dev
```

You're ready to go! Visit the url in your browser, and login with:

-   **Username:** test@example.com
-   **Password:** password
