<?php
    $dsn = 'mysql:host=localhost;dbname=wheight_control;charset=utf8';
    $user = 'root';
    $password = 'password';
    
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
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1"></script>
                <script>
      window.onload = function () {
        let context = document.querySelector("#fukuoka_temperature_chart").getContext('2d')
        new Chart(context, {
          type: 'line',
          data: {
            labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30'],
            datasets: [{
              label: "6月",
              data: [53.5, 53, 53, 52.9, 53.3, , , , , , ,55 ],
            }],
          },
          options: {
          }
        })
      }
    </script>

</head>
<body>
    <div class="wrapper">
        <h1>分析</h1>

        <div id="button1">
            <button><a href="#">体重入力</a></button>
            <button><a href="calendar.php">カレンダー</a></button>
            <button><a href="analysis.php">分析</a></button>
            <button><a href="target.php">目標・期間</a></button>
            <button><a href="post.php">投稿</a></button>
    </div>
</div>
</body>
<canvas id="fukuoka_temperature_chart" width="40%" height="30%"></canvas>
</html>
