<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form action="register.php" method="post">
        <!-- ユーザー名の入力フィールド -->
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <!-- パスワードの入力フィールド -->
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <!-- 登録ボタン -->
        <input type="submit" value="Register">
    </form>
</body>
</html>

<?php

//3. DB接続情報を環境に応じて切り替えます
if ($_SERVER['HTTP_HOST'] === 'localhost') {
    // ローカル環境
    $host = 'localhost';
    $dbname = 'php_kadai04';
    $username = 'root';
    $password = '';
} else {
    // サーバー環境（さくらインターネット）
    $host = 'mysql57.onotoshi.sakura.ne.jp'; // さくらインターネットから提供されたホスト名
    $dbname = 'onotoshi_php_kadai04'; // データベース名
    $username = 'onotoshi'; // データベースユーザー名
    $password = 'to20131117'; // データベースパスワード
}

try {
    // データベース接続を確立
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // フォームが送信された場合の処理
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // ユーザー名とパスワードをPOSTデータから取得
        $username = $_POST['username'];
        // パスワードをハッシュ化
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // INSERTクエリを準備
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        // クエリを実行
        $stmt->execute([$username, $password]);

        // 登録成功メッセージを表示
        echo "Registration successful!";
    }
} catch (PDOException $e) {
    // データベース接続エラー時の処理
    die("DBConnectError: " . $e->getMessage());
}
?>
