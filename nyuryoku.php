<?php
    //DB接続
    include 'includes/dbset.php';
    
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
        //var_dump($e);
        exit("記録がありません" . $e);
    }


    try {
        $db = new PDO($dsn, $user, $password);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        //◎時刻を入れたうえで取得する
        $stmt = $db->prepare("
        SELECT * FROM target 
        ORDER BY t_date DESC LIMIT 1;
        ");
        $stmt->execute();
        while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            $t_date = ($result['t_date']);
            $t_weight = ($result['t_weight']);
          }            
        //$t_date = $stmt->fetchAll();
        //$t_weight = $stmt->fetchColumn();

    } catch(PDOException $e) {
        exit("記録がありません" . $e);
    }

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>体重管理</title>
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
        <script src="js/hover_effect.js"></script>
</head>
<body>
    <div class="wrapper"> 
    <h1>体重管理</h1>
    <p>前回の体重は
        <?php echo $weight;?> kgでした</p>
    <form action="write.php" method="post" id="form">
        <!--デフォルトの日付を今日にする(valueで初期値に設定)-->
        <p><input type="date" name="hiduke" value="<?php echo date('Y-m-d'); ?>"></p>
        <p>の体重は<div class=""><input type="text" placeholder="小数点第2位まで入力" name="weight">kgです</div>        
            <label id="memo">メモ</label><textarea placeholder="100文字以内で入力してください" wrap="soft" name="memo"></textarea></p>
        <p><input type="radio" name="bm" value="排便あり">排便あり
            <input type="radio" name="bm" value="排便なし">排便なし</p>
        <input type="submit" value="送信">
    </form>
    <!--記録されている体重と残りの日数が表示される-->
    <p>体重<?php echo $t_weight;?>kgの目標日<?php echo $t_date; ?>まで
    あと<?php 
            //date_default_timezone_set('Asia/Tokyo');
            $today = new DateTime('now');
            $day =  new DateTime($t_date);    //$_POST['t_date'];  //$t_dateを入れたい   new DateTime('2023-07-28');
            //datetimeなにが返ってくるか
            //メソッドオブジェクト帰ってきているdatetime
            //dateが良い？？
            //
            $diff = $day->diff($today);
            echo $diff->days;
        ?>日</p>
    <div id="button1">
            <button><a href="#">体重入力</a></button>
            <button><a href="calendar.php">カレンダー</a></button>
            <button><a href="analysis.php">分析</a></button>
            <button><a href="target.php">目標・期間</a></button>
            <button><a href="post.php">投稿</a></button>
    </div>
</div><!--wrapper-->
</body>
</html>
