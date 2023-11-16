<?php
session_start();

include "config.php";

# Book helper function
include "func-book.php";
$books = get_all_books($conn);

# author helper function
include "func-author.php";
$authors = get_all_author($conn);

# Category helper function
include "func-category.php";
$categories = get_all_categories($conn);

?>

<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster&effect=shadow-multiple">

	<link rel="stylesheet" href="css/style.css">

	<!-- bootstrap 5 CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

	<!-- bootstrap 5 Js bundle CDN-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
		crossorigin="anonymous"></script>

	<style>
		* {
			margin: 0;
			padding: 0;
		}

		.sticky {
			position: fixed;
			top: 0;
			width: 100%;
		}

		ul {
			list-style-type: none;
			margin: 0;
			padding: 0;
			overflow: hidden;
			background-color: crimson;
			width: 100%;
		}

		.logo {
			float: left;
			padding: 20px 16px;
			font-family: "Lobster", cursive;
			color: white;
			font-size: 28px;
		}

		li {
			float: right;
		}

		li a {
			display: block;
			color: white;
			text-align: center;
			padding: 30px 22px;
			text-decoration: none;
			margin: 0 auto;
		}

		li a:hover:not(.active) {
			background-color: #111;
		}

		.active {
			background-color: black;
		}

		.content {
			padding: 16px;
		}



		th,
		td {
			padding: 8px;
			text-align: left;
			border-bottom: 1px solid #ddd;
		}

		th {
			background-color: crimson;
			color: white;
		}

		.card {
			width: 200px;
			/* Adjust the width as needed */
		}
	</style>
</head>

<body>
	<ul>
		<div class="logo">
			Valhalla Academy.
		</div>
		<li><a href="logout.php">Logout</a></li>
		<li><a href="contact.php">Contact</a></li>
		<li><a href="about.php">About</a></li>
		<li><a class="active" href="index2.php">Store</a></li>
	</ul>

	<?php
	@include 'config.php';
	if (!isset($_SESSION['user_name'])) {
		header('location:index.php');
	}
	echo "
<div class='w3-center w3-panel w3-border w3-round-large w3-light-grey' style='padding: 20px 0;'>
 <p>
Name : " . $_SESSION['user_name'] . "
 </p>
</div>
";
	?>
	<div class="container">

		<div class="d-flex pt-3">
			<?php if ($books == 0) { ?>

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
						<a href="index2.php" class="list-group-item list-group-item-action active">Category</a>
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

		<!-- Include this in your HTML file -->
		<script src="sound.js"></script>

</body>

</html>