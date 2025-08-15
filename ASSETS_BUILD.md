# Сборка ассетов для продакшена

## Установка зависимостей

```bash
npm install
```

## Сборка для продакшена

```bash
npm run build
```

Это создаст оптимизированные файлы в папке `public/build/`

## Проверка сборки

После сборки проверьте, что файлы созданы:
- `public/build/assets/` - CSS и JS файлы
- `public/build/manifest.json` - манифест с хешами файлов

## Автоматическая сборка при деплое

Добавьте в `deploy.sh`:

```bash
echo "🎨 Сборка ассетов..."
npm run build
```

## Оптимизация изображений

Для оптимизации изображений используйте:

```bash
# Установка imagemin (опционально)
npm install -g imagemin-cli

# Оптимизация изображений
imagemin public/img/* --out-dir=public/img/optimized/
```

## Кэширование ассетов

В `.htaccess` уже настроено кэширование статических файлов на 1 год.

## Проверка производительности

Используйте инструменты для проверки:
- Google PageSpeed Insights
- GTmetrix
- WebPageTest
