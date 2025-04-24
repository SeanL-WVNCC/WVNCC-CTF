Loan Application Documentation

2: Includes functions.php that contains functions for the execution of the page.

3: Starts session and sets variable $user equal to the current user with function getCurrentUser().

4-7: If statement that sets variable $userIdFieldHiddenValue equal to userId stored inside of $user object.

10-83 Create new SimpleForm object from formgen.php assigned to variable $loanApplicationForm:
    Adds multiple input spots for user information as well as a hidden input that uses the $userIdFieldHiddenValue variable. 
        Field: user-id, type: Hidden, Value: $userIdFieldHiddenField
        Field: fullname, type: text, Value: User Input
        Field: ssNumber, type: number, Value: User Input
        Field: accountNumber, type: number, Value: User Input
        Field: annualIncome, type: number, Value: User Input
        Field: monthlyHousing, type: number, Value: User Input
    All fields are required to submit.
    Form action is loanApplication.php, so the user will remain on the same page, unless error occurs.

85-93: if statement for whether the server request method is equal to POST
    if so, creates new variable $newApplication that equals a new text file in the loan_applications folder. The text file is the username value is the $user object concatanated with the text "LoanApplication.txt".
    88: Creates variable $userData that contains POST information for user fullname and ssNumber
    89: Creates variable $financialData that contains POST information for user accountNumber, annualIncome, and monthlyHousing
    90: Uses fwrite function to write $userData to $newApplication
    91: Uses fwrite function to write $financialData to $newApplication
    92: Uses fclose function to finish writing process for $newApplication file
    93: Sets form instructions to "<p>Your loan application has been successfully submitted at loan_applications/</p>" informing user of successful submit

95: Creates variable $mainContent and sets to blank text
96: Adds $loanApplicationForm to $mainContent
97: echos generatePage($mainContent) to display content to page