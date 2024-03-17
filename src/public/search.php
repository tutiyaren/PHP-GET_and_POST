<?php
use App\Elements;
require '../app/elements.php';

$searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';

$name = isset($_POST['name']) ? $_POST['name'] : '';

$pdo = new PDO('mysql:host=mysql;dbname=sample', 'root', 'password');

// DBにデータを挿入
if (!empty($name)) {
    // DBにデータを挿入
    $sendModel = new Elements($pdo);
    $sendModel->addElements($name);
}
// DBのデータをすべて取得
$displayModel = new Elements($pdo);
if (!empty($searchKeyword)) {
    $display = $displayModel->searchElements($searchKeyword);
} 
if (empty($searchKeyword)) {
    $display = $displayModel->getElements();
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GETとPOSTへの理解</title>
</head>
<body>
    <!-- 検索 -->
    <form method="get">
        <input type="text" name="search" placeholder="検索" value="<?php echo htmlspecialchars(
            $searchKeyword,
            ENT_QUOTES,
            'UTF-8'
        ); ?>">
        <button type="submit">検索</button>
    </form>

    <!-- 追加した要素一覧表示 -->
    <div>
        <?php foreach ($display as $date): ?>
            <p><?php echo $date['name']; ?></p>
        <?php endforeach; ?>
    </div>
    
    <div>
        <a href="element.php">戻る</a>
    </div>

</body>
</html>