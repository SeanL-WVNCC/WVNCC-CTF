<html lang="en">
    <?php include "include/head.php" ?>
    <body>
        <?php include "include/header.php" ?>
        <main>
            <p>Hello, World!</p>
            <p>This is the registration page.</p>
            <form aria-labelledby="register-heading">
                <h2 id="register-heading">Register</h2>
                <label for="username-field">Username</label>
                <input id="username-field" type="text" name="username" required>
                <label for="password-field">Password</label>
                <input id="password-field" type="password" name="password" required>
                <button type="submit">Login</button>
            </form>
        </main>
        <footer>
            <p>This website is a service of West Virginia Northern Community College.</p>
        </footer>
    </body>
</html>