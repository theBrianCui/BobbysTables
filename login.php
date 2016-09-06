<?php

if ($_POST['user']) {
    $_SESSION['user'] = $_POST['user'];
}

if (isset($_GET['logout'])) {
    unset($_SESSION['user']);
}

?>
<div style="float: right">
    <?php

    if ($_SESSION['user']) {
        echo "Logged in as " . $_SESSION['user'];
        ?>
        <a href="index.php?logout">Log Out</a>
        <?php
    } else {
        ?>
        Please login to make a purchase.
        <form id="login" action="index.php" method="post">
            <input type="text" placeholder="Username" name="user"/>
        </form>
        <?php
    }

    ?>
</div>

