FROM php:7.4.16-cli

LABEL maintainer="Ahmedul Haque Abid <a_h_abid@hotmail.com>"

RUN echo "-- Install APT Dependencies --" \
        && apt update \
        && apt install -V -y \
            curl \
            zip \
            unzip \
    && echo "-- Install PHP Extensions --" \
        && curl -L -o /usr/local/bin/install-php-extensions https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions \
        && chmod a+x /usr/local/bin/install-php-extensions \
        && sync \
        && install-php-extensions \
            pcntl \
            pdo_mysql \
            zip \
            bz2 \
            @composer-2.0.11

COPY --chown=root:root ./docker/php.ini /usr/local/etc/php/conf.d/app-php.ini

# PHP INI Settings for production by default
ENV PHP_INI_OUTPUT_BUFFERING=4096 \
    PHP_INI_MAX_EXECUTION_TIME=60 \
    PHP_INI_MAX_INPUT_TIME=60 \
    PHP_INI_MEMORY_LIMIT="256M" \
    PHP_INI_DISPLAY_ERRORS="Off" \
    PHP_INI_DISPLAY_STARTUP_ERRORS="Off" \
    PHP_INI_POST_MAX_SIZE="2M" \
    PHP_INI_FILE_UPLOADS="On" \
    PHP_INI_UPLOAD_MAX_FILESIZE="2M" \
    PHP_INI_MAX_FILE_UPLOADS="2" \
    PHP_INI_ALLOW_URL_FOPEN="On" \
    PHP_INI_DATE_TIMEZONE="UTC" \
    PHP_INI_ERROR_LOG="" \
    PHP_INI_SESSION_SAVE_HANDLER="files" \
    PHP_INI_SESSION_SAVE_PATH="/tmp" \
    PHP_INI_SESSION_USE_STRICT_MODE=0 \
    PHP_INI_SESSION_USE_COOKIES=1 \
    PHP_INI_SESSION_USE_ONLY_COOKIES=1 \
    PHP_INI_SESSION_NAME="APP_SSID" \
    PHP_INI_SESSION_COOKIE_SECURE="On" \
    PHP_INI_SESSION_COOKIE_LIFETIME=0 \
    PHP_INI_SESSION_COOKIE_PATH="/" \
    PHP_INI_SESSION_COOKIE_DOMAIN="" \
    PHP_INI_SESSION_COOKIE_HTTPONLY="On" \
    PHP_INI_SESSION_COOKIE_SAMESITE="" \
    PHP_INI_SESSION_UPLOAD_PROGRESS_NAME="APP_UPLOAD_PROGRESS" \
    PHP_INI_OPCACHE_ENABLE=1 \
    PHP_INI_OPCACHE_ENABLE_CLI=0 \
    PHP_INI_OPCACHE_MEMORY_CONSUMPTION=256 \
    PHP_INI_OPCACHE_INTERNED_STRINGS_BUFFER=16 \
    PHP_INI_OPCACHE_MAX_ACCELERATED_FILES=100000 \
    PHP_INI_OPCACHE_MAX_WASTED_PERCENTAGE=25 \
    PHP_INI_OPCACHE_USE_CWD=0 \
    PHP_INI_OPCACHE_VALIDATE_TIMESTAMPS=0 \
    PHP_INI_OPCACHE_REVALIDATE_FREQ=0 \
    PHP_INI_OPCACHE_SAVE_COMMENTS=0 \
    PHP_INI_OPCACHE_ENABLE_FILE_OVERRIDE=1 \
    PHP_INI_OPCACHE_MAX_FILE_SIZE=0 \
    PHP_INI_OPCACHE_FAST_SHUTDOWN=1

# App related ENVs
ENV DB_HOST="localhost" \
    DB_PORT=3306 \
    DB_USER="root" \
    DB_PASS="secret" \
    DB_NAME="dbname" \
    STORAGE_LOCATION="/var/www/html/storage/" \
    STORAGE_FILENAME="filename.sql" \
    DUMP_INCLUDE_TABLES="" \
    DUMP_EXCLUDE_TABLES="" \
    DUMP_INIT_COMMANDS="" \
    DUMP_COMPRESS="None" \
    DUMP_DEFAULT_CHARACTER_SET="utf8mb4" \
    DUMP_NET_BUFFER_LENGTH=1000000 \
    DUMP_CREATE_IF_NOT_EXISTS=true \
    DUMP_NO_DATA=false \
    DUMP_RESET_AUTO_INCREMENT=false \
    DUMP_ADD_DROP_DATABASE=false \
    DUMP_ADD_DROP_TABLE=true \
    DUMP_ADD_DROP_TRIGGER=true \
    DUMP_ADD_LOCKS=false \
    DUMP_COMPLETE_INSERT=false \
    DUMP_DISABLE_KEYS=false \
    DUMP_EXTENDED_INSERT=false \
    DUMP_EVENTS=false \
    DUMP_HEX_BLOB=false \
    DUMP_INSERT_IGNORE=false \
    DUMP_NO_AUTOCOMMIT=false \
    DUMP_NO_CREATE_INFO=false \
    DUMP_LOCK_TABLES=false \
    DUMP_ROUTINES=false \
    DUMP_SINGLE_TRANSACTION=false \
    DUMP_SKIP_TRIGGERS=false \
    DUMP_SKIP_TZ_UTC=false \
    DUMP_SKIP_COMMENTS=false \
    DUMP_SKIP_DUMP_DATE=false \
    DUMP_SKIP_DEFINER=false \
    PDO_PERSISTENT_CONNECTION=false \
    PDO_MYSQL_USE_BUFFERED_QUERY=true

WORKDIR /var/www/html

COPY ./composer.* /var/www/html/

RUN composer install --no-interaction --no-scripts --no-autoloader --prefer-dist --no-dev

COPY ./src /var/www/html/src/

RUN composer dump-autoload \
    && mkdir storage/ \
    && chmod -R ugo+sw storage/

CMD ["php", "src/run-dump.php"]
