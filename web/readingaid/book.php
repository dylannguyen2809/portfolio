<!doctype html>
<html>
<header>
    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="book.css">
    <meta charset="utf-8">
    <title>Huckleberry Finn</title>
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
    <?php
        echo "Log In to track your progress!";    
    }
    ?>
    
    <div id="aside">
    <div id="preview">
        <p>Mark Twain's <em>The Adventures of Huckleberry Finn</em>, written in 1884, is considered to be one of the greatest literary works of all time. It is set on the Missisippi River, where Twain spent most of his childhood and adolescence. <em>"Huck Finn"</em> explores the theme of slavery, and the tensions and hypocrises that existed within the system at the time. At the start of each chapter, skim the text for 2-3 minutes, and make a prediction about what will happen in the chapter. Record your prediction in the "Notes" section below.</p>
    </div>
    <div id="vocab">
    <h3>Vocabulary Notebook</h3>
    <p>Keep track of which words you have to learn!</p>
    <?php 

    // Connect to the database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if (!$dbc) {
      die("Connection failed: " . mysqli_connect_error());
    }
    if (isset($_POST['add'])) {
    // Grab the word data from the POST
    $word = $_POST['word'];
    $def = $_POST['def'];
    //Make sure info is entered correctly
    if (!empty($word) && !empty($def)) {
      // Make sure word isn't already in database
      $query = "SELECT * FROM word WHERE user_id = '".$_COOKIE['user_id']."' AND word = '$word'";
      $data = mysqli_query($dbc, $query);
      if (mysqli_num_rows($data) == 0) {
        // The word is unique, so insert the data into the database
        $sql = "INSERT INTO word (user_id, word, def) VALUES ('".$_COOKIE['user_id']."', '$word','$def')";
        if (mysqli_query($dbc, $sql)) {
            echo '';
        } else {
            echo ("Error: " . mysqli_error($dbc));
        }
          
        mysqli_close($dbc);
      }
      else {
        // An account already exists for this username, so display an error message
        echo '<p class="error">This word is already in the notebook.</p>';
        $word = "";
      }
    } else {
      echo '<p class="error">You must enter both the word and its definition</p>';
    }
    }
    mysqli_close($dbc);
        
    if (isset($_POST['remove'])) {
        $id = $_POST['id'];
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if (!$dbc) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $query = "DELETE FROM word WHERE id = '$id'";
        if(mysqli_query($dbc, $query)){
            echo "";
        } else {
            echo (mysqli_error($dbc));
        }
        
        
    if (isset($_POST['notes'])) {
        echo 'hi';
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if (!$dbc) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $update = mysqli_real_escape_string($dbc, $_POST['not']);
        echo ($update);
        $sql = "UPDATE user SET notes = '$update' WHERE user_id = '" . $_COOKIE['user_id'] . "'";
        if (mysqli_query($dbc, $sql)){
            echo 'suh dude';
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
            $notes = $row['notes'];
           
    } else {
        echo ("Error: " . mysqli_error($dbc));
    }
        
        mysqli_close($dbc);
    }
    ?>
    
    <?php
        // Connect to the database
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if (!$dbc) {
            die("Connection failed: " . mysqli_connect_error());
        }
        //echo ($_COOKIE['user_id']);

        // Find words in database
        $query = "SELECT * FROM word WHERE user_id = '".$_COOKIE['user_id']."' ";
        $result = mysqli_query($dbc, $query);
        $total = mysqli_num_rows($result);
        echo '<table>';
    ?>
        <tr>
            <th>Word</th>
            <th>Definition</th>
            <th>Learnt?</th>
        </tr>
    <form method="post" action="book.php">
    <?php
        while ($row = mysqli_fetch_array($result)) {
            echo '<tr class="results">';
            echo '<td valign="top" width="30%">' . $row['word'] . '</td>';
            echo '<td valign="top" width="50%">' . $row['def'] . '</td>';
            echo "<td valign='top' width='20%'> <input type='radio' name='id' value =' $row[id]'> </td>";
            echo '</tr>';
        }
        echo '</table>';
        mysqli_close($dbc);
    ?>
        
        <input type="text" id="word" name="word" value="type a word...">
        <input type="text" id="def" name="def" value="and define it!"><br>
        <input type="submit" value="Add" name="add">
        <input type="submit" value="Remove Learnt" name="remove">
        <h2>Notes</h2>
        <p>Note something down...</p>
        <textarea name="not" id="not" rows="5" cols="60"></textarea><br>
        <input type="submit" value="Update" name="notes">
    </form>

</div>
</div>
<iframe src="HuckFinn.pdf"></iframe>
<div id="disqus_thread"></div>
<script>
    /**
    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
    
    var disqus_config = function () {
        this.page.url = "http://www.dylannguyen.site/pp/book.php";  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = "HuckFinn"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://www-dylannguyen-site.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
<?php
    require_once('footer.php');   
?>       
</body>
</html>