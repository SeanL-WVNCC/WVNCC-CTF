<header>
    <a id="skip-link" href="#main">Skip to content</a>
    <h1><img src="./img/logo.png" alt="Northern Phish and Loan"></h1> <!-- This was a link, removed to reduce unnecessary tab stops -->
    <nav id="primary-navigation" aria-label="Site Navigation">
        <ul>
            <?php
            echo "<li><a href=\"index.php?page=include/home.php\">Home</a></li>";
            echo "<li><a href=\"index.php?page=include/about.php\">About Us</a></li>";
            echo "<li><a href=\"index.php?page=include/feedback.php\">Feedback</a></li>";
            if(isset($_COOKIE["is-logged-in"])) {
                echo "<li><a href=\"index.php?page=include/new-account.php\">Open account</a></li>";
                echo "<li><a href=\"index.php?page=include/transfer.php\">Funds transfer</a></li>";
                echo "<li><a href=\"index.php?page=include/profile.php\">Profile</a></li>";
                echo "<li><a href=\"index.php?page=include/mobile-deposit.php\">Mobile deposit</a></li>";
                echo "<li><a href=\"index.php?page=include/dashboard.php\">Dashboard</a></li>";
            } else {
                echo "<li><a href=\"index.php?page=include/login.php\">Login</a></li>";
                echo "<li><a href=\"index.php?page=include/register.php\">Signup</a></li>";
            }
            ?>
        </ul>
    </nav>
</header>
