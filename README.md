# Laratest Fullstack
A simple CRUD application with FAQ page and authentication.
http://faq-crud.herokuapp.com

## Tech Stack
- Laravel
- Vue.js
- Docker (laradock) - not included in the repo
- Nginx
- PostgreSQL
- Laravel Passport


### Dependencies
-  Laravel Vue Pagination (https://github.com/gilbitron/laravel-vue-pagination)

## How to use

```bash
npm install
npm run dev
php artisan migrate
php artisan passport:install
php artisan passport:keys
php artisan serve
```
Copy .env.example to .env file and set the needed variables.
Also don't forget to add PASSPORT KEYS to your .env file
https://laravel.com/docs/6.x/passport

```
PASSPORT_PRIVATE_KEY="-----BEGIN RSA PRIVATE KEY-----
<private key here>
-----END RSA PRIVATE KEY-----"

PASSPORT_PUBLIC_KEY="-----BEGIN PUBLIC KEY-----
<public key here>
-----END PUBLIC KEY-----"
```


