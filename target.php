<?php
    //DB接続
    include 'includes/dbset.php';
/*
    try {
        $db = new PDO($dsn, $user, $password);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $stmt = $db->prepare("
        SELECT MAX(weight) as max_weight
        FROM record 
        GROUP BY hiduke 
        DESC LIMIT 1;
        ");
        $stmt->execute();
        $weight = $stmt->fetchColumn();

    } catch(PDOException $e) {
        var_dump($e);
        exit("記録がありません" . $e);
    }

*/
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>目標体重設定</title>
    <!--normalize.css-->
        <link rel ="stylesheet" href="css/Normalize.css">
    <!--font-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!--text.css-->
        <link rel ="stylesheet" href = "css/text.css">
        <link href="https://fonts.googleapis.com/css2?family=Bitter:wght@700&family=Dancing+Script:wght@600;700&family=Lora&family=Noto+Sans+JP:wght@200&display=swap" rel="stylesheet">
    <!--js-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>
</head>
<body>
    <div class="wrapper">
        <h1>目標・期間</h1>
    <form action="target_write.php" method="post">
        <!--1週間後以降の日付を取得-->
        <p><input type="date" name="t_date" value="<?php echo date('Y-m-d', strtotime('+7 day')); ?>">までに</p>
        <p><input type="text" name="t_weight" placeholder="小数点第2位まで入力">kg到達目標</p>
        <input type="submit" value="登録">
    </form>
    <div id="button1">
            <button><a href="#">体重入力</a></button>
            <button><a href="calendar.php">カレンダー</a></button>
            <button><a href="analysis.php">分析</a></button>
            <button><a href="target.php">目標・期間</a></button>
            <button><a href="post.php">投稿</a></button>
    </div>
</div>
</body>
</html>
