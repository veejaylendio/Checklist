<?php
session_start();
$category = $_SESSION['category-name'];

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $postName = $_POST['category-name'];
    if(isset($_POST['save']))
    {
        $category = $postName;
    }
    $_SESSION['category-name'] = $category;
    header("location: create-list.php");
}
$category = isset($_SESSION['category-name']) ? $_SESSION['category-name'] : '';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/edit-category.css">
    <title>Checklist</title>
</head>
<body>
<div class="container">
    <div class="category">
        <div class="sub-header">
            <form method="post">
                <div class="item-section">
                    <label for="item-name" class="category-label">Category</label>
                    <div class="add-section">
                        <div class="add-input-section">
                            <input class="item-input" id="item-name" name="category-name" type="text" value="<?php echo $category ?>">
                        </div>
                        <!--                        <span class="error"> --><?php //echo $error; ?><!--</span>-->
                    </div>
                </div>
                <div class="action">
                    <input type="submit" name="cancel" class="button btn-cancel" value="Cancel">
                    <input type="submit" name="save" class="save-button btn-add-list" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>