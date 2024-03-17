<?php

$wrap = 'get通信はURLに反映されるため、IDなどの情報は含めないorハッシュ化などの対策をする';

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GETとPOSTへの理解</title>
</head>
<body>

    <!-- GET -->
    <a href="result.php?wrap=<?php echo urldecode($wrap) ?>">GET送信</a>

    <!-- POST -->
    <form action="result.php" method="post">
        <button type="submit">POST送信</button>
    </form>

    <div>
        <a href="index.php">トップページへ</a>
    </div>

</body>
</html>