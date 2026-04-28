<?php
require 'app/config.php';
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

echo "general_transaction_logs:\n";
$res = $conn->query('DESCRIBE general_transaction_logs');
if ($res) while($row = $res->fetch_assoc()) { print_r($row); } else echo $conn->error;
