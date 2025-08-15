# Настройка продакшена для Big Lips

## 1. Настройка окружения

Создайте файл `.env` на основе `.env.example` со следующими настройками:

```env
APP_NAME="Big Lips"
APP_ENV=production
APP_KEY=base64:YOUR_GENERATED_KEY
APP_DEBUG=false
APP_URL=https://big-lips.qq

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=big_lips
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120
```

## 2. Генерация ключа приложения

```bash
php artisan key:generate
```

## 3. Настройка базы данных

```bash
# Создание таблиц
php artisan migrate

# Заполнение данными (опционально)
php artisan db:seed
```

## 4. Оптимизация для продакшена

```bash
# Кэширование конфигурации
php artisan config:cache

# Кэширование маршрутов
php artisan route:cache

# Кэширование представлений
php artisan view:cache

# Очистка кэша
php artisan cache:clear
```

## 5. Настройка веб-сервера

### Apache (.htaccess уже настроен)
Убедитесь, что mod_rewrite включен.

### Nginx
```nginx
server {
    listen 80;
    server_name big-lips.qq;
    root /path/to/big-lips.qq/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

## 6. Настройка SSL

Установите SSL сертификат для домена big-lips.qq

## 7. Настройка прав доступа

```bash
# Установка прав на папки
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chown -R www-data:www-data storage/
chown -R www-data:www-data bootstrap/cache/
```

## 8. Мониторинг и логи

Настройте мониторинг логов в `/storage/logs/`

## 9. Резервное копирование

Настройте автоматическое резервное копирование базы данных и файлов.

## 10. Проверка безопасности

- Убедитесь, что APP_DEBUG=false
- Проверьте права доступа к файлам
- Настройте firewall
- Регулярно обновляйте зависимости

## 11. Оптимизация производительности

```bash
# Сборка ассетов для продакшена
npm run build
```

## 12. Проверка работоспособности

После настройки проверьте:
- Главная страница загружается
- CRM доступен по /crm
- Загрузка изображений работает
- Форма обратной связи работает
- Sitemap доступен по /sitemap.xml
