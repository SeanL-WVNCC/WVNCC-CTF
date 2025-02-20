<main id="main">
    <section id="financial-heading">
        <h2>Want to learn more about finance?</h2>
        <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Viverra commodo tempus facilisis leo cras vivamus fusce. Donec leo interdum nullam aptent cubilia ac nunc. 
            Etiam semper quisque pulvinar volutpat hendrerit consectetur. Convallis auctor finibus eleifend orci aptent felis. Mi litora ridiculus; suspendisse nostra parturient nisi mattis. Porta pharetra tempor accumsan fermentum per ligula metus. 
            Lorem aliquet cras felis nascetur phasellus odio. Sapien mus penatibus, aliquam iaculis cras imperdiet. Montes vel condimentum nunc penatibus egestas turpis porttitor.</p>
    </section>
    <!--Zero security search / XSS if I understand correctly -Angela-->
    <section id="financial-search">
        <form method="POST">
        <h2>Search 🔎</h2> <!--Feel free to remove these emojis if either of you want to, I put it there for fun -Angela-->
            <input type="text" id="insecure-search" name="insecure-search" required>
            <input type="submit" id="insecure-submit" name="insecure-submit" value="Search">
        </form>
        <?php 
        if (isset($_POST["insecure-submit"])) {
            $search = "Search Result: " . $_POST["insecure-search"];
            echo $search;
        }
        ?>
    </section>
</main>
