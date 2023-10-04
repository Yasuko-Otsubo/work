<?php

    //cookie読み込んでフォームの名前設定する
    if(isset($_COOKIE['name'])){
        $name = $_COOKIE['name'];
    } else {
        $name = "";
    }

    $num = 3;

    //DB接続
    include 'includes/dbset.php';
    
    //getメソッドで2ページ目以降が指定されているとき
    $page = 1;
    if(isset($_GET['page']) && $_GET['page'] > 1){
        $page = intal($_GET['page']);
    }

    try {
        $db = new PDO($dsn, $user, $password);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $stmt = $db->prepare("
        SELECT * FROM toko 
        ORDER BY date DESC LIMIT :page, :num
        ");

        $page = ($page-1) * $num;
        $stmt->bindParam(':page', $page, PDO::PARAM_INT);
        $stmt->bindParam(':num', $num, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e){
        exit('エラー:' . $e->getMessage());
    }

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿</title>
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
<body>
    <div class="wrapper">
        <h1>投稿ページ</h1>
        <h2></h2>
    <?php while ($row = $stmt->fetch()): ?>
            <div>
                <!--一件分のcard読み込んだらrowからtitleを読み込んでくる　中身が入っていたら[title]を返す。入っていなかったら(無題)と返す-->
                <div><p><?php echo nl2br(htmlspecialchars($row['body'], ENT_QUOTES, 'UTF-8')) ?></p>
                    <?php echo $row['name'] ?>(<?php  echo $row['date'] ?>)
                </div>
            </div>
        
        <?php endwhile; ?>
        <hr>
        <?php
            try {
                //SELECTで件数読み込む
                $stmt = $db->prepare("
                SELECT COUNT(*) FROM toko
                ");
                $stmt->execute();
            } catch (PDOException $e){
                exit("エラー:" . $e->getMessage());
            }

            //fetchColumnを使って書き込みの件数を取得し、$commentsに入れる
            $comments = $stmt->fetchColumn();
            //ページ数を計算 maxpage = 整数に切り上げ(書き込み件数 / 一ページに書き込める件数　$num=10)
            $max_page = ceil($comments / $num);

            //ページングの必要があれば表示
            if($max_page >= 1){
                echo '<nav><ul  class="pagination">';
                for ($i=1; $i<=$max_page; $i++){
                    //まず<li class="page-item"><a href="bbs.php?page=$i">$i</a></li>こう書いて後から'を書いていく
                    echo '<li class="page-item"><a href="bbs.php?page=' . $i . '">' . $i .'</a></li>';
            }
            echo '</ul></nav>';
        }
?>
        <form action="toko.php" method="post">
        <div class="req">
            <label>名前</label>
                    <input type="text" name="name" >
            <label>削除パスワード</label>
                <input type="text" name="pass" placeholder="数字4桁">
        </div><!--class="req"-->
        <label>投稿内容</label>
            <textarea name="body"  rows="5" placeholder="100字以内で入力してください" ></textarea>
            <input type="submit"  value="書き込む">
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
