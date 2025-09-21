# ⚙ ACE Tutoring Lab Sign-In Web Application

## ➔ Description

ACE Tutoring Lab is a free tutoring service available to all our students in accounting, computer sciences, microcomputer applications, and economics courses. Nakia McCray supervises the lab. The lab has several tutors available at scheduled times to help students with homework assignments and projects. This simple sign-in application uses PHP, SQL, HTML, CSS, and JavaScript. It is used to track student attendance and participation in tutoring sessions. This sign-in log is intended for use by students and tutors at the start of each tutoring session.

### Purpose of this Sign-In Application

*   **Allow easy Sign-In for Students**: This will allow students to sign in easily and keep an accurate record of all students.
*   **Track attendance**: To maintain an accurate record of all students who attend tutoring sessions.
*   **Inform tutors**: To give tutors a snapshot of which students are attending and what they have worked on previously.
*   **A FERPA-approved participation**: To document the frequency and duration of each student's tutoring sessions, and to provide data for administrative reports on program usage and student engagement.

## ➔ Prerequisites for Development

The following needs to be installed on the system:
- XAMPP for PHP and SQL from https://www.apachefriends.org/
- Create Github account https://github.com/jaykingjr
- Establish Git tool for team collaboration
- Establish Discord for team communications

## ➔ Data Organization

### Project Structure

```
MVC
├── documentation/
│ ├── README.md
│ ├── projectCharter.md
│ └── dataOrganization.md
├── views/
│ ├── header.php
│ └── footer.php
├── local/
│ ├── index.php (sign-in)
│ └── confirm.php
├── model/
│ └── database
└── assets/
  ├── images/
  └── style.css
```

### Tables with fields

#### ✓ Students
Table Field Name | Data Type & Length | Description
:--- | :--- | :---
studentID | INT(10) | auto increment
studentFname | VARCHAR(50) | verifies student at sign-in
studentLname | VARCHAR(50) | verifies student at sign-in
studentEmail | VARCHAR(100) | username part can be unique studentID
studentMajor | VARCHAR(100) | student degree program
studentUpdated | DATETIME | timestamp date and time of the record's last update

#### ✓ Courses
Table Field Name | Data Type & Length | Description
:--- | :--- | :---
courseID | INT(10) | auto increment
courseProfessor | CHAR(50) | unique name Identifying the professor
courseName | VARCHAR(100) | name of the course
courseNumber | CHAR(10) |  unique three-letter prefix and a three-digit number, cis4433
courseUpdated | DATETIME | timestamp date and time of the record's last update

#### ✓ Log
Table Field Name | Data Type & Length | Description
:--- | :--- | :---
logSignIn | DATETIME | unique primary key, timestamp date and time when the student signs in
logSignOut | DATETIME | timestamp date and time at sign out
logStudentID | CHAR(10) |  foreign key
logCourseID | CHAR(10) |  foreign key
logTutorID | CHAR(10) |  foreign key
logUpdated | DATETIME | timestamp date and time of the record's last update

#### ✓ Admins, in scope of phase 2
Table Field Name | Data Type & Length | Description
:--- | :--- | :---
adminID | CHAR(10) | unique primary key |
adminFname | VARCHAR(50) | verifies admin sign-in
adminLname | VARCHAR(50) | verifies admin sign-in
adminEmail | VARCHAR(100) | username part can be unique ID
adminPhone | CHAR(15) | (890)123-4567
adminFERPA | BINERY(4) | True or False to allow admins to see records
adminPassword | VARCHAR(100) | securely hashed
adminUpdated | DATETIME | timestamp date and time of the record's last update

#### ✓ Tutors, in scope of phase 2
Table Field Name | Data Type & Length | Description
:--- | :--- | :---
tutorID | CHAR(10) | unique primary key |
tutorFname | VARCHAR(50) | verifies tutor sign-in
tutorLname | VARCHAR(50) | verifies tutor sign-in
tutorEmail | VARCHAR(100) | username part can be unique ID
tutorPhone | CHAR(15) | (890)123-4567
tutorCourses | VARCHAR(255) | list of cources
tutorSchedule | VARCHAR(255) | list of schedules
tutorUpdated | DATETIME | timestamp date and time of the record's last update

## ➔ Technologies Used
- Github
- Git
- PHP
- SQL
- Html
- JavaScript (ES6+)
- CSS Modules
- localStorage (for persistence)

## ➔ Improved security and accountability:

Sign-in applicaation forms, especially digital create a verifiable audit trail of who is in the lab. This enhances security and provides accountability for specific activities.

### Model-View-Controller (MVC) Framework

We should use the MVC architectural pattern on the server. The MVC framework will contribute to application security by promoting separation. Data protection in the Model layer is isolated from the public presentation layer (View). The Model layer prevents direct interaction between the user interface and the database, making it more difficult for attackers to manipulate or access the data directly. If we are using the internet, the encryption provided by HTTPS ensures that the data sent between the client and the server is not tampered with during transit. If we are using the intranet, the data is accessible only to authorized users within an organization. 

