<?php
include('header_admin.php');

@include 'config.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
        crossorigin="anonymous"></script>
</head>

<body>
    <form action="../add-category.php" 
          method = "post" class="shadow p-4 rounded mt-5" style="width: 90%; max-width: 50rem;">

        <h1 class="text-center pb-5 display-4 fs-3">
            Add New Category
        </h1>
        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?=htmlspecialchars($_GET['error']);?>
            </div>
            <?php } ?>
            <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-success" role="alert">
                <?=htmlspecialchars($_GET['success']);?>
            </div>
            <?php } ?>
        <div class="mb-3">
            <label class="form-label">Category Name </label>
            <input type="text" class="form-control" name="category_name">
        </div>
        <button type="submit" class="btn btn-primary">
            Add Category</button>
    </form>


</body>

</html>