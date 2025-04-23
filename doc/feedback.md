Feedback Documentation 

2: Includes functions.php that contains functions for basic webpage execution

3-9: Creates variable $banner and sets it to contain header content

10-11: Creates variable $mainContent and adds HTML to define the following form in a section id of "feedbackField" and class of "single-column"

12: Creates variable $user and sets it to return of function getCurrentUser()

13-16: if statement that sets the variable $userIdFieldHiddenValue equal to the userId value of the $user object if $user exists. Otherwise, sets the value to blank text.

18-92 Creates new SimpleForm object from formgen.php with the variable name $feedbackForm with the following fields
    field: user-id, Type: hidden, Default Value: $userIdFieldHiddenValue
    field: first-name, Type: text, Value: User Input
    field: last-name, Type: text, Value: User Input
    field: email, Type: email, Value: User Input
    field: subject, Type: text, Value: User Input
    field: feedback, Type: textarea, Value: User Input

    Form action is feedback.php, so user will remain on page after submit, unless an error occurs

93: Adds $feedbackForm to $mainContent

96-107: if statement whether $user is valid
    if true, if statement whether server request method is equal to POST 
        98-100: if true, sets $user, $date, $feedback to data from the user submit
        101: Sets variable $reviewData to HTML content as well as the $user, $feedback, and $date variables
        102: Uses file_put_contents("reviews/Reviews.txt", $reviewData, FILE_APPEND) to add the current user feedback to the file Reviews.txt in the reviews folder. (FILE_APPEND stops the overwrite of the file)
    if true, if statement whether Reviews.txt is a file and whether the $user is an admin
        if true, the contents of Reviews.txt are displayed to the page
    if false, takes the user back to the login page

112: echos generatePage($banner . $mainContent) to display the $banner and the $mainContent to the page