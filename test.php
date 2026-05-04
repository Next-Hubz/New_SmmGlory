<?php
$db = new mysqli('localhost', 'root', '', 'smartpanel_design_modified');
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
$result = $db->query('SELECT email, password FROM general_users LIMIT 1');
print_r($result->fetch_assoc());
