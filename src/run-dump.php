<?php

use Ifsnop\Mysqldump\Mysqldump;

require __DIR__ . '/../vendor/autoload.php';

if (class_exists('Dotenv\Dotenv') && file_exists(__DIR__ . '/../.env')) {
    $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
}

$dumpOptions = [
    'include-tables' => array_filter(explode(',', getenv('DUMP_INCLUDE_TABLES') ?? '')),
    'exclude-tables' => array_filter(explode(',', getenv('DUMP_EXCLUDE_TABLES') ?? '')),
    'init_commands' => array_filter(explode(',', getenv('DUMP_INIT_COMMANDS') ?? '')),
    'compress' => getenv('DUMP_COMPRESS') ?? 'None',
    'default-character-set' => getenv('DUMP_DEFAULT_CHARACTER_SET') ?? 'utf8mb4',
    'net_buffer_length' => getenv('DUMP_NET_BUFFER_LENGTH'),
    // 'if-not-exists' => getenv('DUMP_CREATE_IF_NOT_EXISTS') == 'true' ? true : false,
    'no-data' => getenv('DUMP_NO_DATA') == 'true' ? true : false,
    'reset-auto-increment' => getenv('DUMP_RESET_AUTO_INCREMENT') == 'true' ? true : false,
    'add-drop-database' => getenv('DUMP_ADD_DROP_DATABASE') == 'true' ? true : false,
    'add-drop-table' => getenv('DUMP_ADD_DROP_TABLE') == 'true' ? true : false,
    'add-drop-trigger' => getenv('DUMP_ADD_DROP_TRIGGER') == 'true' ? true : false,
    'add-locks' => getenv('DUMP_ADD_LOCKS') == 'true' ? true : false,
    'complete-insert' => getenv('DUMP_COMPLETE_INSERT') == 'true' ? true : false,
    'disable-keys' => getenv('DUMP_DISABLE_KEYS') == 'true' ? true : false,
    'extended-insert' => getenv('DUMP_EXTENDED_INSERT') == 'true' ? true : false,
    'events' => getenv('DUMP_EVENTS') == 'true' ? true : false,
    'hex-blob' => getenv('DUMP_HEX_BLOB') == 'true' ? true : false,
    'insert-ignore' => getenv('DUMP_INSERT_IGNORE') == 'true' ? true : false,
    'no-autocommit' => getenv('DUMP_NO_AUTOCOMMIT') == 'true' ? true : false,
    'no-create-info' => getenv('DUMP_NO_CREATE_INFO') == 'true' ? true : false,
    'lock-tables' => getenv('DUMP_LOCK_TABLES') == 'true' ? true : false,
    'routines' => getenv('DUMP_ROUTINES') == 'true' ? true : false,
    'single-transaction' => getenv('DUMP_SINGLE_TRANSACTION') == 'true' ? true : false,
    'skip-triggers' => getenv('DUMP_SKIP_TRIGGERS') == 'true' ? true : false,
    'skip-tz-utc' => getenv('DUMP_SKIP_TZ_UTC') == 'true' ? true : false,
    'skip-comments' => getenv('DUMP_SKIP_COMMENTS') == 'true' ? true : false,
    'skip-dump-date' => getenv('DUMP_SKIP_DUMP_DATE') == 'true' ? true : false,
    'skip-definer' => getenv('DUMP_SKIP_DEFINER') == 'true' ? true : false,
    'databases' => false,
];

$pdoOptions = [
    PDO::ATTR_PERSISTENT => getenv('PDO_PERSISTENT_CONNECTION') == 'true' ? true : false,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => getenv('PDO_MYSQL_USE_BUFFERED_QUERY') == 'true' ? true : false,
];

try {
    $dbHost = getenv('DB_HOST');
    $dbPort = getenv('DB_PORT');
    $dbName = getenv('DB_NAME');

    $dump = new Mysqldump(
        "mysql:host={$dbHost};port={$dbPort};dbname={$dbName}",
        getenv('DB_USER'),
        getenv('DB_PASS'),
        $dumpOptions,
        $pdoOptions
    );

    $location = rtrim(getenv('STORAGE_LOCATION'), " \t\n\r\0\x0B\/") . '/';

    $filename = getenv('STORAGE_FILENAME');
    if (empty($filename)) {
        $filename = $dbName . '_' . date('Y_m_d_H_i_s') . '.sql';
        if ($dumpOptions['compress'] == 'Gzip') {
            $filename .= '.gz';
        } elseif ($dumpOptions['compress'] == 'Bzip2') {
            $filename .= '.bz2';
        }
    }

    $dump->start($location . $filename);

    echo PHP_EOL . "\e[32mGreen PHP-MYSQLDUMP Successful: " . $filename . PHP_EOL;
} catch (\Exception $e) {
    echo PHP_EOL . "\e[31mRed PHP-MYSQLDUMP Error: " . $e->getMessage() . PHP_EOL;
    exit(1);
}
