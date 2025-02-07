# Major Project Milestones
The following is a tentative roadmap for the project. Dates and functionality subject to change.

## Pre-alpha
January 28th - February 6th
Create the foundation of the codebase. (DONE)
* Initialize repository
* Create `index.php`

## Alpha 0.1 - Site mockup pages complete
February 6th - February 10th
The site is filled with mockup pages for most/all of the major functions.
* Home
* Login/registration
* Edit/close account
* Check mobile deposit (file upload)
* Funds transfer

## Alpha 0.2 - Account login/registration
February 10th - March 3rd
Users can create accounts and log into them.
* SQL injection
* Cleartext passwords
* User enumeration
* No session expiration
* Predictable session cookies
* Error-based SQL injection
* Reflection XSS
* Backdoor password

## Alpha 0.3 - Account management
March 3rd - March 10th
Users can manage or delete details of their accounts.
* SQL injection 
* No CSRF tokens
* Parameter tampering
* Error-based SQL injection
* Reflection XSS

## Alpha 0.4 - View transactions
March 10th - March 24th
The application is filled with dummy users and transactions. When logged in, users can view their transaction history.
* SQL injection
* Parameter tampering
* Error-based SQL injection
* Reflection XSS
* Timing-based attack?

## Alpha 0.5 - Transfer funds
March 24th - April 7th
Users can send funds to other accounts.
* SQL injection 
* No CSRF tokens
* Parameter tampering
* Error-based SQL injection
* Reflection XSS

## Alpha 0.6 - Mobile check deposit
April 7th - April 28th
Users can upload a picture of a check and deposit it remotely. Exact vulnerabilities TBD.

## Beta 1.0 - Feature freeze
April 28th - ?
No new features will be added for the semester. The site will be thoroughly tested.