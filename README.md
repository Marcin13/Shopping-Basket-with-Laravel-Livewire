# Shopping Basket with Laravel Livewire
Finished and working project inspired by  [shopping-basket-laravel-livewire](https://github.com/ssd-tutorials/shopping-basket-laravel-livewire)

## This project use
- [Tailwind CSS](https://tailwindcss.com/)
- [Laravel 7.30.4](https://laravel.com/)
- [Livewire 2.x](https://laravel-livewire.com/)
## Installation

For this project we are going to use sqlite database, but feel free to use your preferred database system.

```bash
git clone https://github.com/Marcin13/Shopping-Basket-with-Laravel-Livewire.git

cd shopping-basket-laravel-livewire

composer install

cp .env.example .env
php artisan key:generate

touch database/database.sqlite
php artisan migrate --seed

npm install
npm run dev
composer require livewire/livewire
```

You can now open your project in the browser and run
