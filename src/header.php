<?php
$session_name = session_name();
if (isset($_COOKIE[$session_name]) and empty($_COOKIE[$session_name])) {
    // This happens when someone does "clear cookie" in Firebug; it causes session_start()
    // to trigger a warning. session_start() relies on $_COOKIE[$session_name], thus:
    unset($_COOKIE[$session_name]);
}
session_start();
session_start();

require_once __DIR__ . '/./config.php';
require_once __DIR__ . '/db.php';

function safe($string) {
    global $VULNERABLE;
    if (!$VULNERABLE['xss']) {
        return trim(htmlspecialchars($string));
    } else {
        return $string;
    }
}

?>
<html>
<head>
    <title>Bobby's Tables</title>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="appwrapper">
<h1>Bobby's Tables</h1>
<h2>The World's #1 Online Marketplace</h2>
<?php require_once __DIR__ . '/login.php'; ?>

