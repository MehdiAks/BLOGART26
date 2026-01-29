<?php
// Commentaire: Utilitaire de requêtes pour connect.
//PDO connection
function sql_connect(){
    global $DB;

    //connect BDD with PDO using SQL_HOST, SQL_USER, SQL_PWD, SQL_DB
    // Avec encodage UTF8
    $missing = [];
    if (!defined('SQL_HOST') || SQL_HOST === false || SQL_HOST === '') {
        $missing[] = 'DB_HOST';
    }
    if (!defined('SQL_USER') || SQL_USER === false || SQL_USER === '') {
        $missing[] = 'DB_USER';
    }
    if (!defined('SQL_DB') || SQL_DB === false || SQL_DB === '') {
        $missing[] = 'DB_DATABASE';
    }
    $missing = array_values(array_diff($missing, ['DB_PASSWORD']));
    if ($missing) {
        throw new RuntimeException(
            'Database connection failed. Missing/empty env value(s): ' . implode(', ', $missing) . '. ' .
            'Check your .env file or exported environment variables. (DB_PASSWORD may be left empty if your database allows it.)'
        );
    }
    try {
        if (strpos($_SERVER['HTTP_HOST'], 'scalingo') !== false) {
            $DB = new PDO('mysql:host=' . SQL_HOST . ';charset=utf8;dbname=' . SQL_DB . ';port=' . SQL_PORT, SQL_USER, SQL_PWD);
        } else {
            $DB = new PDO('mysql:host=' . SQL_HOST . ';charset=utf8;dbname=' . SQL_DB, SQL_USER, SQL_PWD);
        }
    } catch (PDOException $exception) {
        throw new RuntimeException(
            'Database connection failed. Check your .env DB_HOST/DB_USER/DB_PASSWORD/DB_DATABASE values or update your local MySQL user/password. ' .
            'If you intend to use a blank password, set DB_PASSWORD explicitly to an empty value in .env.',
            0,
            $exception
        );
    }

}
