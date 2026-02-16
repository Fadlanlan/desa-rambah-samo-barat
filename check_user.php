<?php
$db = new PDO('sqlite:database/database.sqlite');
$email = 'admin@desarambahsamobarat.id';
$stmt = $db->prepare("SELECT email, password FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    echo "User found: " . $user['email'] . "\n";
// echo "Password hash: " . $user['password'] . "\n";
}
else {
    echo "User NOT found: $email\n";
    $count = $db->query("SELECT COUNT(*) FROM users")->fetchColumn();
    echo "Total users in table: $count\n";

    $allUsers = $db->query("SELECT email FROM users")->fetchAll(PDO::FETCH_COLUMN);
    echo "Emails in table: " . implode(", ", $allUsers) . "\n";
}
