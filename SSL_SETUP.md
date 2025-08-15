# Настройка SSL сертификата

## Let's Encrypt (бесплатный)

### Установка Certbot

```bash
# Ubuntu/Debian
sudo apt update
sudo apt install certbot python3-certbot-apache

# CentOS/RHEL
sudo yum install certbot python3-certbot-apache
```

### Получение сертификата

```bash
sudo certbot --apache -d big-lips.qq
```

### Автоматическое обновление

```bash
# Добавить в crontab
sudo crontab -e

# Добавить строку
0 12 * * * /usr/bin/certbot renew --quiet
```

## Apache конфигурация для SSL

```apache
<VirtualHost *:80>
    ServerName big-lips.qq
    Redirect permanent / https://big-lips.qq/
</VirtualHost>

<VirtualHost *:443>
    ServerName big-lips.qq
    DocumentRoot /path/to/big-lips.qq/public
    
    SSLEngine on
    SSLCertificateFile /etc/letsencrypt/live/big-lips.qq/fullchain.pem
    SSLCertificateKeyFile /etc/letsencrypt/live/big-lips.qq/privkey.pem
    
    <Directory /path/to/big-lips.qq/public>
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/big-lips.qq_error.log
    CustomLog ${APACHE_LOG_DIR}/big-lips.qq_access.log combined
</VirtualHost>
```

## Проверка SSL

```bash
# Проверка сертификата
openssl s_client -connect big-lips.qq:443 -servername big-lips.qq

# Проверка через браузер
# Откройте https://big-lips.qq и проверьте замок в адресной строке
```

## Обновление .env

После настройки SSL обновите APP_URL в .env:

```env
APP_URL=https://big-lips.qq
```

## Проверка безопасности

Используйте инструменты для проверки:
- SSL Labs: https://www.ssllabs.com/ssltest/
- Mozilla Observatory: https://observatory.mozilla.org/
