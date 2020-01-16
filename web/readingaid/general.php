<!doctype html>
<html>
<header>
    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="general.css">
    <meta charset="utf-8">
    <title>General Discussion</title>
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
                <li class="selected">General Discussion</li>
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
    <?php } ?>
    <h1>General Discussion</h1>
    <div id="disqus_thread"></div>
    <script>
        /**
        *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
        *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/

        var disqus_config = function () {
            this.page.url = "http://www.dylannguyen.site/pp/general.php";  // Replace PAGE_URL with your page's canonical URL variable
            this.page.identifier = "general"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };

        (function() { // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');
        s.src = 'https://www-dylannguyen-site-pp-general-php.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
</body>
<?php
    require_once('footer.php');
?>