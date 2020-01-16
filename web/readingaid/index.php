<!doctype html>
<html>
<header>
     <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="index.css">
    <meta charset="utf-8">
    <title>ReadingAid - Online ESL Book Club!</title>
</header>
<body>
     <?php
        if(isset($_COOKIE['user_id'])){
    ?>
            <nav>
                <h1 class="selected">ReadingAid</h1>
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
    <?php } ?>

    <div id="splash">
        <h1>"Learning another language is not only learning different words for the same things, but learning another way to think about things."</h1>
        <h3>- Flora Lewis, journalist</h3>
    </div>
    <div id="container">
        <div id="aside">
                <div id="poll">
                    <h1>Poll</h1>
                    <p>Vote for next month's book:</p>
                    <p id="choice1">Macbeth Votes: 0</p>
                    <p id="choice2">Moby Dick votes: 0</p>
                    <button onclick="add1()">Vote for Macbeth!</button>
                    <button onclick="add2()">Vote for Moby Dick!</button>
                    <script>
                        var vote1 = 0;
                        var vote2 = 0;
                        
                        function add1(){
                            vote1++;
                            var choice1 = document.getElementById("choice1");
                            choice1.innerHTML = "Macbeth Votes: " + vote1;
                        }
                        
                        function add2(){
                            vote2++;
                            var choice2 = document.getElementById("choice2");
                            choice2.innerHTML = "Moby Dick Votes: " + vote2;
                        }
                    </script>
                </div>
                <div id="leaderboards">
                    <h1><a href="leaderboard.php">Leaderboards</a></h1>
                    <p>Find out who's the best!</p>
                </div>
                <div id="general">
                    <h1>General discussion</h1>
                    <p>Join the <a href=general.php>General Discussion!</a></p>
                </div>
        </div>
        <div id = "main">
        <h1>A place for learning and growing</h1>
        <p>Welcome to ReadingAid! We're so glad to have you here. This is a place where English language learners can come to read and discuss books, improve their vocabulary, and chat with other learners about a whole host of different topics!</p>
        
        <p>As you can probably see, we have a whole variety of sites for you to visit. To get started, I would recommend that you <a href="signup.php">Sign Up</a> for an account - it's quick, easy, and gives you the ability to be on the Leaderboard! Once you do, it will take you to a Dashboard where you can view your profile information.</p>
            
        <p>In your Dashboard, you will see a Points section. To gain points, all you have to do is read books on the site! You will get one point for each new book that you read. I would recommend that you take a look at our <a href="books.css">Book List</a> and pick a book that tickles your fancy.</p>
        
        <img src="images/sharon-mccutcheon-532782-unsplash.jpg" alt="book stack" width="300px" height="200px">
        </div>
        
    </div>
    <script type="text/javascript">
        var pics = ["iam-se7en-657490-unsplash.jpg", "susan-yin-647448-unsplash.jpg", "thought-catalog-575829-unsplash.jpg"]
        var counter = 0;
        var change = setInterval(changePicture, 5000);
        function changePicture() {
            console.log("images/" + pics[counter]);
            var elem = document.getElementById("splash");
            splash.style.backgroundImage = 'url(images/' + pics[counter]+')';
            counter++;
            if (counter > 2) {
                counter = 0;
            }
        }
    
    </script>
<div id="footer">
    <p> &copy; 2019, Dylan Nguyen<br>
      All trademarks and registered trademarks appearing on this site are 
      the property of their respective owners.</p>
      <div id="google_translate_element"></div>

        <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL}, 'google_translate_element');
        }
        </script>

        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</div>
</body>
</html>