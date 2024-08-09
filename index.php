<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>フードシェアリング掲示板</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #f5f5f5;
        }
        .navbar {
            background-color: #00c300;
            color: white;
        }
        .navbar-brand {
            color: white !important;
        }
        .jumbotron {
            padding: 2em;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 0.5em;
            margin-bottom: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="file"] {
            margin-bottom: 1em;
        }
        input[type="submit"] {
            background-color: #00c300;
            color: white;
            border: none;
            padding: 0.5em 1em;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">掲示板一覧</a></div>
            </div>
        </nav>
    </header>
    <main>
        <div class="container">
            <form method="post" action="insert.php" enctype="multipart/form-data">
                <div class="jumbotron">
                    <fieldset>
                        <legend>フードシェアリング掲示板</legend>
                        <label>名前：<input type="text" name="name" required></label><br>
                        <label>Email：<input type="text" name="email" required></label><br>
                        <label>内容：<textarea name="content" rows="4" cols="40" required></textarea></label><br>
                        <label>写真：<input type="file" name="image"></label><br> <!-- required属性を削除 -->
                        <input type="submit" value="投稿する">
                    </fieldset>
                </div>
            </form>
        </div>
    </main>
</body>
<

