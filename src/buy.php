<?php

session_start();

include_once __DIR__ . '/login.php';

require_once __DIR__ . '/db.php';

if (!isset($_SESSION['user']) || !isset($_GET['id'])) {
//    print_r($_SESSION);
//    print_r($_GET);
}

?>
<script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
<h1>Craig's Lists</h1>
<h2>The more you pay, the more you lose!</h2>

<?php

$conn = get_db_connection();
$statement = $conn->prepare("SELECT * FROM products WHERE id=:id LIMIT 1");
$statement->execute(array('id' => $_GET['id']));

$result = $statement->fetch(PDO::FETCH_ASSOC);
$product_name = $result['name'];
$product_price = $result['price'];

?>

<h2>Your Shopping Cart</h2>
<p><?= $product_name ?> : PRICE: <?= $product_price ?></p>
<p></p>
<h2>Your Total: <?= $product_price ?></h2>
<p>Checkout Now</p>
<p>
<form id="checkoutform">
    <input type="text" name="cc" id="cc" placeholder="Credit Card Number"/>
    <input type="text" name="address" id="address" placeholder="Shipping Address"/>
    <button type="submit">Submit Order NOW!</button>
</form>
</p>
