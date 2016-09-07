<?php
require_once __DIR__ . './header.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Invalid request method: " . $_SERVER['REQUEST_METHOD'];
    http_response_code(400);
    die();
}

if (!user_logged_in()) {
    echo "You are not logged in. You cannot make a purchase!";
    http_response_code(400);
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
    <p>
        Order details:
    </p>
    <ul>
        <li>Name: <?= $_SESSION['user'] ?></li>
        <li>Address: <?= $_POST['address'] ?></li>
        <li>Credit Card: <?= $_POST['cc'] ?></li>
        <li>Product ID: <?= $_POST['productid'] ?></li>
    </ul>
    <h2>Charged to card: $<?= $product_price ?></h2>
    <p>Thank you for using Bobby's Tables!</p>
    <p><a href="./index.php">Return to the Marketplace</a></p>

    <?php

} else {
    echo 'Invalid product purchase (No product found with id ' . $ID . ')';
    http_response_code(500);
    die();
}