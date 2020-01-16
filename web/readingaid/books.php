<!doctype html>
<html>
<header>
    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="books.css">
    <meta charset="utf-8">
    <title>Book List</title>
</header>
<body>
    <?php
    require_once('connectvars.php');
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if (!$dbc) {
      die("Connection failed: " . mysqli_connect_error());
    }
        if(isset($_COOKIE['user_id'])){
            $query = "SELECT score FROM user WHERE user_id = '".$_COOKIE['user_id']."'";
            $data = mysqli_query($dbc, $query);
            $row = mysqli_fetch_array($result);
            $newscore = $row['score'] + 1;
            $sql = "UPDATE user SET score = '$newscore' WHERE user_id = '".$_COOKIE['user_id']."'";
            if (mysqli_query($dbc, $sql)) {
                echo '';
            } else {
                echo ("Error: " . mysqli_error($dbc));
            }
          
        mysqli_close($dbc);
    ?>
            <nav>
                <h1><a href="index.php">ReadingAid</a></h1>
                <ul id="navbar">
                <li><a href="about.php">About</a></li>
                <li><a href="books.php">Books</a></li>
                <li><a href="leaderboard.php">Leaderboards</a></li>
                <li><a href="general.php">General Discussion</a></li>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="logout.php">Log Out</a></li>
                </ul>
            </nav>
            <h1>Available Titles</h1>
            <h3>Take a look at the available books!</h3>
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
    <h1>Available Titles</h1>
    <h3>Take a look at the available books!</h3>
<?php
        }
  // This function builds a search query from the sort setting
  function build_query($user_search, $sort) {
    $search_query = "SELECT * FROM book";

    // Sort the search query using the sort setting
    switch ($sort) {
    // Ascending by title
    case 1:
      $search_query .= " ORDER BY title";
      break;
    // Descending by title
    case 2:
      $search_query .= " ORDER BY title DESC";
      break;
    // Ascending by author
    case 3:
      $search_query .= " ORDER BY author";
      break;
    // Descending by author
    case 4:
      $search_query .= " ORDER BY author DESC";
      break;
    // Ascending by year
    case 5:
      $search_query .= " ORDER BY year";
      break;
    // Descending by year
    case 6:
      $search_query .= " ORDER BY year DESC";
      break;
    default:
    }

    return $search_query;
  }

  // This function builds heading links based on the specified sort setting
  function generate_sort_links($user_search, $sort) {
    $sort_links = '';

    switch ($sort) {
    case 1:
      $sort_links .= '<th><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=2">Book Title</a></th><th>Description</th>';
      $sort_links .= '<th><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=3">Author</a></th>';
      $sort_links .= '<th><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=5">Year</a></th>';
      break;
    case 3:
      $sort_links .= '<th><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=1">Book Title</a></th><th>Description</th>';
      $sort_links .= '<th><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=4">Author</a></th>';
      $sort_links .= '<th><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=3">Year</a></th>';
      break;
    case 5:
      $sort_links .= '<th><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=1">Book Title</a></th><th>Description</th>';
      $sort_links .= '<th><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=3">Author</a></th>';
      $sort_links .= '<th><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=6">Year</a></th>';
      break;
    default:
      $sort_links .= '<th><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=1">Book Title</a></th><th>Description</th>';
      $sort_links .= '<th><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=3">Author</a></th>';
      $sort_links .= '<th><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=5">Year</a></th>';
    }

    return $sort_links;
  }

  // Grab the sort setting and search keywords from the URL using GET
  $sort = $_GET['sort'];

  // Start generating the table of results
  echo '<table>';
  echo '<tr class="heading">';
  echo generate_sort_links($user_search, $sort);
  echo '</tr>';

  // Connect to the database
  require_once('connectvars.php');
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  if (!$dbc) {
      die("Connection failed: " . mysqli_connect_error());
  }
  // Query to get the total results 
  $query = build_query($user_search, $sort);
  $result = mysqli_query($dbc, $query);
  $total = mysqli_num_rows($result);

  if (mysqli_query($dbc, $query)) {
            while ($row = mysqli_fetch_array($result)) {
                echo '<tr class="results">';
                echo '<td valign="top" width="20%">' . $row['title'] . '</td>';
                echo '<td valign="top" width="50%">' . $row['description'] . '</td>';
                echo '<td valign="top" width="20%">' . $row['author'] . '</td>';
                echo '<td valign="top" width="10%">' . $row['year'] . '</td>';
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