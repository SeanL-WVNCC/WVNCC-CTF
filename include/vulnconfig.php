<?php
// Flags that enable/disable vulnerabilities.

$isVulnerableToPathTraversal = True;  // FIXME: Currently broken, reimplementation required.
$isVulnerableToReflectedXss  = True;  // Applies to the search and login pages.
$fileSizeLimit = false;               // Enables file size liming for file uploads
$fileTypeRestriction = false;         // Restricts types of files that may be uploaded