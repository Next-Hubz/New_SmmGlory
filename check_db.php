<?php
$mysqli = new mysqli('localhost', 'root', '', 'smmtest');
if ($mysqli->connect_error) {
    die('Connect Error: ' . $mysqli->connect_error);
}
$res = $mysqli->query("SHOW COLUMNS FROM general_users LIKE 'ref_uid'");
print_r($res->fetch_all());
