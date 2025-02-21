<main id="main">
    <section id="business-header">
        <h2>We're the single most secure bank for your business!</h2>
        <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Viverra commodo tempus facilisis leo cras vivamus fusce. Donec leo interdum nullam aptent cubilia ac nunc.</p>
        <button id="business-info">Learn More</button>
    </section>
    <section id="to-client-offer">
        <h2>We will help you out. Nothing ever breaks here.</h2>
        <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Viverra commodo tempus facilisis leo cras vivamus fusce. Donec leo interdum nullam aptent cubilia ac nunc.
            Lorem ipsum odor amet, consectetuer adipiscing elit. Viverra commodo tempus facilisis leo cras vivamus fusce. Donec leo interdum nullam aptent cubilia ac nunc.
        </p>
    </section>
    <!--Medium security search-->
    <section id="business-search">
        <form method="POST">
        <h2>Search 🔎</h2>
            <input type="text" id="med-search" name="med-search" required>
            <input type="submit" id="med-submit" name="med-submit" value="Search">
        </form>
        <?php 
        if (isset($_POST["med-submit"])) {
            //this should still be decently easy to break if I'm understanding correctly
            $search = str_replace([";", "'", "../"], " ", $_POST["med-search"]);
            $result = "Search Result: " . $search;
            echo $result;
        }
        ?>
    </section>
</main>
