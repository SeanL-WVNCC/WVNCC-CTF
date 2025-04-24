Mobile Deposit Documentation

Line 9: Includes the php file "functions.php" that contains a number of functions to help the site run correctly

Line 11-13: Creates empty text variables $mainContent, $error, and $status to be used later in page

Line 15-71 If statement for if the request to the server is equal to a POST
The if statement catches the submit from the user and starts the runnning of the code determining if the file is able to be uploaded. 

Line 18: Sets variable $fileSizeLimitByte that contains the suggested file size limit for files to be under the agreed Denial of Service limit in bytes.(15000000 bytes = 15mb)

Line 19: Sets variable $maxFileSize that sets the maximum file size that the server will allow the user to upload. Any higher will inform user that they accomplished a DOS attack, but the file cannot be upload.

Line 20: Sets Variable $fileSizeLimitMB that calculates the bytes into mb for easier reading

Line 23: Sets variable $fileUploadDirectory that sets the upload end location.

Line 26: Sets variable $filename equal to the file name from user submitted file.

Line 27: Sets variable $fileSize equal to the file size of the user submitted file.

Line 28: Sets variable $tmpFilename equal to the temp name assigned to the user submitted file.

Line 31: Sets variable $targetFile equal to variable $fileUploadDirectory concatenated with the trailing name component of the path of the user submitted file.

Line 32: Sets $strFileName equal to the trailing name component of the path of the user submitted file that has been sanitized with htmlspecialchars to turn any qualifying special characters into HTML.

Line 35: Sets bool $fileIsTooLarge equal to whether the variable $fileSize is greater than the variable $fileSizeLimitByte (Default is 15mb).

Line 36: Sets bool $fileIsWayTooLarge equal to whether the variable $fileSize is greater than the variable $maxFileSize(Default is 50mb).

Line 37-38: If statement for if the boolean $useFileSizeLimit is true which enables the file size limit, as well as if the variable $fileIsTooLarge is equal to true. If both are true, the variable $error will be set to "Sorry, the max file size is ". $fileSizeLimitMB ."MB" and will be displayed to the user. 

Line 39-41: elseif statement for if the boolean $useFileSizeLimit is false which disables the file size limit, as well as if the variable $fileIsTooLarge is equal to true. If only the $fileIsTooLarge is true, the variable $error will be set to "Congrats! You have pulled off a DOS attack! Your file was way too big, pal!" and will be displayed to the user and the execution of the page is put to sleep for 10 seconds. 

Line 42-44: elseif statement for if the boolean $useFileSizeLimit is false which disables the file size limit, as well as if the variable $fileIsWayTooLarge is equal to true. If only the $fileIsTooLarge is true, the variable $error will be set to "Congrats! You pulled off a DOS attack, but it was way too big for our page! So you get some extra credit!" and will be displayed to the user and the execution of the page is put to sleep for 20 seconds. 

Line 48-61: if statement for if the variable $strFileName does not equal an empty text, then the following if statements will run
    Line 49: If the $strFileName contains the text "png", if so, then no error message will be displayed.
    Line 52: ElseIf the $strFileName contains the text "jpg", if so, then no error message will be displayed.
    Line 55:ElseIf the $strFileName contains the text "jpeg", if so, then no error message will be displayed.
    Line 58: else statement for if $strFileName does not contain any of the previous file extensions, sets $error to equal 'File must contain jpg, png, or jpeg "' . $strFileName . '" does not.' and displays it to user.

Line 63-70: if statement for if $error equals empty text, which means that no errors were detected and the file can be uploaded.
    Line 64-65: if statement for if the $targetFile is equal to the $tmpFilename given to the uploaded file. If so, sets $status to "The file ". htmlspecialchars(basename($filename))." has been uploaded at <code>".$fileUploadDirectory."</code>" and displays it to the user to inform them that the file has successfully uploaded. 
    Line 66-68: if previous if statement returns false, displays error code and sets $status to "Our systems were unable to process your check photo, but we don't know why. Try reloading the page and re-attaching the photo." and displays to the user.

Line 73-92: Uses SimpleFormField class from formgen.php to create a new SimpleForm object called $mobileDepositForm with a name of "Mobile Check Deposit" and input type of "file". Instructions on how to use form and other text are provided for the user as well. Set value is set to blank text. Form is required to be filled out to be submitted. 

Form action is set to mobile-deposit.php, so the submit will not take a user to a new page unless there is certain errors.

Line 94: Adds the variable $status to the instructions section of the form to be able to inform user on whether or not file uploads correctly. 

Line 97: Adds $mobileDepositForm to $mainContent and echos function generatePage($mainContent) to display content to page.
