<!doctype html>
<html>
<header>
    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="dashboard.css">
    <meta charset="utf-8">
    <title>Dashboard</title>
</header>
<body>
    <?php
        if(isset($_COOKIE['user_id'])){
    ?>
            <nav>
                <h1><a href="index.php">ReadingAid</a></h1>
                <ul id="navbar">
                <li><a href="about.php">About</a></li>
                <li><a href="books.php">Books</a></li>
                <li><a href="leaderboard.php">Leaderboards</a></li>
                <li><a href="general.php">General Discussion</a></li>
                <li class="selected">Dashboard</li>
                <li><a href="logout.php">Log Out</a></li>
                </ul>
            </nav>
    <?php
        } else {
    ?>
    <nav>
            <h1><a href="index.php">ReadingAid</a></h1>
            <ul id="navbar">
            <li><a href="about.php">About</a></li>
            <li><a href="books.php">Books</a></li>
            <li><a href="leaderboard.php">Leaderboards</a></li>
            <li><a href="general.php">General Discussion</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="signup.php">Sign Up</a></li>
            </ul>
    </nav>
    <h1>Log In to access this feature!</h1>
    <?php
        }
    //Connect to the database
    require_once('connectvars.php');
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if (!$dbc) {
      die("Connection failed: " . mysqli_connect_error());
    }
    
    if(isset($_POST['submit'])){
        $update = mysqli_real_escape_string($dbc, $_POST['bio']);
        $sql = "UPDATE user SET info = '$update' WHERE user_id = '" . $_COOKIE['user_id'] . "'";
        if (mysqli_query($dbc, $sql)){
            echo '';
        } else {
            echo ("Error: " . mysqli_error($dbc));
        }
    }
    // Query to get the total results 
    $query = "SELECT * FROM user WHERE user_id = '".$_COOKIE['user_id']."'";
    $result = mysqli_query($dbc, $query);
    $total = mysqli_num_rows($result);

    if (mysqli_query($dbc, $query)) {
            $row = mysqli_fetch_array($result);
            $username = $row['username'];
            $score = $row['score'];
            $firstname = $row['firstname'];
            $join = $row['join_date'];
            $surname = $row['surname'];
            $info = $row['info'];
            
            echo ('<div id="splash"><h1>Hello, ' . $username . '!</h1></div>');
            echo ('
            <form method="post" action="dashboard.php">
                <h2>About You!</h2>
                <p>Tell us about yourself! What is your favourite book? Who is your favourite author?</p>
                <textarea id="bio" name="bio" rows="15" cols="50">' . $info . '</textarea>
                <input type="submit" id="submit" value="Update!" name="submit">
            </form>');
            echo ('<div id="score"><h2>Your score is: ' . $score . '</h2><p>Improve it by reading more books - you get one point for each new book you read! This months book is <a href="book.php">The Adventures of Huckleberry Finn</a></p></div>');
           
    } else {
        echo ("Error: " . mysqli_error($dbc));
    }
    
    mysqli_close($dbc);
        
    ?>
<?php
    require_once('footer.php');   
?>       
    </body>
</html>