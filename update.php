<?php
// 必要なファイルをインクルード
include 'funcs.php';

// データベース接続
// $dbname = 'php_php04kadai';
// $host = 'localhost';
// $dbname = 'php_kadai04';
// $username = 'root';
// $password = '';
//3. DB接続情報を環境に応じて切り替えます
if ($_SERVER['HTTP_HOST'] === 'localhost') {
    // ローカル環境
    $dbname = 'php04kadai';
    $host = 'localhost';
    $dbname = 'php_kadai04';
    $username = 'root';
    $password = '';
} else {
    // サーバー環境（さくらインターネット）
    // ここ、サーバー情報追加！
    $host = 'mysql618.db.sakura.ne.jp';

    $host = 'mysql57.onotoshi.sakura.ne.jp'; // さくらインターネットから提供されたホスト名

    // ↓コメントアウトして昨日の情報に変更！php04kadaiにすべて変更ローカルでは動くがさくらでは動作できない！
    $dbname = 'onotoshi_php_Php04kadai';

    // $dbname = 'onotoshi_php_kadai04'; // データベース名
    $username = 'onotoshi'; // データベースユーザー名
    $password = 'to20131117'; // データベースパスワード
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // フォームからデータを取得
        $id = $_POST['id'];
        $username = $_POST['username'];
        $comment = $_POST['comment'];

        // 更新クエリを準備
        $stmt = $pdo->prepare("UPDATE php_kadai04 SET username = ?, comment = ? WHERE id = ?");
        $stmt->execute([$username, $comment, $id]);

        echo "Update successful!";
    } else {
        // idがGETリクエストで送られてきた場合、対象のデータを取得
        $id = $_GET['id'];
        $stmt = $pdo->prepare("SELECT * FROM php_kadai04 WHERE id = ?");
        $stmt->execute([$id]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    die("DBConnectError: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Post</title>
</head>
<body>
<h2>Update Post</h2>
<form action="update.php" method="post">
    <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" value="<?php echo $post['username']; ?>" required><br><br>
    <label for="comment">Comment:</label>
    <textarea id="comment" name="comment" required><?php echo $post['comment']; ?></textarea><br><br>
    <input type="submit" value="Update">
</form>
</body>
</html>
