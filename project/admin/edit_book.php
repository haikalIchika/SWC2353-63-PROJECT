<?php
include('header_admin.php');

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

@include 'config.php';

#book helper function
include "../func-book.php";
$book = get_book($conn, $id);

if (empty($book)) {
    header("Location: index.php");
    exit;
}


#categories helper function
include "../func-category.php";
$categories = get_all_categories($conn);

#author helper function
include "../func-author.php";
$authors = get_all_author($conn);


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
<form action="../edit_book.php"
           method="post"
           enctype="multipart/form-data" 
           class="shadow p-4 rounded mt-5"
           style="width: 90%; max-width: 50rem;">

     	<h1 class="text-center pb-5 display-4 fs-3">
     		Edit Book
     	</h1>
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
     	<div class="mb-3">
		    <label class="form-label">
		           Book Title
		           </label>
		    <input type="text" 
            hidden
				   value="<?=$book['id']?>"
		           name="book_id">

                   <input type="text" 
		           class="form-control"
				   value="<?=$book['title']?>"
		           name="book_title">
		</div>

		<div class="mb-3">
		    <label class="form-label">
		           Book Description
		           </label>
		    <input type="text" 
		           class="form-control" 
				   value="<?=$book['description']?>"
		           name="book_description">
		</div>

		<div class="mb-3">
		    <label class="form-label">
		           Book Author
		           </label>
		    <select name="book_author"
		            class="form-control">
		    	    <option value="0">
		    	    	Select author
		    	    </option>
		    	    <?php 
                    if ($authors == 0) {
                    	# Do nothing!
                    }else{
		    	    foreach ($authors as $author) { 
		    	    	if ($book['author_id'] == $author['id']) 
						{ 
					?>
		    	    	<option 
		    	    	  selected
		    	    	  value="<?=$author['id']?>">
		    	    	  <?=$author['name']?>
		    	        </option>
		    	   <?php }else{ ?>
					<option 
		    	    	  value="<?=$author['id']?>">
		    	    	  <?=$author['name']?>
		    	        </option>
				   <?php }} } ?>
		    </select>
		</div>

		<div class="mb-3">
		    <label class="form-label">
		           Book Category
		           </label>
		    <select name="book_category"
		            class="form-control">
		    	    <option value="0">
		    	    	Select category
		    	    </option>
		    	    <?php 
                    if ($categories == 0) {
                    	# Do nothing!
                    }else{
						foreach ($categories as $category) { 
							if ($book['category_id'] == $category['id']) 
							{ 
						?>
							<option 
							  selected
							  value="<?=$category['id']?>">
							  <?=$category['name']?>
							</option>
					   <?php }else{ ?>
						<option 
							  value="<?=$category['id']?>">
							  <?=$category['name']?>
							</option>
					   <?php }} } ?>
		    </select>
		</div>

		<div class="mb-3">
		    <label class="form-label">
		           Book Cover
		           </label>
		    <input type="file" 
		           class="form-control" 
		           name="book_cover">

                   <input type="text" 
            hidden
				   value="<?=$book['cover']?>"
		           name="current_cover">

                   <a href="../uploads/cover/<?=$book['cover']?>" class="link-dark">Current Cover</a>
		</div>

		<div class="mb-3">
		    <label class="form-label">
		           File
		           </label>
		    <input type="file" 
		           class="form-control" 
		           name="file">

                   <input type="text" 
            hidden
				   value="<?=$book['file']?>"
		           name="current_file">

                   <a href="../uploads/files/<?=$book['file']?>" class="link-dark">Current File</a>

		</div>

	    <button type="submit" 
	            class="btn btn-primary">
	            Update</button>
     </form>


</body>

</html>