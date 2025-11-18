<?php
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['delete']) && $_POST['delete'] == 'Delete')
    {
        unset($_SESSION['category-name']);

        header('location: ../resources/views/create-list.php');
    }elseif (isset($_POST['cancel']) && $_POST['cancel'] == 'Cancel')
    {
        header('location: ../resources/views/create-list.php');
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../resources/css/delete.css">
    <title>Checklist</title>
</head>
<body>
<div class="container">
    <h4> Are you sure?</h4>
    <form method="post">
        <div class="btn-action">
            <input type="submit" class="button btn-cancel" name="cancel" value="Cancel">
            <input type="submit" class="button btn-delete-list" name="delete" value="Delete">
        </div>
    </form>
</div>
</body>
</html>
