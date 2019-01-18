# task-product-catalog
test task laravel mysql catalog of products hh 2212974

настроить и поднять MySQL, создать БД 'task-product-catalog'
настроить конфиг .env
php artisan migrate

добавить запись в Cron
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
