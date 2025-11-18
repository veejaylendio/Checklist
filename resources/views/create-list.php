<?php
session_start();
$error="This is required";
$categoryName = isset($_SESSION['category-name']) ? $_SESSION['category-name'] : '';
$itemName = isset($_SESSION['item-data']) ? $_SESSION['item-data'] : [];

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if(isset($_POST['add-category']) && $_POST['add-category'] == "+")
    {
        $_SESSION['category-name'] = $_POST['category-name'];
    }

    if(isset($_POST['add-item']) && $_POST['add-item'] == "+")
    {
        if(!isset($_SESSION['item-data']))
        {
            $_SESSION['item-data'] = [];
        }
        $itemName = $_POST['item-name'];
        $items = $_SESSION['item-data'];
        $newId= 0;
        foreach ($items as $item)
        {
            if ($item['id'] > $newId) {
                $newId = $item['id'];
            }
        }
        $newId=$newId+1;
        $items[]=[
            'id' => $newId,
            'name' => $itemName,
        ];
        $_SESSION['item-data'] = $items;
    }

}
if($_SERVER['REQUEST_METHOD'] === 'POST')
{

    if(isset($_POST['save']) && $_POST['save'] == "Save")
    {
        $path = '../../data.json';
        $data = file_get_contents($path);
        $json = json_decode($data, true);
        $newId= 0;

        $cName = isset($_SESSION['category-name']) ? $_SESSION['category-name'] : '';
        $idata = isset($_SESSION['item-data']) ? $_SESSION['item-data'] : [];

        //search for the biggest ID number
        foreach ($json as $key => $value)
        {
            if ($value['id'] > $newId)
            {
                $newId = $value['id'];
            }
        }
        $newId=$newId+1;
        $jsonData =
            [
                "id" => $newId,
                "category_name" => $cName,
                'items' => $idata
            ];
        array_push($json, $jsonData);
        $jsonString = json_encode($json, JSON_PRETTY_PRINT);
        $openJsonFile=fopen($path, 'w');
        fwrite($openJsonFile, $jsonString);
        fclose($openJsonFile);
        unset($_SESSION['category-name']);;
        $_SESSION['item-data']=[];
        header('location: /resources/views/create-list.php');
    }elseif (isset($_POST['cancel']) && $_POST['cancel'] == "Cancel"){
        unset($_SESSION['category-name']);;
        $_SESSION['item-data']=[];
        header('location: /');
    }
}

$isHidden = isset($_SESSION['category-name']) ? "hidden" .' '. "disabled" : "";
$btnHidden= !isset($_SESSION['category-name']) ? "hidden" : "";
$categoryName= isset($_SESSION['category-name']) ? $_SESSION['category-name'] : "";
$items= isset($_SESSION['item-data']) ? $_SESSION['item-data'] : [];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/create.css">
    <title>Checklist</title>
</head>
<body>
    <h1>Create New List</h1>
    <div class="container">
        <form method="post">
            <div class="category">
                <div class="sub-header">
                    <!--Hide category field if already have one.-->
                    <div <?php echo $isHidden; ?>>
                        <label for="category-name" class="category-label">Category</label>
                        <div class="category-section">
                            <input class="category-input" id="category-name" name="category-name" type="text" placeholder="Category Name" value="">
                            <input type="submit" class="add-button btn-add-list" name="add-category" value="+" <?php echo $isHidden; ?>>
        <!--                        <span class="error"> --><?php //echo $error; ?><!--</span>-->
                        </div>
                    </div>
                    <div class="item-section">
                        <label for="item-name" class="category-label">Item</label>
                        <div class="add-section">
                            <div class="add-input-section">
                                <input class="item-input" id="item-name" name="item-name" type="text" placeholder="Item Name">
                                <input type="submit" class="add-button btn-add-list" name="add-item" value="+">
                            </div>
        <!--                        <span class="error"> --><?php //echo $error; ?><!--</span>-->
                        </div>
                    </div>
                </div>
                <hr>
                <div class="checklist-preview">
                    <h2 class="preview">Preview</h2>
                    <div class="category-preview">
                        <h3>Category: <span class="category-style"><?php echo $categoryName ?></span></h3>
                        <div <?php echo $btnHidden; ?>>
                            <a href="edit-category.php" class="button btn-edit-list">Edit</a>
                            <a href="../../Controller/delete-category.php" class="button btn-delete-list">Delete</a>
                        </div>
                    </div>
                    <hr>
                    <h4>Item List:</h4>
                    <ul>
                        <?php foreach($items as $item) : ?>
                            <div class="item-preview">
            <!--                    <label><input type="checkbox"/><span class="item-name">--><?php //echo $item['name'] ?><!--</span></label>-->
                                <li class="items-style"><?php echo $item['name'] ?></li>
                                <div>
                                    <a href="edit-item.php?id=<?php echo $item['id']?>" class="button btn-edit-list">Edit</a>
                                    <a href="../../Controller/delete-create-list.php?id=<?php echo $item['id']?>" class="button btn-delete-list">Delete</a>
                                </div>
                            </div>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
                <div class="create-list">
                    <input type="submit" name="cancel" class="button btn-cancel" value="Cancel">
                    <input type="submit" name="save" class="save-button btn-add-list" value="Save">
                </div>
        </form>
    </div>
</body>
</html>