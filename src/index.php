<?php

session_start();

include_once __DIR__ . '/login.php';

require_once __DIR__ . '/db.php';


$conn = get_db_connection();

if (isset($_POST['productSubmitted']) && $_SESSION['user']) {
    $statement = $conn->prepare("INSERT INTO products (owner, name, price)
                                 VALUES (:owner, :name, :price)");
    $statement->execute(array('owner' => $_SESSION['user'],
                              'name' => $_POST['productName'],
                              'price' => $_POST['productPrice']));
}

?>

<script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">

<h1>Craig's Lists</h1>
<h2>The more you pay, the more you lose!</h2>

<table>
    <tr>
        <th>
            ID
        </th>
        <th>
            Seller
        </th>
        <th>
            Product Name
        </th>
        <th>
            Price
        </th>
        <th>
            Checkout
        </th>
    </tr>
<?php

$conn = get_db_connection();
foreach ($conn->query("SELECT * FROM products") as $product) {
    ?>
    <tr>
        <td>
            <?= $product['id'] ?>
        </td>
        <td>
            <?= $product['owner'] ?>
        </td>
        <td>
            <?= $product['name'] ?>
        </td>
        <td>
            <?= $product['price'] ?>
        </td>
        <td>
            <a href="buy.php?id=<?= $product['id'] ?>">BUY NOW</a>
        </td>
    </tr>
    <?php
}

?>
</table>

<?php
if (isset($_SESSION['user'])) {
    ?>

    <h2>Add a Product</h2>
    <form method="post" action="index.php">
        <input type="hidden" name="productSubmitted" />
        <input type="text" name="productName" placeholder="Product Name" />
        $<input type="text" name="productPrice" placeholder="0" />
        <button type="submit">Submit New Listing</button>
    </form>

    <?php
}
?>