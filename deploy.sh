#!/bin/bash

echo "🚀 Настройка продакшена для Big Lips..."

# Проверка наличия .env файла
if [ ! -f .env ]; then
    echo "❌ Файл .env не найден. Создайте его на основе .env.example"
    exit 1
fi

echo "📦 Установка зависимостей..."
composer install --optimize-autoloader --no-dev

echo "🎨 Установка и сборка ассетов..."
npm install
npm run build

echo "🔑 Генерация ключа приложения..."
php artisan key:generate

echo "🗄️ Запуск миграций..."
php artisan migrate --force

echo "⚡ Оптимизация для продакшена..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "🧹 Очистка кэша..."
php artisan cache:clear

echo "📁 Настройка прав доступа..."
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chown -R www-data:www-data storage/ 2>/dev/null || echo "⚠️ Не удалось изменить владельца storage/"
chown -R www-data:www-data bootstrap/cache/ 2>/dev/null || echo "⚠️ Не удалось изменить владельца bootstrap/cache/"

echo "🔒 Проверка безопасности..."
if grep -q "APP_DEBUG=true" .env; then
    echo "⚠️ ВНИМАНИЕ: APP_DEBUG установлен в true. Рекомендуется установить false для продакшена"
fi

echo "✅ Настройка продакшена завершена!"
echo ""
echo "📋 Следующие шаги:"
echo "1. Настройте SSL сертификат"
echo "2. Настройте резервное копирование"
echo "3. Проверьте работоспособность сайта"
echo "4. Настройте мониторинг"
