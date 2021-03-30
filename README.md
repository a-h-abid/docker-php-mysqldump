# Docker PHP-MySQLdump

Dockerization of PHP MySQLdump library [ifsnop/mysqldump-php](https://github.com/ifsnop/mysqldump-php).

## Usage

First download the image.

```
docker pull ahabid/php-mysqldump:1.0.0
```

Create an env file (See environments section).

Run the image using `docker run`.

```
docker run --rm -it \
    --env-file=/path/to/env-file.env \
    ahabid/php-mysqldump:1.0.0
```


## Environments

