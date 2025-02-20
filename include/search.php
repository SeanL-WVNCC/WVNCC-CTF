<?php

echo "<main id=\"main\">";
if(array_key_exists("query", $_GET)) {
    echo "<p>No results found for \"".$_GET["query"]."\"</p>";
}
echo "</main>";