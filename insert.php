<?php

session_start();
require_once 'funcs.php';
loginCheck();

//1. POSTつぶやき取得
$content = $_POST['content'];

// 画像アップロードの処理

//2. DB接続します
$pdo = db_conn();

//３．つぶやき登録SQL作成
$stmt = $pdo->prepare('INSERT INTO contents(content, created_at)VALUES(:content, NOW());');
$stmt->bindValue(':content', $content, PDO::PARAM_STR);
$status = $stmt->execute(); //実行

//４．つぶやき登録処理後
if (!$status) {
    sql_error($stmt);
} else {
    redirect('select.php');
}
