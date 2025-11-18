<?php
    $id = $_GET['id'];
    $path = '../../data.json';
    $jsonContent = file_get_contents($path);
    $jsonData = json_decode($jsonContent, true);

    //view section
    foreach ($jsonData as $category)
    {
        foreach ($category['items'] as $item)
        {
            if($category['id'] == $id)
            {
                $cName = $category['category_name'];
                $iNames[] = $item['name'];
            }
        }
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if(isset($_POST['add-category']) && $_POST['add-category'] == "+")
        {
            foreach ($jsonData as $category)
            {
                $cName = $category['category_name'];
                $cName = $_POST['category-name'];
            }
        }

        if(isset($_POST['add-item']) && $_POST['add-item'] == "+")
        {
            foreach ($jsonData as $category)
            {
                foreach ($category['items'] as $key => $value)
                {

                }
            }
        }


    }
    $cName = isset($cName) ? $cName : '';
    $iNames = isset($iNames) ? $iNames : [];
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
<div class="container">
    <form method="post">
        <div class="category">
            <div class="sub-header">
                <!--Hide category field if already have one.-->
                <div>
                    <label for="category-name" class="category-label">Category</label>
                    <div class="category-section">
                        <input class="category-input" id="category-name" name="category-name" type="text" placeholder="Category Name" value="">
                        <input type="submit" class="add-button btn-add-list" name="add-category" value="+">
                    </div>
                </div>
                <div class="item-section">
                    <label for="item-name" class="category-label">Item</label>
                    <div class="add-section">
                        <div class="add-input-section">
                            <input class="item-input" id="item-name" name="item-name" type="text" placeholder="Item Name">
                            <input type="submit" class="add-button btn-add-list" name="add-item" value="+">
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="checklist-preview">
                <h2 class="preview">Preview</h2>
                <div class="category-preview">
                    <h3>Category: <span class="category-style"><?php echo $cName ?></span></h3>
                    <div>
                        <a href="../../Controller/delete-category.php" class="button btn-delete-list">Delete</a>
                    </div>
                </div>
                <hr>
                <h4>Item List:</h4>
                <ul>
                    <?php foreach ($iNames as $key => $value ): ?>
                        <div class="item-preview">
                            <li class="items-style"><?php echo $value ?></li>
                            <div>
                                <a href="../../Controller/delete-create-list.php?id=<?php echo $key ?>" class="button btn-delete-list">Delete</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
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