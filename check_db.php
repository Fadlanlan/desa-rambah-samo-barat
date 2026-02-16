<?php
$db = new PDO('sqlite:database/database.sqlite');
$result = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name='categories'");
if ($result->fetch()) {
    echo "Table 'categories' exists.\n";
    $count = $db->query("SELECT COUNT(*) FROM categories")->fetchColumn();
    echo "Count: $count\n";
}
else {
    echo "Table 'categories' NOT found.\n";
    // List all tables
    $tables = $db->query("SELECT name FROM sqlite_master WHERE type='table'")->fetchAll(PDO::FETCH_COLUMN);
    echo "Tables found: " . implode(", ", $tables) . "\n";
}
