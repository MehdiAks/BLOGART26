<?php
//PDO connection
function sql_connect(){
    global $DB;

    //connect BDD with PDO using SQL_HOST, SQL_USER, SQL_PWD, SQL_DB
    // Avec encodage UTF8
    try {
        if (strpos($_SERVER['HTTP_HOST'], 'scalingo') !== false) {
            $DB = new PDO('mysql:host=' . SQL_HOST . ';charset=utf8;dbname=' . SQL_DB . ';port=' . SQL_PORT, SQL_USER, SQL_PWD);
        } else {
            $DB = new PDO('mysql:host=' . SQL_HOST . ';charset=utf8;dbname=' . SQL_DB, SQL_USER, SQL_PWD);
        }
    } catch (PDOException $exception) {
        throw new RuntimeException(
            'Database connection failed. Check your .env DB_HOST/DB_USER/DB_PASSWORD/DB_DATABASE values or update your local MySQL user/password.',
            0,
            $exception
        );
    }

}
