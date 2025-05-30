<?php
/*
    vulnconfig.php
    Flags that enable/disable vulnerabilities.
*/

$isVulnerableToPathTraversal        = false; // FIXME: Currently broken, reimplementation required.
$isVulnerableToReflectedXss         = true;  // Applies to the search and login pages.
$isVulnerableToUserEnum             = true;
$isVulnerableToSqlInjection         = true;
$isVulnerableStoredXss              = true;  // Appears on the account dashboard in the account nickname field.
$hideReflectionWithTransparentText  = true;  // Hides reflected user input that has been echo'd onto the DOM
$useFileSizeLimit                   = False; // Enables file size liming for file uploads
$fileTypeRestriction                = True;  // Restricts types of files that may be uploaded
$permittedFileTypes                 = array("jpeg", "png", "jpg"); // For mobile check deposit

function perhapsHideReflected(string $payload) {
    global $hideReflectionWithTransparentText;
    return $hideReflectionWithTransparentText ? "<span class=\"hidden-reflected-user-input\">$payload</span>" : $payload;
}

enum XssType {
    case REFLECTED;
    case STORED;
}

/**
 * Sanitizes user input to prevent XSS... Sometimes.
 * @param string $payload The user input to sanitize.
 * @param XssType $xssType The type of XSS to (sometimes) protect against.
 * @return string "Sanitized" version of the payload.
 */
function perhapsSanitizeAgainstXss(string $payload, XssType $xssType): string {
    global $isVulnerableStoredXss;
    global $isVulnerableToReflectedXss;
    $doSanitize = false;
    if(!$isVulnerableToReflectedXss && ($xssType == XssType::REFLECTED)) {
        $doSanitize = true;
    }
    if(!$isVulnerableStoredXss && ($xssType == XssType::STORED)) {
        $doSanitize = true;
    }

    if($doSanitize) {
        return htmlspecialchars($payload);
    } else {
        return $payload;
    }
}

function filenameIsPermitted(string $filename): bool {

    global $permittedFileTypes;
    global $fileTypeRestriction;
    if(!$fileTypeRestriction) {
        return true;
    }
    foreach($permittedFileTypes as $fileType) {
        if(str_contains($filename, $fileType)) {
            return true;
        }
    }
    return false;
}