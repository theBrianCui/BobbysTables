<?php
session_start();

require_once __DIR__ . './config.php';
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/login.php';

function safe($string) {
    global $VULNERABLE;
    if (!$VULNERABLE['xss']) {
        return trim(htmlspecialchars($string));
    } else {
        return $string;
    }
}

?>

<script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
<h1>Bobby's Tables</h1>
<h2>The World's #1 Online Marketplace</h2>
