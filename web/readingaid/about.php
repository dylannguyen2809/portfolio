<!doctype html>
<html>
<header>
    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="about.css">
    <meta charset="utf-8">
    <title>About</title>
</header>
<body>
     <?php
        if(isset($_COOKIE['user_id'])){
    ?>
            <nav>
                <h1><a href="index.php">ReadingAid</a></h1>
                <ul id="navbar">
                <li class="selected">About</li>
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
    <?php } 
    require_once('connectvars.php');
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if (!$dbc) {
      die("Connection failed: " . mysqli_connect_error());
    }
    
    if (isset($_POST['submit'])){
        $first = mysqli_real_escape_string($dbc, $_POST['first']);
        $text = mysqli_real_escape_string($dbc, $_POST['text']);
        $sql = "INSERT INTO feedback (first, text) VALUES ('$first', '$text')";
        if (mysqli_query($dbc, $sql)) {
            echo '';
        } else {
            echo ("Error: " . mysqli_error($dbc));
        }
    }
    
    ?>
    <h1>About</h1>
    <h3>Our Mission</h3>
    <p>Being able to read English is a very important skill for anybody to have. Here at ReadingAid, we are all about helping people to develop their English reading skills. So whether you are a beginner, intermediate or advanced reader, there's always ways you can improve with ReadingAid! This website was created as part of an MYP Personal Project.</p>
    
    <h3>Using the site</h3>
    
    <p>Here, you'll find a collection of <a href="books.php">books</a> for your perousal, from <a href="book.php"><em>The Adventures of Huckleberry Finn</em></a> to Rudyard Kipling's <em>The Jungle Book</em>. Our friendly PDF reader allows you to scroll through the book, as well as specify particular page numbers on which you can skip to. It can't yet remember page numbers, so note down where you get up to! Oh, you can print the file out as well, if you wish!</p>
    
    <p>We have a Vocabulary Notebook feature, which allows you to keep track of the words that you need to learn from each book. Just write in the word and its definition, and click "Add." Once you are confident in using a word, you can remove it from your Vocabulary Notebook by selecting the word's corresponding "Learnt" button and pressing "Remove Learnt."</p>
    
    <p>In our <a href="general.php">General Discussion</a> section, we give users an opportunity to interact with each other outside of a literary context - after all, it is important to socialise and enjoy being within an online community.</p>
    
    <p>Remember to create an account to keep track of your progress! Our customised dashboards will give you an opportunity to track your learning, as well as edit your bio for others to see. You get one point for each new book read. The more points you get, the higher up you will be on the <a href="leaderboard.php">Leaderboard</a>.</p>
    
    <h3>Copyright</h3>
    <p>All of the books published on this site are public domain books, meaning that their copyright has expired and that they are free for the public to read, use and redistribute.</p>
    
    <p>Happy Reading!</p>
    <p>Dylan</p>

    <form method="post" action="about.php">
        <h3>Contact</h3>
        <p>We'd love your feedback!</p>
        <p>First Name: <input type="text" name="first"></p>
        <textarea rows="10" cols="80" name="text"></textarea><br>
        <input type="submit" name="submit" value="Submit!">
    </form>
    
<?php
    require_once('footer.php');   
?>  