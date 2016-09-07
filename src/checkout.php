<?php
require_once __DIR__ . './header.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Invalid request method: " . $_SERVER['REQUEST_METHOD'];
    http_response_code(400);

} else if (!user_logged_in()) {
    echo "You are not logged in. You cannot make a purchase!";
    http_response_code(400);

} else {
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
        <p><?= safe($product_name) ?>: PRICE: <?= safe($product_price) ?></p>
        <p>
            Order details:
        </p>
        <ul>
            <li>Name: <?= safe($_SESSION['user']) ?></li>
            <li>Address: <?= safe($_POST['address']) ?></li>
            <li>Credit Card: <?= safe($_POST['cc']) ?></li>
            <li>Product ID: <?= safe($_POST['productid']) ?></li>
        </ul>
        <h2>Charged to card: $<?= safe($product_price) ?></h2>
        <p>Thank you for using Bobby's Tables!</p>
        <p><a href="./index.php">Return to the Marketplace</a></p>

        <?php

    } else {
        echo 'Invalid product purchase (No product found with id ' . $ID . ')';
        http_response_code(500);
    }
}

require_once __DIR__ . './footer.php';