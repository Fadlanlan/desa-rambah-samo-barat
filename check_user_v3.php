<?php
$db = new PDO('sqlite:database/database.sqlite');
$email = 'admin@desarambahsamobarat.id';
$stmt = $db->prepare("SELECT email FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    file_put_contents('user_verification.txt', "SUCCESS: User $email exists.");
}
else {
    $all = $db->query("SELECT email FROM users")->fetchAll(PDO::FETCH_COLUMN);
    file_put_contents('user_verification.txt', "ERROR: User $email NOT FOUND. Emails in DB: " . implode(', ', $all));
}
