<!-- this is wat we used in class as the index page- page that we are brought to
after logging out of the- need to redirect the login page to the posts.php page and
which is the main page of our website that we want users to land on first.php
-- need to add in the small php session code to the top of pages -->

<?php 
  session_start();
  if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
?>

<!DOCTYPE html>
<html>
<head>
  <title>HOME</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <h1>Hello, <?php echo $_SESSION['name']; ?></h1>
  <a href="logout.php">Logout</a>
</body>
</html>

<?php 
} else {
  header("Location: login.php");
  exit();
}
?>