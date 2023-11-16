<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

</style>
</head>
<body>
<ul>
  <div class="logo">
  Valhalla Academy.
  </div>
  <li><a href="logout.php">Logout</a></li>
  <li><a href="contact.php">Contact</a></li>
  <li><a class="active" href="about.php">About</a></li>
  <li><a href="index2.php">Store</a></li>
</ul>

<div class="content">
  <h2>About Us</h2>
  <p>
    Welcome to our Academy! We are dedicated to providing high-quality education and resources to help you achieve your goals. Our team of experienced professionals is here to support your learning journey.
  </p>
  <p>
    Whether you're looking to expand your knowledge, develop new skills, or explore a wide range of subjects, we have the tools and resources to help you succeed.
  </p>
  <p>
    Thank you for choosing Valhalla Academy as your learning partner. We look forward to helping you reach new heights in your educational endeavors.
  </p>
</div>

<script>
  window.onscroll = function() {
    var navBar = document.querySelector("ul");
    if (window.pageYOffset >= navBar.offsetTop) {
      navBar.classList.add("sticky");
    } else {
      navBar.classList.remove("sticky");
    }
  };

  <script src="sound.js"></script>

</script>
</body>
</html>
