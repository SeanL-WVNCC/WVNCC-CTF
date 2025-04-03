<?php
/*
    about.php
    Static page with information about the company.
*/
session_start();
include "include/functions.php";

$mainContent = "";
$leftColumn = "";
$rightColumn = "";
$mainContent .= "<section id=\"hero-section\" aria-labeledby=\"hero-section-title\">";
$mainContent .= "<hgroup>";
$mainContent .= "<h2 id=\"hero-section-title\">A Timeless Institution</h2>";
$mainContent .= "<p>Seventy Years of Excellence</p>";
$mainContent .= "</hgroup>";
$mainContent .= "<img src=\"img/bank.webp\" alt=\"\">";
$mainContent .= "</section>";
$mainContent .= "<article aria-labeledby=\"northern-phish-history\">";
$leftColumn .= "<h2 id=\"northern-phish-history\">Our story</h2>";
$leftColumn .= "<p>Northern Phish & Loan is a bank that has been committed to serving the Ohio Valley since 1953. When Richard Nixon first founded Northern Phish & Loan, he truly believed that honesty and integrity was the key to success. In the intervening seventy years, we have proven him right. Our reputation for reliability, trust, and personalized service has resulted in Northern Phish becoming the leading bank in the entire Ohio Valley. From our humble beginnings, we’ve grown into a pillar of the community, dedicated to meeting the financial needs of families and businesses alike.</p>";
$leftColumn .= "<p>At Northern Phish & Loan, we believe in putting our customers first. Whether you’re looking for personal banking solutions, business loans, or financial advice, our team is here to guide you every step of the way. We offer a wide range of services, from savings and checking accounts to mortgage and investment options, all designed to help you achieve your financial goals.</p>";
$leftColumn .= "<p>As a locally-owned institution, we understand the unique needs of the Ohio Valley and are proud to be a trusted partner in helping our community thrive. We strive to make banking easy, accessible, and convenient for everyone we serve. Join us at Northern Phish & Loan—where your financial success is our top priority.</p>";
$leftColumn .= "<form action=\"about-nixon.php\" method=\"POST\">";
$leftColumn .= "<input type=\"hidden\" name=\"\" value=\"\"/>";
$leftColumn .= "<input type=\"hidden\" name=\"\" value=\"\"/>";
$leftColumn .= "<button type=\"submit\"/>Learn More About Richard Nixon</button>";
$leftColumn .= "</form>";
$rightColumn .= "<figure>";
$rightColumn .= "<img src=\"img/dick_nixon.jpg\">";
$rightColumn .= "<figcaption>Richard Nixon, founder of Northern Phish &amp; Loan<figcaption>";
$rightColumn .= "</figure>";
$mainContent .= twoColumnLayout(presentationalWrapper($leftColumn), $rightColumn);
$mainContent .= "</article>";
$meetOurTeam = "";
$meetOurTeam .= "<h2>Meet Our Team!</h2>";
$meetOurTeam .= "<table>";
$meetOurTeam .= "<tbody>";
$meetOurTeam .= "<tr>";
$meetOurTeam .= "<td>Angela Ackermann</td>";
$meetOurTeam .= "<td>Director of Threatening SLAPP Lawsuits</td>";
$meetOurTeam .= "</tr>";
$meetOurTeam .= "<tr>";
$meetOurTeam .= "<td>Grant Kent</td>";
$meetOurTeam .= "<td>Director of Incompliance</td>";
$meetOurTeam .= "</tr>";
$meetOurTeam .= "<tr>";
$meetOurTeam .= "<td>Josephine Poulin</td>";
$meetOurTeam .= "<td>Vice President of Elaborate Documentation and Auditing</td>";
$meetOurTeam .= "</tr>";
$meetOurTeam .= "<tr>";
$meetOurTeam .= "<td>Sean Lauritzen II</td>";
$meetOurTeam .= "<td>Associate Director of Operational Strategy Management</td>";
$meetOurTeam .= "</tr>";
$meetOurTeam .= "<tr>";
$meetOurTeam .= "<td>Kevin Hoge</td>";
$meetOurTeam .= "<td>Chief Operator of Perimeter Doorknobs</td>";
$meetOurTeam .= "</tr>";
$meetOurTeam .= "<tr>";
$meetOurTeam .= "<td>Wyatt McNeil</td>";
$meetOurTeam .= "<td>Chancellor of High Interest Loans</td>";
$meetOurTeam .= "</tr>";
$meetOurTeam .= "</tbody>";
$meetOurTeam .= "</table>";
$meetOurTeam .= "<h2>Contact</h2>";
$meetOurTeam .= "<p><a href=\"tel:304-555-1234\" aria-label=\"Call us. 3 0 4. 5 5 5. 1 2 3 4.\">Call Us: 304-555-1234</a></p>";
$meetOurTeam .= "<p>Our Address: 1234 Bank Street, Semaphore, WV</p>";
$meetOurTeam .= "<p><a href=\"mailto:northernphish@email.com\">Email us at: northernphish@email.com</a></p>";
//commenting this out as I meant to make another branch before this in case it breaks anything -- this is what I get for doing this while exhausted. sorry! -Angela
// Nope it didn't break anything, back in it goes! -Sean
$loginForm = new SimpleForm(
    name: "Contact",
    fields: array(
        new SimpleFormField(
            type: "text",
            name: "first-name",
            accessibleName: "First name",
            defaultValue: "",
            options: array(),
            errorMessage: "",
            validationIcon: null,
            autofocus: false,
            isRequired: true
        ),
        new SimpleFormField(
            type: "text",
            name: "last-name",
            accessibleName: "Last name",
            defaultValue: "",
            options: array(),
            errorMessage: "",
            validationIcon: null,
            autofocus: false,
            isRequired: true
        ),
        new SimpleFormField(
            type: "email",
            name: "email",
            accessibleName: "Email",
            defaultValue: "",
            options: array(),
            errorMessage: "",
            validationIcon: null,
            autofocus: false,
            isRequired: true
        ),
        new SimpleFormField(
            type: "text",
            name: "message",
            accessibleName: "Message",
            defaultValue: "",
            options: array(),
            errorMessage: "",
            validationIcon: null,
            autofocus: false,
            isRequired: true
        )
    ),
    instructions: "Or send us a message right here!",
    method: "POST",
    action: "/",
    submitButtonName: "Send"
);
$meetOurTeam .= $loginForm->generateHtml();
$mainContent .= singleColumnLayout($meetOurTeam);
echo generatePage($mainContent);
