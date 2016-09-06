<?php
require_once __DIR__ . '/config.php';

function &get_db_connection() {
    static $conn = NULL;
    global $MYSQL_HOST, $MYSQL_DB_NAME, $MYSQL_USER, $MYSQL_PASSWORD;

    if (is_null($conn)) {
        try {
            $conn = new PDO("mysql:host=$MYSQL_HOST;dbname=$MYSQL_DB_NAME",
                $MYSQL_USER, $MYSQL_PASSWORD);
            return $conn;
        } catch (PDOException $e) {
            error_log($e->getMessage(), 0);
            return NULL;
        }
    }

    return $conn;
}

$conn = get_db_connection();
?>