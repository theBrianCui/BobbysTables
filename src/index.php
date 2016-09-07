<?php
require_once __DIR__ . './header.php';

$conn = get_db_connection();
if (isset($_POST['productSubmitted']) && $_SESSION['user']) {
    $statement = $conn->prepare("INSERT INTO products (owner, name, price)
                                 VALUES (:owner, :name, :price)");
    $statement->execute(array('owner' => $_SESSION['user'],
                              'name' => $_POST['productName'],
                              'price' => $_POST['productPrice']));
}

?>

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
        <?php
        if (user_logged_in()) {
        ?>
        <th>
            Checkout
        </th>
        <?php } ?>
    </tr>
<?php

$conn = get_db_connection();
foreach ($conn->query("SELECT * FROM products") as $product) {
    ?>
    <tr>
        <td>
            <?= safe($product['id']) ?>
        </td>
        <td>
            <?= safe($product['owner']) ?>
        </td>
        <td>
            <?= safe($product['name']) ?>
        </td>
        <td>
            <?= safe($product['price']) ?>
        </td>
        <?php
        if (user_logged_in()) {
        ?>
            <td>
                <a href="buy.php?id=<?= safe($product['id']) ?>">BUY NOW</a>
            </td>
        <?php } ?>
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

require_once __DIR__ . './footer.php';
?>