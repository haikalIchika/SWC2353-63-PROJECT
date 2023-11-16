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

/* Additional Contact Page Styles */
.contact-container {
  margin: 20px;
}

.contact-info {
  font-size: 18px;
  margin-bottom: 20px;
}

.contact-info i {
  margin-right: 10px;
}

.contact-form {
  border: 1px solid #ccc;
  padding: 20px;
  border-radius: 5px;
}

.contact-form input[type="text"],
.contact-form textarea {
  width: 100%;
  padding: 10px;
  margin: 10px 0;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.contact-form button {
  background-color: crimson;
  color: white;
  border: none;
  padding: 10px 20px;
  cursor: pointer;
  border-radius: 5px;
}

.contact-form button:hover {
  background-color: #ff0000;
}
</style>
</head>
<body>
<ul>
  <div class="logo">
  Valhalla Academy.
  </div>
  <li><a href="logout.php">Logout</a></li>
  <li><a class="active" href="contact.php">Contact</a></li>
  <li><a href="about.php">About</a></li>
  <li><a href="index2.php">Store</a></li>
</ul>

<div class="content">
  <h2>Contact Us</h2>

  <div class="contact-container">
    <div class="contact-info">
      <i class="fa fa-envelope"></i> Email: info@valhallaacademy.com
    </div>
    <div class="contact-info">
      <i class="fa fa-phone"></i> Phone: 60123456789
    </div>
    <div class="contact-info">
      <i class="fa fa-map-marker"></i> Address: 12 Jalan Ampang, Malaysia
    </div>
  </div>

  <div class="contact-form">
    <h3>Any Feedback? Let Us Know!</h3>
    <form action="#" method="POST">
      <input type="text" name="name" placeholder="Your Name" required>
      <input type="text" name="email" placeholder="Your Email" required>
      <textarea name="message" placeholder="Your Message" required></textarea>
      <button type="submit">Submit</button>
    </form>
  </div>
</div>

<script src="sound.js"></script>

</body>
</html>
