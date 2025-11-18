<?php
$path = 'data.json';
$jsonContent = file_get_contents($path);
$jsonData = json_decode($jsonContent, true);

$btnHidden= !isset($_SESSION['category-name']) ? "hidden" : "";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/css/style.css">
    <title>Checklist</title>
</head>
<body>
<div class="container">
    <div class="category">
        <div class="sub-header">
            <div>
                <h2>Checklist</h2>
            </div>
        </div>
        <hr>
        <?php foreach ($jsonData as $list): ?>
            <div class="categories">
                <label><input type="checkbox"/><span class="item-name"><?php echo $list['category_name'] ?></span></label>
                <div>
                    <a href="/resources/views/list-items.php?id=<?php echo $list['id']?>" class="button btn-open"> Open</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="create-list">
        <a href="resources/views/create-list.php" class="button btn-add-list"> + Create New List</a>
    </div>
</div>
</body>
</html>