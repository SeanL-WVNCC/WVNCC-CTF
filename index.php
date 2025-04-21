<?php
/*
    index.php
    Static page with some promotional content.
*/
session_start();
include "include/functions.php";

$mainContent = "";
$mainContent .= createBanner("Northern Phish &amp; Loan", "The Ohio Valley's Leading Financial Institution", "/img/bank.webp");
$threePilarsSection1 = "<h2>Service</h2>";
$threePilarsSection1 .= "<p>We are committed to only the highest level of customer care. In everything we do, we strive to put the customer first.</p>";
$threePilarsSection2 = "<h2>Reliability</h2>";
$threePilarsSection2 .= "<p>Northern Phish &amp; Loan has always been there for the Ohio valley. Through the good times and the bad, you can always count on us to be there for you when you need it most.</p>";
$threePilarsSection3 = "<h2>Security</h2>";
$threePilarsSection3 .= "<p>With cybercrime as prevalent as ever, Northern Phish&apos;s rock-solid digital security remains just as strong as it always has.</p>";
$mainContent .= presentationalWrapper(threeColumnLayout(presentationalWrapper($threePilarsSection1), presentationalWrapper($threePilarsSection2), presentationalWrapper($threePilarsSection3)));
$leftColumn = "";
$rightColumn = "";
$leftColumn .= "<h2 id=\"northern-phish-history\">Our story</h2>";
$leftColumn .= "<p>Northern Phish &amp; Loan is a bank that has been committed to serving the Ohio Valley since 1953. When Richard Nixon first founded Northern Phish & Loan, he truly believed that honesty and integrity was the key to success. In the intervening seventy years, we have proven him right. Our reputation for reliability, trust, and personalized service has resulted in Northern Phish becoming the leading bank in the entire Ohio Valley. From our humble beginnings, we&apos;ve grown into a pillar of the community, dedicated to meeting the financial needs of families and businesses alike.</p>";
$leftColumn .= "<p>At Northern Phish &amp; Loan, we believe in putting our customers first. Whether you&apos;re looking for personal banking solutions, business loans, or financial advice, our team is here to guide you every step of the way. We offer a wide range of services, from savings and checking accounts to mortgage and investment options, all designed to help you achieve your financial goals.</p>";
$leftColumn .= "<p>As a locally-owned institution, we understand the unique needs of the Ohio Valley and are proud to be a trusted partner in helping our community thrive. We strive to make banking easy, accessible, and convenient for everyone we serve. Join us at Northern Phish &amp; Loan—where your financial success is our top priority.</p>";
$leftColumn .= "<form action=\"about-nixon.php\" method=\"POST\">";
$leftColumn .= "<input type=\"hidden\" name=\"tmp\" value=\"\"/>";
$leftColumn .= "<input type=\"hidden\" name=\"tmp2\" value=\"\"/>";
$leftColumn .= "<button> type=\"submit\"/>Learn More About Richard Nixon</button>";
$leftColumn .= "</form>";
$rightColumn .= "<figure>";
$rightColumn .= "<img src=\"img/dick_nixon.jpg\" alt=\"\">";
$rightColumn .= "<figcaption>Richard Nixon, founder of Northern Phish &amp; Loan</figcaption>";
$rightColumn .= "</figure>";
$mainContent .= twoColumnLayout(presentationalWrapper($leftColumn), $rightColumn);
$siteUpdatesSection = "<h2>Recent updates</h2>";
$siteUpdatesSection .= createNewsletterArticle("Major Site Changes Underway", DateTime::createFromFormat("Y-m-d", "2025-04-19"), "<p>The technical staff of Northern Phish &amp; Loan is proud to announce major changes to the online banking portal. <q>It&apos;s been really exiting to see this new technology come together</q> said webmaster Sean Lauritzen in the a meeting with the Investor Relations board on April 16th. <q>Cutting edge technologies such as e-mail, cascading style sheets and ECMAScript are at the core of our new digital-first strategy,</q> Lauritzen elaborated. Customers may experience some service interruptions to online banking functionality as the new changes roll out.</p>");
$siteUpdatesSection .= createNewsletterArticle("Perimeter Doorknobs Remain Elusive", DateTime::createFromFormat("Y-m-d", "2025-04-09"), "<p>In a recent internal briefing, Northern Phish &amp; Loan&apos;s Chief Operator of Perimeter Doorknobs, Kevin Hoge, offered a rare glimpse into his ongoing efforts to streamline the operation of the company&apos;s perimeter doorknobs. While specifics remain, by design, opaque, Hoge reassured stakeholders that “progress continues along all corridors.” “Kevin&apos;s work is quite critical,” noted one anonymous source in the incompliance department. “Not sure what he does, but I&apos;m assured that it&apos;s rather important.” His quarterly reports are frequently cited in cross-functional audits, though no one outside his division has actually read one start to finish.</p>");
$siteUpdatesSection .= createNewsletterArticle("Now Hiring: Cybersecurity", DateTime::createFromFormat("Y-m-d", "2025-03-17"), "<p>Northern Phish &amp; Loan is currently seeking a new member for our Cybersecurity team. The position has become available following an extended period of inactivity from our previous team member, who is—according to his last status update—“still waiting for ClickUp to load.” While we remain hopeful for his return, we&apos;ve decided it&apos;s time to move forward.</p><p>The successful candidate will be responsible for arranging pizza Friday, managing ClickUp, writing the newsletter, and occasionally looking in the server closet to check for hackers. No prior experience or education is required, please submit your application via email.</p>");
$mainContent .= singleColumnLayout($siteUpdatesSection);
$mainContent .= "<section class=\"cards\" aria-labelledby=\"cyber-promo-heading\">";
$mainContent .= "<h2 id=\"cyber-promo-heading\">Airtight Security.</h2>";
$mainContent .= "<img src=\"img/ad_1.webp\" alt=\"The DarkVault card: your funds, your security (completely in our hands).\">";
$mainContent .= "<img src=\"img/ad_2.webp\" alt=\"Open an account today (before someone else does it for you): Zero-fee transactions. Instant account Access. State-of-the-art security. Twenty-four seven customer support. Seamless transfers. Fraud protection.\">";
$mainContent .= "<img src=\"img/ad_3.webp\" alt=\"Twenty-four seven support: Our bots are always happy to (ignore) your fraud claims!\">";
$mainContent .= "<img src=\"img/ad_4.webp\" alt=\"Fraud protection: If someone steals your funds, we promise to (look concerned).\">";
$mainContent .= "</section>";
echo generatePage($mainContent);