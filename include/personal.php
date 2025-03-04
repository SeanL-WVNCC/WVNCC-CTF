<main id="main">
    <section id="personal-header">
        <h2>You've come to the right place for all of your personal finance needs</h2>
        <p>Blurb about special offers</p>
        <button id="personal-button">Learn More</button>
    </section>
    <!--I wasn't sure what to name this section-->
    <section id="personal-banking">
        <h2>More Personal Banking Help & Offers</h2>
        <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Viverra commodo tempus facilisis leo cras vivamus fusce.
            Lorem ipsum odor amet, consectetuer adipiscing elit. Viverra commodo tempus facilisis leo cras vivamus fusce.
            Lorem ipsum odor amet, consectetuer adipiscing elit. Viverra commodo tempus facilisis leo cras vivamus fusce.
        </p>
    <!--High(?) security search, can be broken using JavaScript if I've read correctly-->
    <section id="personal-search">
        <form method="POST">
        <h2>Search 🔎</h2>
            <input type="text" id="high-search" name="high-search" required>
            <input type="submit" id="high-submit" name="high-submit" value="Search">
        </form>
        <?php 
        if (isset($_POST["high-submit"])) {
            $search = htmlspecialchars($_POST["high-search"]);
            $result = "Search Result: " . $search;
            echo $result;
        }
        ?>
    </section>
</main>
