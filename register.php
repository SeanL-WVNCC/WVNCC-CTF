<!DOCTYPE html>
<html lang="en">
    <?php include "include/head.php" ?>
    <body>
        <?php include "include/header.php" ?>
        <!--Typical bank website elements-->
        <main>
            <form aria-labelledby="register-heading">
                <h2 id="register-heading">Register</h2>
                <label for="username-field">Username</label>
                <input id="username-field" type="text" name="username" required>
                <label for="password-field">Password</label>
                <input id="password-field" type="password" name="password" required>
                <button type="submit">Login</button>
            </form>
        </main>
        <?php include "include/footer.php" ?>
    </body>
</html>
