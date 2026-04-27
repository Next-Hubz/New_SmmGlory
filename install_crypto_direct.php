<?php
$conn = new mysqli('localhost', 'root', '', 'smmtest');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if crypto_direct exists
$result = $conn->query("SELECT id FROM payments WHERE type = 'crypto_direct'");
if ($result->num_rows == 0) {
    // Insert
    $params = json_encode([
        'option' => [
            'merchant_id' => '',
            'payment_key' => '',
            'tnx_fee' => '0'
        ],
        'take_fee_from_user' => 0
    ]);
    
    $sql = "INSERT INTO payments (type, name, sort, min, max, new_users, status, params) 
            VALUES ('crypto_direct', 'Crypto Checkout (BTC, ETH, LTC, USDT, BNB, SOL)', 10, 5, 1000, 1, 1, '$params')";
    if ($conn->query($sql) === TRUE) {
        echo "Inserted crypto_direct payment method.\n";
    } else {
        echo "Error inserting: " . $conn->error . "\n";
    }
} else {
    echo "crypto_direct already exists.\n";
}

// Create a table for crypto transactions
$sql = "CREATE TABLE IF NOT EXISTS `general_crypto_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_log_id` int(11) NOT NULL,
  `uuid` varchar(100) NOT NULL,
  `wallet_address` varchar(255) NOT NULL,
  `amount` decimal(15,4) NOT NULL,
  `crypto_amount` decimal(20,8) NOT NULL,
  `crypto_currency` varchar(50) NOT NULL,
  `network` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
if ($conn->query($sql) === TRUE) {
    echo "Created general_crypto_transactions table.\n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}

$conn->close();
?>