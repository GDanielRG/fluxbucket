## About Fluxbucket

Fluxbucket is a web application for creating simple orders.

## Setting up Fluxbucket

This project assumes you have previously worked with Laravel and have already gone through the setup process in your machine following these steps: [Laravel installation](https://laravel.com/docs/9.x/installation)

Installing back-end dependencies

```bash
composer install
```

Installing front-end dependencies

```bash
npm install
```

Create an empty mysql database, copy the file `.env.example` into `.env` and [setup your project environment](https://laravel.com/docs/9.x/configuration#environment-configuration) Making sure your database information is correctly set. 

Also make sure you generate you encryption key

```bash
php artisan key:generate
```

After that run the migrations and the database seeder. 

```bash
php artisan migrate:fresh --seed
```

The seeder will create a new user with the email `hello@fluxbucket.com` and password `password`, which you can use to explore the application.

Finally make sure you are running the watcher to listen for any front-end asset changes


```bash
npm run watch
```

## How to test


```bash
php artisan test
```
