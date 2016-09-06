<?php
require_once __DIR__ . './header.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Invalid request method: " . $_SERVER['REQUEST_METHOD'];
    die();
}

$ID = $_POST['productid'];

$conn = get_db_connection();
$statement = $conn->prepare("SELECT * FROM products WHERE id=:id LIMIT 1");
$statement->execute(array('id' => $ID));

$result = $statement->fetch(PDO::FETCH_ASSOC);
if (isset($result['name'])) {
    $product_name = $result['name'];
    $product_price = $result['price'];

    $statement = $conn->prepare("DELETE FROM products WHERE id=:id");
    $statement->execute(array('id' => $ID));

    ?>

    <h2>Checkout Successful</h2>
    <p><?= $product_name ?> : PRICE: <?= $product_price ?></p>
    <p></p>
    <h2>Charged to card (<?= $_POST['cc'] ?>): <?= $product_price ?></h2>
    <p>Thank you for using Craig's Lists!</p>

    <?php

} else {
    echo 'Invalid product purchase (No product found with id ' . $ID . ')';
    die();
}