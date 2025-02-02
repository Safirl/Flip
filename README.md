# About Flip

Flip is a student app made with Laravel, blade and mysql. It targets young people (18 - 25 years old) that wants to have
a more diverse and reliable
access to information.

## Setup

### Without docker

You need:

- node >= 20.0
- php >= 8.2
- mysql >= 8.0
- composer

### With docker

You need :

- node >= 20.0
- composer
- docker

You'll need to replace all `php artisan ...` commands
with `sail artisan ...` ([set up an alias for `./vendor/sail`](https://laravel.com/docs/11.x/sail#configuring-a-shell-alias))

### Steps

Run commands in the repository directory :

1. copy and fill missing variables in .env file (like mysql DB credentials)

```bash
cp .env.example .env
```

2. install php dependencies

```bash
composer install
```

3. install node dependencies

```bash
npm install
```

4. generate app key

```bash
php artisan key:generate
```

5. run migrations

```bash
php artisan migrate
```

### Fake data

Seed fake data

```bash
php artisan db:seed
```

Drop all db, migrate all and seed fake data

```bash
php artisan migrate:fresh --seed
```

## Formatting

Run `./vendor/bin/pint` to format files

This can be automated
by [setting pint as default formatter on save](https://devinthewild.com/article/laravel-pint-formatting-vscode-phpstorm#configure-vscode-to-use-pint-as-its-formatter)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
Flip is an Open source web application. 

