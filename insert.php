<?php
date_default_timezone_set('Asia/Tokyo');

//1. POSTデータ取得
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['content'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $content = $_POST['content'];
} else {
    exit('フォームの入力が正しくありません。');
}

// 画像アップロード処理
$image_path = null; // デフォルト値としてnullを設定

// ディレクトリの存在確認と作成
$target_dir = __DIR__ . "/uploads/";
if (!is_dir($target_dir)) {
    if (!mkdir($target_dir, 0777, true)) {
        exit('アップロードディレクトリの作成に失敗しました: ' . $target_dir);
    }
}

if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // 画像ファイルかチェック
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_path = "uploads/" . basename($_FILES["image"]["name"]); // 相対パスを保存
        } else {
            exit('画像のアップロードに失敗しました。詳細: ' . error_get_last()['message']);
        }
    } else {
        exit('ファイルは画像ではありません。');
    }
} elseif (isset($_FILES['image']) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {
    // 画像が選択されていない場合以外のエラーメッセージを処理
    exit('画像のアップロード中にエラーが発生しました。エラーコード: ' . $_FILES['image']['error']);
}

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
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    echo "DB接続成功";
} catch (PDOException $e) {
    exit('DBConnectError エラー！:'.$e->getMessage());
}

//4. データ登録SQL作成
$currentDateTime = date('Y-m-d H:i:s');
$stmt = $pdo->prepare('INSERT INTO php_kadai04 (username, comment, postdate, image_path) VALUES (:name, :content, :postdate, :image_path)');
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':content', $content, PDO::PARAM_STR);
$stmt->bindValue(':postdate', $currentDateTime, PDO::PARAM_STR);
$stmt->bindValue(':image_path', $image_path, PDO::PARAM_STR);

//5. 実行
$status = $stmt->execute();

//6. データ登録処理後
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('ErrorMessage:'.$error[2]);
} else {
    echo "データ登録成功";
    header('Location: index.php'); // デバッグのため一時的にコメントアウト
}
?>
