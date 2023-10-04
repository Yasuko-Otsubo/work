<?php
    //◎db接続
    include 'includes/dbset.php';

    //◎GETで前月・次月リンクが押されたとき
    if (isset($_GET['ym'])) {
        //GETでym=data('Y-m')を取得
        $ym = $_GET['ym'];
    } else {
        //◎今月の年月を表示
        $ym = date('Y-m');
    }

    //◎タイムスタンプを作成、フォーマットをチェックする
    $timestamp = strtotime($ym , '-01');
    if($timestamp === false){
        $ym = data('Y-m');
        //◎$timestampがfalseの時は現在の年月を入れる
        $timestamp = strtotime($ym, '-01');
    }

    //◎今日の日付　例）2023-05-23
    $today = date('Y-m-j');

    //◎カレンダーのタイトルを作成　例）2023年5月
    $html_title = date('Y年n月', $timestamp);
    
    //◎前月・次月を取得
    //◎方法１：mktimeを使う mktime(hour,minute,second,month,day,year)
    $prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
    $next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));

    //◎該当月の日数を取得
    $day_count = date('t', $timestamp);

    //◎１日が何曜日か　0:日 1:月 2:火 ... 6:土
    $youbi = date('w', $timestamp);

    //◎カレンダー作成の準備
    $weeks = [];
    $week = '';

    //◎第１週目：空のセルを追加
    //◎ 例）１日が火曜日だった場合、日・月曜日の２つ分の空セルを追加する
    $week .= str_repeat('<td></td>', $youbi);

    //◎dayに1set, $dayより$day_countが小さくなるまで $day $youbiに1ずつ足す
    for ($day=1; $day<=$day_count; $day++, $youbi++) {

        // ◎2023-05-23
        $date = $ym . '-' . $day;

            try {
                $db = new PDO($dsn, $user, $password);
                $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                $stmt2 = $db->prepare("
                SELECT weight 
                FROM record 
                WHERE hiduke = :date
                ");
                $stmt2->bindParam(':date', $date);
                $stmt2->execute();
                $weight = $stmt2->fetchColumn();

            } catch (PDOException $e) {
                exit('エラー: ' . $e->getMessage());
            }

        if ($today == $date) {
            //◎今日の日付の場合は、class="today"をつける
            $week .= '<td class="today">' . $day;
        } else {
            $week .= '<td>' . $day . '<br>' . $weight;
        }
            $week .= '</td>';

        //◎このあたりにデータを入れるプログラム
        //◎tdの日付とhidukeが一致したらweightをセットする
        try {
            $db = new PDO($dsn, $user, $password);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
            $stmt=$db->prepare("
            SELECT hiduke, weight FROM record 
            GROUP BY hiduke 
            ");
            $stmt->execute();
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                $hiduke = ($result['hiduke']);
                $weight = ($result['weight']);
            }
        } catch(PDOException $e) {
            exit('エラー: ' . $e);
        }
        




        
/********************6/13 **********************
for ($day = 1; $day <= $day_count; $day++, $youbi++) {
    //◎2023-05-23
    $date = $ym . '-' . $day;
    
    if ($today == $date) {
        //◎今日の日付にはclass="today"付ける
        $week .= '<td class="today">' . $day;
    } else {
        $week .= '<td>' . $day;
    }
        $week .= '</td>';

    try {
        $db = new PDO($dsn, $user, $password);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $stmt2 = $db->prepare("
        SELECT weight 
        FROM record 
        WHERE hiduke = :date");
        $stmt2->bindParam(':date', $date);
        $stmt2->execute();
        $weight = $stmt2->fetchColumn();

        if ($weight !== false) {
            $week .= '<br>' . $weight;
        } else {
            $week .= '<br>';
        }
    } catch (PDOException $e) {
        exit('エラー: ' . $e->getMessage());
    }

    }
    */

    
            //◎週終わり、または、月終わりの場合
            if ($youbi % 7 == 6 || $day == $day_count) {

                if ($day == $day_count) {
                    //◎月の最終日の場合、空セルを追加
                    //◎例）最終日が水曜日の場合、木・金・土曜日の空セルを追加
                    $week .= str_repeat('<td></td>', 6 - $youbi % 7);
                }

                //◎weeks配列にtrと$weekを追加する
                $weeks[] = '<tr>' . $week . '</tr>';

                //◎weekをリセット
                $week = '';
            }
        }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>カレンダー</title>
    <!--normalize.css-->
        <link rel ="stylesheet" href="css/Normalize.css">
    <!--bootstrap-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"  integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!--text.css-->
        <link rel ="stylesheet" href = "css/text.css">
        <link href="https://fonts.googleapis.com/css2?family=Bitter:wght@700&family=Dancing+Script:wght@600;700&family=Lora&family=Noto+Sans+JP:wght@200&display=swap" rel="stylesheet">
    <!--font-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!--js-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>
<body>
    <div class="wrapper">
    <h1 class="mb-5"><a href="?ym=
        <?php echo $prev; ?>
        ">&lt;</a> 
        <?php echo $html_title; ?>
        <a href="?ym=
        <?php echo $next; ?>
        ">&gt;</a></h1>
     <table id="table" class="table table-bordered">
        <tr>
            <th>日</th>
            <th>月</th>
            <th>火</th>
            <th>水</th>
            <th>木</th>
            <th>金</th>
            <th>土</th>
        </tr>  
        <?php
            foreach ($weeks as $week) {
                echo $week;
            }

        ?>
        </table>
    <p>
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
