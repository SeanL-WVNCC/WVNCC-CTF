<?php
setcookie('is-logged-in', '', -1, '/');
setcookie('logged-out-user', '', -1, '/');
header("Location: /");