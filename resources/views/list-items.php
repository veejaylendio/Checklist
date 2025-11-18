<?php
$path = '../../data.json';
$jsonContent = file_get_contents($path);
$jsonData = json_decode($jsonContent, true);
$itemNames=[];
foreach ($jsonData as $category)
{
    $id = $_GET['id'];

    foreach ($category['items'] as $item)
    {
        if($category['id'] == $id)
        {
            $categoryName = $category['category_name'];
            $itemNames[] = $item['name'];
        }
    }
}
$categoryName = isset($categoryName) ? $categoryName : '';
$itemNames = isset($itemNames) ? $itemNames : [];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/list-items.css">
    <title>Checklist</title>
</head>
<body>
<div class="container">
    <div class="check-list">
            <div class="sub-header">
                <div>
                    <h2><?php echo $categoryName?></h2>
                </div>
            </div>
        <hr>
        <h4>Item List:</h4>
        <?php foreach($itemNames as $item) :?>
            <div class="items">
                <label><input type="checkbox"/><span class="item-name"><?php echo $item ?></span></label>
            </div>
        <?php endforeach;?>
    </div>
    <div class="create-list">
        <a href="/" class="button btn-open">Cancel</a>
        <a href="edit-list-items.php?id=<?php echo $id ?>" class="button btn-edit-list">Edit</a>
    </div>
</div>
</body>
</html>