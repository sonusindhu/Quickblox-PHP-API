<?php
include 'quickblox.php';
$tokenAuth = quickAuth();
$quickGetUsers = quickGetUsers($tokenAuth->session->token);
print_r($quickGetUsers);
?>