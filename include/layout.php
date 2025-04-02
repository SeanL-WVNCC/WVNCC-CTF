<?php
/*
    layout.php
    Simple HTML layouts.
*/

function presentationalWrapper(string $content) {
    return "<div role=\"presentation\">$content</div>";
}

/**
 * Wraps the supplied HTML with a div having class `single-column`.
 */
function singleColumnLayout(string $content) {
    return "<div class=\"single-column\" role=\"presentation\">$content</div>";
}
/**
 * Wraps the supplied HTML with a div having class `two-column`.
 */
function twoColumnLayout(string $left, string $right) {
    return "<div class=\"two-column\" role=\"presentation\">$left$right</div>";
}