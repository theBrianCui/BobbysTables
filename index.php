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

<style>
    table a:link {
        color: #666;
        font-weight: bold;
        text-decoration:none;
    }
    table a:visited {
        color: #999999;
        font-weight:bold;
        text-decoration:none;
    }
    table a:active,
    table a:hover {
        color: #bd5a35;
        text-decoration:underline;
    }
    table {
        font-family:Arial, Helvetica, sans-serif;
        color:#666;
        font-size:16px;
        text-shadow: 1px 1px 0px #fff;
        background:#eaebec;
        margin:20px;
        border:#ccc 1px solid;

        -moz-border-radius:3px;
        -webkit-border-radius:3px;
        border-radius:3px;

        -moz-box-shadow: 0 1px 2px #d1d1d1;
        -webkit-box-shadow: 0 1px 2px #d1d1d1;
        box-shadow: 0 1px 2px #d1d1d1;
    }
    table th {
        padding:21px 25px 22px 25px;
        border-top:1px solid #fafafa;
        border-bottom:1px solid #e0e0e0;

        background: #ededed;
        background: -webkit-gradient(linear, left top, left bottom, from(#ededed), to(#ebebeb));
        background: -moz-linear-gradient(top,  #ededed,  #ebebeb);
    }
    table th:first-child {
        text-align: left;
        padding-left:20px;
    }
    table tr:first-child th:first-child {
        -moz-border-radius-topleft:3px;
        -webkit-border-top-left-radius:3px;
        border-top-left-radius:3px;
    }
    table tr:first-child th:last-child {
        -moz-border-radius-topright:3px;
        -webkit-border-top-right-radius:3px;
        border-top-right-radius:3px;
    }
    table tr {
        text-align: center;
        padding-left:20px;
    }
    table td:first-child {
        text-align: left;
        padding-left:20px;
        border-left: 0;
    }
    table td {
        padding:18px;
        border-top: 1px solid #ffffff;
        border-bottom:1px solid #e0e0e0;
        border-left: 1px solid #e0e0e0;

        background: #fafafa;
        background: -webkit-gradient(linear, left top, left bottom, from(#fbfbfb), to(#fafafa));
        background: -moz-linear-gradient(top,  #fbfbfb,  #fafafa);
    }
    table tr.even td {
        background: #f6f6f6;
        background: -webkit-gradient(linear, left top, left bottom, from(#f8f8f8), to(#f6f6f6));
        background: -moz-linear-gradient(top,  #f8f8f8,  #f6f6f6);
    }
    table tr:last-child td {
        border-bottom:0;
    }
    table tr:last-child td:first-child {
        -moz-border-radius-bottomleft:3px;
        -webkit-border-bottom-left-radius:3px;
        border-bottom-left-radius:3px;
    }
    table tr:last-child td:last-child {
        -moz-border-radius-bottomright:3px;
        -webkit-border-bottom-right-radius:3px;
        border-bottom-right-radius:3px;
    }
    table tr:hover td {
        background: #f2f2f2;
        background: -webkit-gradient(linear, left top, left bottom, from(#f2f2f2), to(#f0f0f0));
        background: -moz-linear-gradient(top,  #f2f2f2,  #f0f0f0);
    }
</style>

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