This website was created during my time at APPture LLC as the company website and as a beta (alpha, initially) registration tool for an unreleased project that was internally named MOSIS. The idea behind the beta signup tool was to allow users to sign up for the MOSIS application beta and then to allow them to view their position in line for receiving a beta key as part of APPture's marketing campaign. The beta signup tool also displayed the MOSIS application's UI surrounding the signup form and beta queue placement display as another way of getting visitors excited for the application's eventual release. In the actual MOSIS application I used PhoneGap to implement the UI in an installed app that interactated with native Java and C++ code produced by other developers at APPture.

I also implemented a user registration and login system for the website itself (tied in with optional beta registration) along with an account management page. Some PHP pages included here are not used by the website but instead were used by the MOSIS application to handle user login which went through the same database.

mySQL calls use prepared statements as one of several methods of managing security-related issues.

The website is also responsive and should work on all common screen sizes ranging from smartphones to tablets to full size desktop monitors.

This website primarily utilizes Zurb Foundation, Modernizr, and some functionality from jQuery. In addition, Liquid Slider was used to create the front page's image carousel and some pages use Zepto. The website also uses Google Analytics and Tracking services.

I created everything that is used server-side for this website including its PHP code and mySQL database calls (excluding Google's pre-made Analytics PHP code located in template/ga.php). I also created the majority of the website's custom JavaScript including the mosis.js and mosisForms.js script files.

Min Ha, APPture's in-house graphic and UI/UX designer, created the design compositions, images, HTML, and some of the JavaScript for this website. Min and I worked together on the site's CSS.

IMPORTANT: APPture has disbanded since our work last year and most of its former team members including myself are working on new projects together. This website is no longer online or else I would not share its PHP and mySQL database calls because they give insight into how its database and tables were structured.