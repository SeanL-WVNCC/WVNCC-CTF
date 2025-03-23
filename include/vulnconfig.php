<?php
/*
    vulnconfig.php
    Flags that enable/disable vulnerabilities.
*/

$isVulnerableToPathTraversal        = false;  // FIXME: Currently broken, reimplementation required.
$isVulnerableToReflectedXss         = true;  // Applies to the search and login pages.
$isVulnerableToUserEnum             = true;
$isVulnerableToSqlInjection         = true;
$hideReflectionWithTransparentText  = true;  // Hides reflected user input that has been echo'd onto the DOM
$useFileSizeLimit                   = True; // Enables file size liming for file uploads
$fileTypeRestriction                = False; // Restricts types of files that may be uploaded

function perhapsHideReflected(string $payload) {
    global $hideReflectionWithTransparentText;
    return $hideReflectionWithTransparentText ? "<span class=\"hidden-reflected-user-input\">$payload</span>" : $payload;
}