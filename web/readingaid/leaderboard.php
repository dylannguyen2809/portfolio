<!doctype html>
<html>
<header>
    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="leaderboard.css">
    <meta charset="utf-8">
    <title>Leaderboards</title>
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
                <li class="selected">Leaderboards</li>
                <li><a href="general.php">General Discussion</a></li>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="logout.php">Log Out</a></li>
                </ul>
            </nav>
             <h1>Leaderboards</h1>
            <h3>Check out the best readers!</h3>
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
    <h1>Leaderboards</h1>
    <h3>Check out the best readers!</h3>
    <?php
        }
    //Connect to the database
    require_once('connectvars.php');
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if (!$dbc) {
      die("Connection failed: " . mysqli_connect_error());
    }

    // Start generating the table of results
    echo '<table>';
    echo '<tr class="heading">';
    echo '<th>Score</th>';
    echo '<th>Username</th>';
    echo '<th>Info</th>';
    echo '</tr>';

    // Query to get the total results 
    $query = "SELECT * FROM user ORDER BY score DESC";
    $result = mysqli_query($dbc, $query);
    $total = mysqli_num_rows($result);

    if (mysqli_query($dbc, $query)) {
            while ($row = mysqli_fetch_array($result)) {
                echo '<tr class="results">';
                echo '<td valign="top" width="20%">' . $row['score'] . '</td>';
                echo '<td valign="top" width="30%">' . $row['username'] . '</td>';
                echo '<td valign="top" width="50%">' . $row['info'] . '</td>';
                echo '</tr>';
            } 
            echo '</table>';
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