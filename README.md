# Docker PHP-MySQLdump

Dockerization of PHP MySQLdump library [ifsnop/mysqldump-php](https://github.com/ifsnop/mysqldump-php).

## Usage

First download the image.

```
docker pull ahabid/php-mysqldump:1.0.1
```

Create an env file (See (environments)[#environments] section).

Run the image using `docker run`.

```
docker run --rm -it \
    --env-file=/path/to/env-file.env \
    -v /host/path/to/store:/var/www/html/storage
    ahabid/php-mysqldump:1.0.1
```

**IMPORTANT**: Make sure your host storage path is writable.

## Environments

### PHP-INI

| Name | Description |
| - | - |
| PHP_INI_OUTPUT_BUFFERING | Output buffering value. <br> *Default Value:* `4096` |
| PHP_INI_ZLIB_OUTPUT_COMPRESSION | Toggle ZLIB Output Compression value.  <br> *Default Value:* `Off` |
| PHP_INI_MAX_EXECUTION_TIME | Max time PHP will be executed. <br> *Default Value:* `60` |
| PHP_INI_MAX_INPUT_TIME | Max time PHP will wait for input. <br> *Default Value:* `60` |
| PHP_INI_MEMORY_LIMIT | Max memory limit used by PHP process. <br> *Default Value:* `256M` |
| PHP_INI_DISPLAY_ERRORS | Toggle display errors. <br> *Default Value:* `Off` |
| PHP_INI_DISPLAY_STARTUP_ERRORS | Toggle display errors on startup. <br> *Default Value:* `Off` |
| PHP_INI_ERROR_LOG | PHP Error log path <br> *Default Value:* (blank) |
| PHP_INI_POST_MAX_SIZE | Max data size available for POST requests. <br> *Default Value:* `2M` |
| PHP_INI_FILE_UPLOADS | Toggle enable file uploading. <br> *Default Value:* `On` |
| PHP_INI_UPLOAD_MAX_FILESIZE | Max upload file size. <br> *Default Value:* `2M` |
| PHP_INI_MAX_FILE_UPLOADS | Max number of files can be uploaded during a request. <br> *Default Value:* `2` |
| PHP_INI_ALLOW_URL_FOPEN | Toogle allow URL to use by fopen function. <br> *Default Value:* `On` |
| PHP_INI_DATE_TIMEZONE | Timezone for PHP Datetime. <br> *Default Value:* `UTC` |
| PHP_INI_SESSION_SAVE_HANDLER | Session save handler name. <br> *Default Value:* `files` |
| PHP_INI_SESSION_SAVE_PATH | Session save path. <br> *Default Value:* `/tmp` |
| PHP_INI_SESSION_USE_STRICT_MODE | Toggle session strict mode. <br> *Default Value:* `0` |
| PHP_INI_SESSION_USE_COOKIES | Toggle use of session cookies. <br> *Default Value:* `1` |
| PHP_INI_SESSION_USE_ONLY_COOKIES | Toggle use of only session cookies. <br> *Default Value:* `1` |
| PHP_INI_SESSION_NAME | Name of session. <br> *Default Value:* `APP_SSID` |
| PHP_INI_SESSION_COOKIE_SECURE | Cookies available for HTTPS only. <br> *Default Value:* `On` |
| PHP_INI_SESSION_COOKIE_LIFETIME | Cookies lifetime in seconds. 0 for until browser is closed. <br> *Default Value:* `0` |
| PHP_INI_SESSION_COOKIE_PATH | Cookies usage URI path. <br> *Default Value:* `/` |
| PHP_INI_SESSION_COOKIE_DOMAIN | Cookies usage domain. <br> *Default Value:* `` |
| PHP_INI_SESSION_COOKIE_HTTPONLY | Cookies to be used by HTTP only. <br> *Default Value:* `On` |
| PHP_INI_SESSION_COOKIE_SAMESITE | [Read here](https://www.php.net/manual/en/session.configuration.php#ini.session.cookie-samesite). <br> *Default Value:* `` |
| PHP_INI_SESSION_UPLOAD_PROGRESS_NAME | Name of session for file upload progress. <br> *Default Value:* `APP_UPLOAD_PROGRESS` |
| PHP_INI_OPCACHE_ENABLE | Toggle enable opcache for WEB. <br> *Default Value:* `1` |
| PHP_INI_OPCACHE_ENABLE_CLI | Toggle enable opcache for CLI. <br> *Default Value:* `0` |
| PHP_INI_OPCACHE_MEMORY_CONSUMPTION | Opcache memory consumption in MB. <br> *Default Value:* `256` |
| PHP_INI_OPCACHE_INTERNED_STRINGS_BUFFER | Opcache memory used to store interned strings, in megabytes. <br> *Default Value:* `16` |
| PHP_INI_OPCACHE_MAX_ACCELERATED_FILES | Max no. of files to opcache. <br> *Default Value:* `100000` |
| PHP_INI_OPCACHE_MAX_WASTED_PERCENTAGE | Max wasted percentage. <br> *Default Value:* `25` |
| PHP_INI_OPCACHE_USE_CWD | Appends current working directory to script key if enabled. <br> *Default Value:* `0` |
| PHP_INI_OPCACHE_VALIDATE_TIMESTAMPS | Validate file's timestamps for modification after given no. of seconds. <br> *Default Value:* `0` |
| PHP_INI_OPCACHE_REVALIDATE_FREQ | Re-validate frequency. <br> *Default Value:* `0` |
| PHP_INI_OPCACHE_SAVE_COMMENTS | Save comments for opcached files. <br> *Default Value:* `0` |
| PHP_INI_OPCACHE_ENABLE_FILE_OVERRIDE | Toggle enable file override. <br> *Default Value:* `1` |
| PHP_INI_OPCACHE_MAX_FILE_SIZE | Max size of file to be cacheable. <br> *Default Value:* `0` |
| PHP_INI_OPCACHE_FAST_SHUTDOWN | Opcache Fast Shutdown. <br> *Default Value:* `1` |

### MySQL Dump

| Name | Description |
| - | - |
| DB_HOST | Database host name <br> *Default Value:* `localhost` |
| DB_PORT | Database port number <br> *Default Value:* `3306` |
| DB_USER | Database user name <br> *Default Value:* `root` |
| DB_PASS | Database user password <br> *Default Value:* `secret` |
| DB_NAME | Database name <br> *Default Value:* `dbname` |
| STORAGE_LOCATION | Folder location to store the dump files. <br> *Default Value:* `/var/www/html/storage/` |
| STORAGE_FILENAME | Filename of the stored file. If set to blank, will auto generate name using format `dbname_Y_m_d_H:i:s.sql`. <br> *Default Value:* `filename.sql` |
| DUMP_INCLUDE_TABLES | Include tables in the dump, separated by comma. <br> *Default Value:* `` |
| DUMP_EXCLUDE_TABLES | Exclude tables from the dump, separated by comma. <br> *Default Value:* `` |
| DUMP_INIT_COMMANDS | Run commands at startup, separated by comma <br> *Default Value:* `` |
| DUMP_COMPRESS | Compress the dump. Options are `None`, `Gzip`, `Bzip2`, `Gzipstream`. <br> *Default Value:* `None` |
| DUMP_DEFAULT_CHARACTER_SET | Default character set. Options are `utf8`, `utf8mb4`. <br> *Default Value:* `utf8mb4` |
| DUMP_NET_BUFFER_LENGTH | Set net buffer length. <br> *Default Value:* `1000000` |
| DUMP_NO_DATA | Create dump with no row data if set to `true`. Useful when need to create dump with structures only. <br> *Default Value:* `false` |
| DUMP_CREATE_IF_NOT_EXISTS | **Not Working** Add `CREATE TABLE IF NOT EXISTS` command. <br> *Default Value:* `true` |
| DUMP_RESET_AUTO_INCREMENT | Reset auto increment value to `1`. <br> *Default Value:* `false` |
| DUMP_ADD_DROP_DATABASE | Add the `DROP DATABASE` command. <br> *Default Value:* `false` |
| DUMP_ADD_DROP_TABLE | Add the `DROP TABLE` command. <br> *Default Value:* `true` |
| DUMP_ADD_DROP_TRIGGER | Add the `DROP TRIGGER` command. <br> *Default Value:* `true` |
| DUMP_ADD_LOCKS | Add the `LOCK/UNLOCK TABLE` command. <br> *Default Value:* `false` |
| DUMP_COMPLETE_INSERT | Add inserts with full column names. <br> *Default Value:* `false` |
| DUMP_DISABLE_KEYS | Disable Keys <br> *Default Value:* `false` |
| DUMP_EXTENDED_INSERT | Add extended inserts for faster multiple data inserts on import. <br> *Default Value:* `false` |
| DUMP_EVENTS | Dump Events. <br> *Default Value:* `false` |
| DUMP_HEX_BLOB | Dump Hex Blob. <br> *Default Value:* `false` |
| DUMP_INSERT_IGNORE | Add Insert with `IGNORE` command. <br> *Default Value:* `false` |
| DUMP_NO_AUTOCOMMIT | No Auto Commit. <br> *Default Value:* `false` |
| DUMP_NO_CREATE_INFO | Do not add `CREATE TABLE` command. <br> *Default Value:* `false` |
| DUMP_LOCK_TABLES | Add Lock/Unlock Tables <br> *Default Value:* `false` |
| DUMP_ROUTINES | Dump Routines. <br> *Default Value:* `false` |
| DUMP_SINGLE_TRANSACTION | Use Single Transaction. <br> *Default Value:* `false` |
| DUMP_SKIP_TRIGGERS | Skip Triggers. <br> *Default Value:* `false` |
| DUMP_SKIP_TZ_UTC | Skip TZ UTC ??. <br> *Default Value:* `false` |
| DUMP_SKIP_COMMENTS | Skip Comments. <br> *Default Value:* `false` |
| DUMP_SKIP_DUMP_DATE | Skip Dump Table. <br> *Default Value:* `false` |
| DUMP_SKIP_DEFINER | Skip Definer. <br> *Default Value:* `false` |
| PDO_PERSISTENT_CONNECTION | Use PDO Persistent Connection. <br> *Default Value:* `false` |
| PDO_MYSQL_USE_BUFFERED_QUERY | Use PDO MySQL Buffered Query. <br> *Default Value:* `true` |
