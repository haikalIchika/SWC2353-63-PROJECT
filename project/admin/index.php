<?php
include('header_admin.php');

@include 'config.php';

if (!isset($_SESSION['admin_name'])) {
   header('location:index.php');
}

#book helper function
include "../func-book.php";
$books = get_all_books($conn);

#author helper function
include "../func-author.php";
$authors = get_all_author($conn);

#categories helper function
include "../func-category.php";
$categories = get_all_categories($conn);

?>

<style>
   .center {
  display: block;
  margin-left: auto;
  margin-right: auto;
}
</style>
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
   <style>
      .admin-name {
         font-size: 25px;
      }
   </style>
</head>


<body>
   <div class='w3-center w3-panel w3-border w3-round-large w3-light-grey'>
      <p class="admin-name">
         Admin Name :
         <?php echo $_SESSION['admin_name']; ?>
      </p>
   </div>

   <div class="mt-5"></div>
        <?php if (isset($_GET['error'])) { ?>
          <div class="alert alert-danger" role="alert">
			  <?=htmlspecialchars($_GET['error']); ?>
		  </div>
		<?php } ?>
		<?php if (isset($_GET['success'])) { ?>
          <div class="alert alert-success" role="alert">
			  <?=htmlspecialchars($_GET['success']); ?>
		  </div>
		<?php } ?>

   <?php  if ($books == 0) { ?>
        	<div class="alert alert-warning 
        	            text-center p-5" 
        	     role="alert">
        	     <img src="img/empty.png" 
        	          width="100">
        	     <br>
			  There is no book in the database
		  </div>
        <?php }else {?>
      <!----List of All Books --->
   <h4 class="mt-5">All Books</h4>
   <table class="table table-bordered shadow">
      <thead>
         <tr>
            <th>Bil.</th>
            <th>Title</th>
            <th>Author</th>
            <th>Description</th>
            <th>Category</th>
            <th>Action</th>
         </tr>
      </thead>
      <tbody>
         <?php
         $i = 0;
         foreach ($books as $book) {
            $i++;
            ?>

         <tr>
            <td>
               <?= $i ?>
            </td>
            <td>
               <img class="center" width="100" src="../uploads/cover/<?= $book['cover'] ?>"><br>
               <a class="text-decoration-none d-block text-center" href="../uploads/files/<?= $book['file'] ?>">
                  <?= $book['title'] ?>

               </a>
            </td>
            <td>
               <?php if ($authors == 0) {
                  echo "Undefined";
               } else {

                  foreach ($authors as $author) {
                     if ($author['id'] == $book['author_id']) {
                        echo $author['name'];
                     }
                  }
               }
               ?>
            </td>
            <td>
               <?= $book['description'] ?>
            </td>
            <td>
               <?php if ($categories == 0) {
                  echo "Undefined";
               } else {

                  foreach ($categories as $category) {
                     if ($category['id'] == $book['category_id']) {
                        echo $category['name'];
                     }
                  }
               }
               ?>
            </td>
            <td>
               <a href="edit_book.php?id=<?=$book['id']?>" class="btn btn-warning">Edit</a>
               <a href="../delete_book.php?id=<?=$book['id']?>" class="btn btn-danger">Delete</a>
            </td>
         </tr>
         <?php } ?>
      </tbody>
   </table>
   <?php } ?>

   <?php if ($categories == 0) { ?>
   empty
   <?php } else { ?>

   <!----List of All Categories --->
   <h4 class="mt-5">All Categories</h4>

   <table class="table table-bordered shadow">
      <thead>
         <tr>
            <th>Bil.</th>
            <th>Category Name</th>
            <th>Action</th>
         </tr>
      </thead>
      <tbody>
         <?php
         $j = 0;
         foreach ($categories as $category) {
            $j++;
            ?>
         <tr>
            <td>
               <?= $j ?>
            </td>
            <td>
               <?= $category['name'] ?>
            </td>
            <td>
               <a href="edit_category.php?id=<?=$category['id']?>" class="btn btn-warning">Edit</a>
               <a href="../delete_category.php?id=<?=$category['id']?>" class="btn btn-danger">Delete</a>
            </td>

         </tr>
         <?php } ?>
      </tbody>
   </table>
   <?php } ?>

   <?php if ($authors == 0) { ?>
   empty
   <?php } else { ?>

   <!----List of All Authors --->
   <h4 class="mt-5">All Authors</h4>
   <table class="table table-bordered shadow">
      <thead>
         <tr>
            <th>Bil.</th>
            <th>Author Name</th>
            <th>Action</th>
         </tr>
      </thead>
      <tbody>
         <?php
         $k = 0;
         foreach ($authors as $author) {
            $k++;
            ?>
         <tr>
            <td>
               <?= $k ?>
            </td>
            <td>
               <?= $author['name'] ?>
            </td>
            <td>
               <a href="edit_author.php?id=<?=$author['id']?>" class="btn btn-warning">Edit</a>
               <a href="../delete_author.php?id=<?=$author['id']?>" class="btn btn-danger">Delete</a>
            </td>

         </tr>
         <?php } ?>
      </tbody>
   </table>
   <?php } ?>


</body>

</html>