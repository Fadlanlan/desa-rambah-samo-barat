<?php
$db = new PDO('sqlite:database/database.sqlite');
$email = 'admin@desarambahsamobarat.id';
$stmt = $db->prepare("SELECT email FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    echo "SUCCESS: User $email exists in database.\n";
}
else {
    echo "ERROR: User $email NOT FOUND in database.\n";
}
