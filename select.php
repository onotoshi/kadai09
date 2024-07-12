<?php
require_once('funcs.php');

//1. DB接続
try {
    $pdo = new PDO('mysql:dbname=php_kadai04;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
    exit('DBConnectError:'.$e->getMessage());
}

//2. データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM php_kadai04");
$status = $stmt->execute();

//3. データ表示
$view = "";
if ($status === false) {
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $dateTime = new DateTime($result['postdate']);
        $formattedDate = $dateTime->format('Y-m-d H:i:s');
        $view .= '<div class="post">';
        $view .= '<div class="post-header">';
        $view .= '<span class="post-user">'.h($result['username']).'</span>';
        $view .= '<span class="post-date">'.h($formattedDate).'</span>';
        $view .= '</div>';
        $view .= '<div class="post-content">'.h($result['comment']).'</div>';
        if (!empty($result['image_path'])) {
            $view .= '<div class="post-image"><img src="'.h($result['image_path']).'" alt="投稿画像"></div>';
        }
        $view .= '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>掲示板一覧</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        font-family: 'Helvetica Neue', Arial, sans-serif;
        background-color: #f0f4c3;
        margin: 0;
        padding: 0;
    }
    .navbar {
        background-color: #8bc34a;
        color: white;
    }
    .navbar-brand {
        color: white !important;
    }
    .container {
        margin-top: 2em;
    }
    .jumbotron {
        padding: 2em;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .post {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        margin-bottom: 1em;
        padding: 1em;
    }
    .post-header {
        display: flex;
        justify-content: space-between;
        border-bottom: 1px solid #e0e0e0;
        padding-bottom: 0.5em;
        margin-bottom: 0.5em;
    }
    .post-user {
        font-weight: bold;
        color: #4caf50;
    }
    .post-date {
        color: #999;
        font-size: 0.9em;
    }
    .post-content {
        color: #333;
        font-size: 1em;
    }
    .post-image img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin-top: 1em;
    }
</style>
</head>
<body id="main">
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php">掲示板登録</a>
      </div>
    </div>
  </nav>
</header>
<main>
    <div class="container">
        <div class="jumbotron"><?= $view ?></div>
    </div>
</main>
</body>
</html>
