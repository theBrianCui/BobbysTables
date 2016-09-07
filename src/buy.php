<?php
require_once __DIR__ . '/./header.php';

if (!user_logged_in()) {
    echo "You are not logged in. You cannot make a purchase!";
    http_response_code(400);
} else {

    $conn = get_db_connection();
    $statement = $conn->prepare("SELECT * FROM products WHERE id=:id LIMIT 1");
    $statement->execute(array('id' => $_GET['id']));

    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $product_name = $result['name'];
    $product_price = $result['price'];

    ?>

    <h2>Your Shopping Cart</h2>
    <p><?= safe($product_name) ?>: PRICE: <?= safe($product_price) ?></p>
    <p></p>
    <h2>Your Total: <?= safe($product_price) ?></h2>
    <p>Checkout Now</p>
    <form id="checkoutform" method="POST" action="checkout.php">
        <input type="text" name="cc" id="cc" placeholder="Credit Card Number"/>
        <input type="text" name="address" id="address" placeholder="Shipping Address"/>
        <input type="text" name="productid" id="productid" value="<?= safe($_GET['id']) ?>" style="display: none"/>
        <button type="submit">Submit Order NOW!</button>
    </form>

    <?php
}
require_once __DIR__ . '/./footer.php';
?>