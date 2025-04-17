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

/**
 * Wraps the supplied HTML with a div having class `three-column`.
 */
function threeColumnLayout(string $left, string $center, string $right) {
    return "<div class=\"three-column\" role=\"presentation\">$left$center$right</div>";
}

/**
 * Returns HTML markup for a banner with a title and subtitle.
 */
function createBanner(string $title, string $subtitle, string $backgroundImageUrl): string {
    
    $html = "<div id=\"banner\" role=\"presentation\">";
    $html .= "<hgroup>";
    $html .= "<h1>$title</h1>";
    if($subtitle) {
        $html .= "<p>$subtitle</p>";
    }
    $html .= "</hgroup>";
    $html .= "<img src=\"$backgroundImageUrl\" role=\"presentation\" alt=\"\">";
    $html .= "</div>";

    return $html;
}