<?PHP

session_start();

include('../config.php');
?>

<!doctype HTML>
<html>

<head>
  <title>Valhalla Academy</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster&effect=shadow-multiple">
  <style>
    .w3-title {
      font-family: "Lobster", Sans-serif;
    }

    .w3-green {
      background-color: #4CAF50;
      color: white;
    }

  </style>

</head>

<div class="w3-container w3-green">
  <h1 class="w3-title w3-xxlarge font-effect-shadow-multiple w3-text-black"><b>

      <i class="fa fa-lock" aria-hidden="true"></i>
      Admin Page
    </b></h1>


</div>
</div>

<div class="w3-bar w3-black">

  <a href='index.php' class="w3-bar-item w3-button">Home</a>
  <a href='../logout.php' class="w3-bar-item w3-button w3-right w3-red">Logout</a>

  <div class="w3-dropdown-hover">
    <button class="w3-button">Book</button>
    <div class="w3-dropdown-content w3-bar-block w3-card-4">
      <a href='add_book.php' class="w3-bar-item w3-button">Add Book</a>
      <a href='add_category.php' class="w3-bar-item w3-button">Add Category</a>
      <a href='add_author.php' class="w3-bar-item w3-button">Add Author</a>
    </div>
  </div>
</div>

<div class="w3-container">