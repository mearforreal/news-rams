Этот проект написан на Laravel + MySQL.

Для запуска Laravel, необходимо настроить базу данных в файле .env,
после этого, запустить Seeder, чтобы заполнить таблицу Роли, пользователи, категории новостей

### php artisan db: seed --class = CategorySeeder

### php artisan db: seed --class = RoleSeeder

### php artisan db: seed --class = UserSeeder

Затем используйте

### php artisan serve
