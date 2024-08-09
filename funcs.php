<?php
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

try {
    $pdo = new PDO('mysql:dbname=your_database_name;charset=utf8;host=your_database_host', 'your_database_user', 'your_database_password');
} catch (PDOException $e) {
    exit('DBConnectError:' . $e->getMessage());
}
