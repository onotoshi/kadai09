<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="login.php" method="post">
        <!-- ユーザー名の入力フィールド -->
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <!-- パスワードの入力フィールド -->
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <!-- ログインボタン -->
        <input type="submit" value="Login">
    </form>
</body>
</html>

<?php

//3. DB接続情報を環境に応じて切り替えます
if ($_SERVER['HTTP_HOST'] === 'localhost') {
    // ローカル環境
    データベース名	使用量	
    // $dbname = 'php04kadai';
    
    $host = 'localhost';
    $dbname = 'php_kadai04';
    $username = 'root';
    $password = '';
} else {
    // サーバー環境（さくらインターネット）
    // $host = 'mysql57.onotoshi.sakura.ne.jp'; // さくらインターネットから提供されたホスト名
    $host = 'mysql618.db.sakura.ne.jp';
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
        $password = $_POST['password'];

        // SELECTクエリを準備
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        // クエリを実行
        $stmt->execute([$username]);
        // 結果を取得
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // パスワードの検証
        if ($user && password_verify($password, $user['password'])) {
            // ログイン成功メッセージを表示
            echo "Login successful!";
            header('Location: index.php'); // デバッグのため一時的にコメントアウト

        } else {
            // ログイン失敗メッセージを表示
            echo "Invalid username or password.";
        }
    }
} catch (PDOException $e) {
    // データベース接続エラー時の処理
    die("DBConnectError: " . $e->getMessage());
}
?>
