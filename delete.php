<?php
// 必要なファイルをインクルード
include 'funcs.php';

// データベース接続
$host = 'localhost';
$dbname = 'php_kadai04';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        // GETリクエストからIDを取得
        $id = $_GET['id'];

        // 削除クエリを準備
        $stmt = $pdo->prepare("DELETE FROM php_kadai04 WHERE id = ?");
        $stmt->execute([$id]);

        echo "Delete successful!";
    }
} catch (PDOException $e) {
    die("DBConnectError: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Post</title>
</head>
<body>
<h2>Delete Post</h2>
<form action="delete.php" method="get">
    <label for="id">Post ID:</label>
    <input type="text" id="id" name="id" required><br><br>
    <input type="submit" value="Delete">
</form>
</body>
</html>
