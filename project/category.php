<?php
session_start();

# If not category ID is set
if (!isset($_GET['id'])) {
	header("Location: index.php");
	exit;
}

# Get category ID from GET request
$id = $_GET['id'];

# Database Connection File
include "config.php";

# Book helper function
include "func-book.php";
$books = get_books_by_category($conn, $id);

# author helper function
include "func-author.php";
$authors = get_all_author($conn);

# Category helper function
include "func-category.php";
$categories = get_all_categories($conn);
$current_category = get_category($conn, $id);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?= $current_category['name'] ?>
	</title>

	<!-- Bootstrap 5 CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

	<!-- Bootstrap 5 Js bundle CDN-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
		crossorigin="anonymous"></script>

	<link rel="stylesheet" href="css/style.css">

	<style>
		/* Custom CSS for positioning the YouTube video */
		.container {
			max-width: 600px;
		}

		.video-container {
			position: fixed;
			top: 0;
			right: 0;
			width: 300px;
			/* Adjust the width as needed */
			height: 100vh;
			overflow: hidden;
		}

		.video-container iframe {
			width: 100%;
			height: 100%;
			border: none;
		}

	</style>
</head>

<body>

	<div class="container" style="max-width: 600px;">
		<h1 class="display-4 p-3 fs-3">
			<a href="index2.php" class="nd">
				<img src="img/back-arrow.PNG" width="35">
			</a>
			<?= $current_category['name'] ?>
		</h1>
		<div class="d-flex pt-3">
			<?php if ($books == 0) { ?>
				<div class="alert alert-warning 
						text-center p-5" role="alert">
					<img src="img/empty.png" width="100">
					<br>
					There is no book in the database
				</div>
			<?php } else { ?>
				<div class="pdf-list d-flex flex-wrap">
					<?php foreach ($books as $book) { ?>
						<div class="card m-1">
							<img src="uploads/cover/<?= $book['cover'] ?>" class="card-img-top">
							<div class="card-body">
								<h5 class="card-title">
									<?= $book['title'] ?>
								</h5>
								<p class="card-text">
									<i><b>By:
											<?php foreach ($authors as $author) {
												if ($author['id'] == $book['author_id']) {
													echo $author['name'];
													break;
												}
												?>

											<?php } ?>
											<br>
										</b></i>
									<?= $book['description'] ?>
									<br><i><b>Category:
											<?php foreach ($categories as $category) {
												if ($category['id'] == $book['category_id']) {
													echo $category['name'];
													break;
												}
												?>

											<?php } ?>
											<br>
										</b></i>
								</p>
								<a href="uploads/files/<?= $book['file'] ?>" class="btn btn-success">Open</a>

								<a href="uploads/files/<?= $book['file'] ?>" class="btn btn-primary"
									download="<?= $book['title'] ?>">Download</a>
							</div>
						</div>
					<?php } ?>
				</div>
			<?php } ?>

			<div class="category">
				<!-- List of categories -->
				<div class="list-group">
					<?php if ($categories == 0) {
					// do nothing
				} else { ?>
						<a href="#" class="list-group-item list-group-item-action active">Category</a>
						<?php foreach ($categories as $category) { ?>

							<a href="category.php?id=<?= $category['id'] ?>" class="list-group-item list-group-item-action">
								<?= $category['name'] ?>
							</a>
						<?php }
				} ?>
				</div>

				<!-- List of authors -->
				<div class="list-group mt-5">
					<?php if ($authors == 0) {
					// do nothing
				} else { ?>
						<a href="#" class="list-group-item list-group-item-action active">Author</a>
						<?php foreach ($authors as $author) { ?>

							<a href="author.php?id=<?= $author['id'] ?>" class="list-group-item list-group-item-action">
								<?= $author['name'] ?>
							</a>
						<?php }
				} ?>
				</div>
			</div>
		</div>

	</div>
	<div class="video-container">
		<iframe width="420" height="315" src="https://www.youtube.com/embed/LmuPpbT48CU" frameborder="0"
			allowfullscreen></iframe>
	</div>



</body>

</html>