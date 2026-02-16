<?php

use App\Models\Category;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$categories = Category::all();

$output = "";
if ($categories->isEmpty()) {
    $output = "No categories found.\n";
}
else {
    foreach ($categories as $category) {
        $output .= "ID: {$category->id} - Name: {$category->name}\n";
    }
}
file_put_contents('categories.txt', $output);