The STRIDE threat modeling framework applies to both client-side and server-side components of an application. STRIDE mostly originates from the client-side lack of protection.

### Client-side attacks.
* Malware
* Phishing
* SQL injection (SQLi)
* Cross-site scripting (XSS)
* Man-in-the-Middle (MitM)
* Password-based attacks

### Server-side attacks.
* DoS
* Man-in-the-Middle

### Applies to both client-side and server-side

 Category | Application to Client-Side | Application to Server-Side
--- | --- | ---
**Spoofing**  <br>(Identity) | An attacker impersonates a user through a compromised browser session or stolen cookies. | An attacker uses stolen credentials to gain unauthorized access to the server or impersonates an internal service to access data.
**Tampering**  <br>(Integrity) | An attacker uses browser developer tools to alter client-side data, such as a product's price in a form before submitting it to the server. | An attacker modifies data in transit between the client and server or corrupts data stored in a database.
**Repudiation**  <br>(Non-repudiation) | The client-side lacks proper logging or security controls, allowing users to deny acting. | The server-side lacks sufficient logging or digital signatures, enabling a fraudulent user to deny that a transaction occurred.
**Information Disclosure**  <br>(Confidentiality) | Sensitive data is accidentally exposed in client-side code, allowing attackers to access information they are not authorized to see. | A server-side vulnerability, such as a misconfigured database or API, leaks confidential data to an unauthorized party. |
**Denial of Service (DoS)**  <br>(Availability) | An attacker can cause a DoS by overloading the client's web browser with excessive requests or complex operations, consuming its resources. | An attacker overwhelms the server with traffic or exploits a vulnerability that causes the server to crash, making the service unavailable to legitimate users.
**Elevation of Privilege**  <br>(Authorization) | An attacker bypasses a client-side access control, like a hidden button, to perform an action they are not authorized to do. | A server-side vulnerability allows a low-privileged user to gain administrator access, granting them the ability to perform unauthorized actions.

## ➔ Feature Backlog

1.  **Student sign-in**: 
	* Upon arrival, the student enters the email address,
	* Enters first and last name.
	* System timestamp the student arrival data and time.
2.  **Student history panel**:
    * Fill out the required information
    * Student selects class and the professor
3.  **Student confirmation**:
    * The system confirms student
	* Display confirmation screen
4.  **Student Sign-out**:
	* The student is allowed to log out.
	* Otherwise, system sign-out
5.  **Tutor sign-in, phase 2 scope**: 
	* Upon arrival, the tutors enters the email address,
	* Enters first and last name.
	* System timestamp the tutors arrival data and time.
6.  **Tutor confirmation**:
    * The system confirms tutor	
	* Display confirmation screen
7.  **Tutor sign-out**:
	* The tutor is allowed to log out.
8.  **Sign in for Administrators, phase 2 scope**: 
	* Enters email address
	* Enters password
	* Enters first and last name.
	* System timestamp the tutors arrival data and time.
	* FERPA allowance allows data view and report generation
9.  **Compliance in the application**: 
	* ADA
	* Ferpa
10. **Security in the application**: 
	* Administrator stored password is encrypted in a hash
	* MFA, administrator email verification
	* Server and client traffic to be encrypted, extranet or HTTPS
	* Implement other developer solutions for threats
	* Backup program procedures
11.	**Displays**
	* Images
	* Header and Footor
	* CSS: styles.css
12.	**Data Integration**
13. **Queries for display or reports**

## ➔ Release Schedule

* **Week of 9-11**
	- gather information for the application
	- questionnaire for customer
	- user interview process
* **Week of 9-17, Planning & Charter Approval**
	- Project Charter
	- project proposal to the user
	- Github shared
* **Week of 9-25, Security**
	- security risk plan
	- README file
* **Week of 10-2, Database integration**
	- database structure
* **Week of 10-9**
	- an entity relationship diagram (ERD) of database tables
	- detailed algorithm
* **Week of 10-16**
	- work breakdown structure of the project
	- assign tasks to team members
* **Week of 10-23**
	- began coding of phase 1 scope
	- code review discussions
	- test program
* **Week of 10-30**
	- revise coding of phase 1 scope
	- began coding of phase 2 scope	
	- code review discussions
	- test program
* **Week of 11-6**
	- test program before manager-user presentation
* **Week of 11-13,  sprint 1**
	- first demonstrate application to the manager-user
	- make application changes
* **Week of 11-20, sprint 2**
	- second demonstration application to the manager-user
	- make application changes
* **Week of 11-27**
	- user manual completed
	- final demonstration application to manager-us
	- train manager-user

## ✏ Status
Current Version: 1.0<br>
Last Updated: September 18, 2025<br>
Author: Jay King

### ⚖️ License
This application is the property of Gulf Coast State College and class © Copyright cis4433 September 18, 2025
