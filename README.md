# Интернет-магазин на Laravel

## Установка

Переименуйте файл `.env.example` в `.env` и исправьте в нем следующие строки:

- Данные для подключения к базе данных
- Ключи для Stripe (`STRIPE_KEY` и `STRIPE_SECRET`)
- Ключи для Algolia и ID приложения (`ALGOLIA_KEY`, `ALGOLIA_SECRET` и `ALGOLIA_APP_ID`)
- Пароль администратора на сайте (`SITE_ADMIN_PASSWORD`)
- URL приложения
- Данные для отправки email

Затем выполните
следующие команды:

``` bash
# Установка зависимостей
composer install

# Генерация ключа
php artisan key:generate

# Команда для запуска миграций и сидеров
php artisan ecommerce:install

# Установка JS зависимостей
npm install

# Компиляция CSS и JS
npm run dev

# Запуск приложения
php artisan serve
```

## Использование

Теперь по адресу `http://localhost:8000` (если запускаете локально) должна отображаться главная страница сайта

Чтобы попасть в Панель управления, перейдите по адресу `http://localhost:8000/admin`.
Данные для входа:

- `admin@admin.com/пароль из файла .env`
- `adminweb@adminweb.com/password`
