# Laravel Vue Starter

Jak dodać Vue w aplikacji Laravel.

## Uruchom

Pobierz repozytorium rozpakuj i uruchom.

```sh
composer update
composer dump-autoload -o

npm install
npm run build

php artisan storage:link
php artisan migrate:fresh --seed
php artisan serve --host=localhost --port=8000
```

## Dev

Uwierzytelnianie wieloskładnikowe (F2A), panel Klienta
i Administratora na oddzielnych modelach z oddzielnymi
formularzeami logowania (multi guards auth).
Zaimplementowany formularz kontaktowy i zapisywanie
do newslettera przez formularz na stronie z
potwierdzeniem subskrypcji przez wiadomość e-mail.

### Zainstalowane pakiety

```sh
composer create-project laravel/laravel:^12 vue

# Php
"laravel/framework": "^12.0",
"spatie/laravel-permission": "^6.19"
"intervention/image": "^3.11",
"atomjoy/proton": "^4.1",

# Js
npm install
npm install vue@latest
npm install --save-dev @vitejs/plugin-vue

npm install axios
npm install pinia
npm install vue-i18n@11
npm install vue-router@4
npm install @googlemaps/js-api-loader
```

### Baza Mysql

```sql
-- Tabele
CREATE DATABASE IF NOT EXISTS laravel CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
CREATE DATABASE IF NOT EXISTS laravel_testing CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Nie wymagane do testu
GRANT ALL PRIVILEGES ON *.* TO root@localhost IDENTIFIED BY 'toor' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON *.* TO root@127.0.0.1 IDENTIFIED BY 'toor' WITH GRANT OPTION;
```

### Produkcja

```sh
php artisan optimize:clear

php artisan optimize
```

### Testy

```sh
php artisan migrate:fresh --seed

php artisan migrate:fresh --seed --env=testing

php artisan migrate:fresh --seed --env=testing --seeder=TestSeeder

php artisan test --stop-on-failure

php artisan test --filter Dev --stop-on-failure

php artisan test --filter SingleTest --stop-on-failure
```
