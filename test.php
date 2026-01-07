<?php
require_once "config/Database.php";
require_once "classes/user.php";

$user = new User();

$result = $user->create(
    "Test",
    "User",
    "tezst@test.com",
    "123456",
    "membre"
);

if ($result) {
    echo "✅ Insert OK";
} else {
    echo "❌ Insert failed";
}
