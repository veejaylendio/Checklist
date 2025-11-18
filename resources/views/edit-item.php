<?php
session_start();
$id = $_GET['id'];
$items = $_SESSION['item-data'];
$itemFound= [];
foreach ($items as $item)
{
    if ($item['id'] == $id) {
        $itemFound = $item;
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $postId = $_POST['id'];
    $postName = $_POST['item-name'];
    foreach ($items as $key => $value)
    {
        if($value['id'] == $postId)
        {
            $items[$key]['name'] = $postName;
            break;
        }
    }
    $_SESSION['item-data'] = $items;
    header('Location: /resources/views/create-list.php');
}

$categoryName= isset($_SESSION['category-name']) ? $_SESSION['category-name'] : "";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/edit-item.css">
    <title>Checklist</title>
</head>
<body>
<h1>Edit Item</h1>
<div class="container">
    <div class="category">
        <div class="sub-header">
            <div>
                <h2 class="category-header"><?php echo $categoryName ?></h2>
            </div>
            <form action="edit-item.php?id=<?php echo $id;?>" method="post">
                <div class="item-section">
                    <label for="item-name" class="category-label">Item</label>
                        <div class="add-section">
                            <div class="add-input-section">
                                <input name="id"  value="<?php echo $itemFound['id']?>" hidden="">
                                <input class="item-input" id="item-name" name="item-name" type="text" value="<?php echo $itemFound['name']?>" placeholder="Item Name">
                            </div>
<!--                        <span class="error"> --><?php //echo $error; ?><!--</span>-->
                    </div>
                </div>
                <div class="create-list">
                    <input type="submit" name="cancel" class="save-button btn-add-list" value="Cancel">
                    <input type="submit" name="save" class="save-button btn-add-list" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>