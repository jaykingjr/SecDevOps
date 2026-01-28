
test site: https://domaintrusts.com/ace

‍❄️ indicates SQL query code to be added
## detailed algorithm

### 1.0 design principles
1.1 FERPA compliance design principles<br>
1.2 ADA compliance design principles<br>
1.2.1 contrast text and background<br>
1.2.2 all form-fields associated with a label<br>
1.2.3 text alternative for all images<br>
1.2.4 inputs checked for errors<br>
1.2.5 exit (skip) links provided <br>
1.2.6 readable text size<br>
1.2.7 styles.css uaing media<br>
1.2.8 buttons clearly labeled<br>
1.3 reduce cybersecurity threats<br>
1.3.1 cross-site scripting (XSS) attacks<br>
1.3.2 SQL injection<br>
1.3.2 Client-Side Validation by limiting size, and restricting entries<br>
1.3.2 Server-Side Validation by sanitizing and removing unwanted characters<br>
### 2.0 all display screens (index, login, confirm, login, logout)
2.1 reference favicon<br>
2.2 display heading<br>
2.2.1 (h1) ACE Tutoring Lab<br>
2.2.2 GCSC logo<br>
2.3 display Commodore image<br>
2.4 All fields require labels<br>
2.5 required entry<br>
2.6 onkeyup functions<br>
### 3.0 index.php screen
3.1 ‍❄️ check files existence<br>
3.1.1 students<br>
3.1.2 courses<br>
3.1.3 log<br>
3.1.4 tutors<br>
3.1.5 admins<br>
3.2 username input<br>
3.3 press Continue button<br>
### 4.0 process.php
4.1 create emailInput from Post usernameInput<br>
4.2 store emailInput into session variable<br>
4.3 ‍❄️ query log file to determine student has no signout<br>
4.3.1 if already signed in<br>
4.3.1.1 update log record with timestamp to logout<br>
4.3.1.2 goto 6.0 logout.php <br>
4.3.2 if not signed in<br>
4.3.2.1 goto 4.0 login.php<br>
### 5.0 login.php Screen
5.1 retrieve emailInput from its session variable<br>
5.2 ‍❄️ query student file to determine new student<br>
5.3 ‍❄️ query course file to create course-prof selection list<br>
5.3 display images and headings<br>
5.4 display-only emailInput<br<br>
5.5 first name input<br>
5.5.1 required<br>
5.5.2 validate, allow only letters<br>
5.5.3 limit entry size<br>
5.5.4 capilize first letter<br>
5.6 last name input<br>
5.6.1 required<br>
5.6.2 validate, allow only letters<br>
5.6.3 limit entry size<br>
5.6.4 capilize first letter<br>
5.7 select course<br>
5.7.1 selection required<br>
5.8 student major if new student<br>
5.9 press Confirm Button<br>
5.8.1 goto 6.0 confirm.php <br>
### 6.0 Confirm.php Screen
6.1 php clean all post fields<br>
6.1.1 trim<br>
6.1.2 strip slashes<br>
6.1.3 htmlspecialchars<br>
6.2 ‍❄️ create student record if new student<br>
6.2.1 student_ID with auto increment integer<br>
6.2.2 student_fname<br>
6.2.3 student_lname<br>
6.2.4 student_email<br>
6.2.5 student_major<br>
6.2.6 student_updated with current timestamp<br>
6.3 ‍❄️ create log record<br>
6.3.1 log_ID with auto increment integer<br>
6.3.1 log_signin with current timestamp<br>
6.3.2 log_signout with blank<br>
6.3.3 log_student_ID<br>
6.3.4 log_course_ID<br>
6.3.5 log_tutor_ID with current tutor on staff<br>
6.3.6 log_updated<br>
6.4 display images and headings<br>
6.5 display confirmation message with first name and emailinput<br>
6.6 goto 4.0 index.php after 7 second time delay<br>
### 7.0 logout.php
7.1 thanking at logout.<br>
7.2 goto 4.0 index.php after 7 second time delay<br>
### 8.0 final
8.1 comment source code functions.<br>
8.2 test application<br>
8.3 create user manual.<br>
