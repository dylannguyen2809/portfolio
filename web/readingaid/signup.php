<doctype html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Sign Up</title>
  <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="signup.css" />
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>

<nav>
    <h1><a href="index.php">ReadingAid</a></h1>
    <ul id="navbar">
    <li><a href="about.php">About</a></li>
    <li><a href="books.php">Books</a></li>
    <li><a href="leaderboard.php">Leaderboards</a></li>
    <li><a href="general.php">General Discussion</a></li>
    <li><a href="login.php">Login</a></li>
    <li class="selected">Sign Up</li>
    </ul>
</nav>

<?php
  require_once('connectvars.php');

  // Connect to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  if (!$dbc) {
      die("Connection failed: " . mysqli_connect_error());
  }
  if (isset($_POST['submit'])) {
    // Grab the profile data from the POST
    $username = $_POST['username'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    if (!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2)) {
      echo '';
      // Make sure someone isn't already registered using this username
      $query = "SELECT * FROM user WHERE username = '$username'";
      $data = mysqli_query($dbc, $query);
      if (mysqli_num_rows($data) == 0) {
        // The username is unique, so insert the data into the database
        $sql = "INSERT INTO user (username, password, join_date) VALUES ('$username', SHA('$password1'), NOW())";
        if (mysqli_query($dbc, $sql)) {
            echo '';
        } else {
            echo ("Error: " . mysqli_error($dbc));
        }

        // Confirm success with the user
        echo '<p>Your new account has been successfully created. You\'re now ready to <a href="login.php">log in</a>.</p>';

        mysqli_close($dbc);
        exit();
      }
      else {
        // An account already exists for this username, so display an error message
        echo '<p class="error">An account already exists for this username. Please use a different address.</p>';
        $username = "";
      }
    }
    else {
      echo '<p class="error">You must enter all of the sign-up data, including the desired password twice.</p>';
    }
  }
    
  mysqli_close($dbc);
?>

<form method="post" action="signup.php">
      <h1>Create a ReadingAid account!</h1>
      <div id="fields">
          <label for="username">Username:</label><br>
          <input type="text" id="username" name="username" value="<?php if (!empty($username)) echo $username; ?>"><br>
          <label for="password1">Password:</label><br>
          <input type="password" id="password1" name="password1"><br>
          <label for="password2">Password (retype):</label><br>
          <input type="password" id="password2" name="password2">
          <div id="captcha" class="g-recaptcha" data-sitekey="6Lf1V58UAAAAALogQoe6aWDCvaaMboeF63mNd8is"></div>
      </div>
    <input type="submit" value="Sign Up" name="submit" id="submit">
</form>
<?php
    require_once('footer.php');   
?>       
</body> 
</html>
