<?php
/*
    layout.php
    Simple HTML layouts.
*/

function presentationalWrapper(string $content) {
    return "<div role=\"presentation\">$content</div>";
}
function singleColumnLayout(string $content) {
    return "<div class=\"single-column\" role=\"presentation\">$content</div>";
}
function twoColumnLayout(string $left, string $right) {
    return "<div class=\"two-column\" role=\"presentation\">$left$right</div>";
}