<?php
if (strpos($_SERVER['HTTP_HOST'], 'scalingo') !== false) {
    define('SQL_HOST', getenv('SCALINGO_DB_HOST'));
    define('SQL_USER', getenv('SCALINGO_DB_USER'));
    define('SQL_PWD', getenv('SCALINGO_DB_PASSWORD'));
    define('SQL_DB', getenv('SCALINGO_DB_DATABASE'));
    define('SQL_PORT', getenv('SCALINGO_DB_PORT'));
} else {
    define('SQL_HOST', getenv('DB_HOST'));
    define('SQL_USER', getenv('DB_USER'));
    $dbPassword = getenv('DB_PASSWORD');
    if ($dbPassword === false || $dbPassword === '') {
        $dbPassword = getenv('MYSQL_ROOT_PASSWORD');
    }
    define('SQL_PWD', $dbPassword);
    define('SQL_DB', getenv('DB_DATABASE'));
}
