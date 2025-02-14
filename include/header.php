<header>
    <a id="skip-link" href="#main">Skip to content</a>
    <div>
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
    </div>
    <nav id="secondary-navigation" aria-label="Our Accounts">
        <ul>
            <li><a href="index.php?page=include/checking.php">Checking</a></li>
            <li><a href="index.php?page=include/savings.php">Savings &amp; CDs</a></li>
            <li><a href="index.php?page=include/credit-cards.php">Credit Cards</a></li>
            <li><a href="index.php?page=include/personal.php">Personal</a></li>
            <li><a href="index.php?page=include/business.php">Business</a></li>
            <li><a href="index.php?page=include/financial-education.php">Financial Education</a></li>
        </ul>
    </nav>
</header>
