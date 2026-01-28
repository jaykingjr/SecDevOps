# Data Organization: Tables/fields

### Students
Table Field Name | Data Type & Length | Description
:--- | :--- | :---
student_ID | INT(10) | auto increment
student_fname | VARCHAR(50) | verifies student at sign-in
student_lname | VARCHAR(50) | verifies student at sign-in
student_email | VARCHAR(100) | username part can be unique studentID
student_major | VARCHAR(100) | student degree program
student_updated | DATETIME | Timestamp of when the user account was last updated.

---

### Courses
Table Field Name | Data Type & Length | Description
:--- | :--- | :---
course_ID | INT(10) | auto increment
course_professor | CHAR(50) | unique name IDentifying the professor
course_name | VARCHAR(100) | name of the course
course_number | CHAR(10) |  unique three-letter prefix and a three-digit number, cis4433
course_updated | DATETIME | timestamp date and time of when the record was last updated.

---

<br>

# **------------CURRENTLY OUT OF SCOPE------------**



### Admins
Table Field Name | Data Type & Length | Description
:--- | :--- | :---
admin_ID | INT(10) | auto increment
admin_fname | VARCHAR(50) | verifies admin sign-in
admin_lname | VARCHAR(50) | verifies admin sign-in
admin_email | VARCHAR(100) | username part can be unique ID
admin_phone | CHAR(15) | (890)123-4567
admin_FERPA | BINERY(4) | True or False to allow admins to see records
admin_password | VARCHAR(100) | securely hashed
admin_updated | DATETIME | timestamp date and time of when the record was last updated.

---

### Tutors
Table Field Name | Data Type & Length | Description
:--- | :--- | :---
tutor_ID | INT(10) | auto increment
tutor_fname | VARCHAR(50) | verifies tutor sign-in
tutor_lname | VARCHAR(50) | verifies tutor sign-in
tutor_email | VARCHAR(100) | username part can be unique ID
tutor_phone | CHAR(15) | (890)123-4567
tutor_courses | VARCHAR(255) | list of courses
tutor_schedule | VARCHAR(255) | list of schedules
tutor_updated | DATETIME | timestamp date and time of when the record was last updated.

---

### Log
Table Field Name | Data Type & Length | Description
:--- | :--- | :---
log_ID | INT(10) | auto increment
log_signin | DATETIME | unique primary key, timestamp date and time when the student signs in
log_signout | DATETIME | timestamp date and time at sign out
log_student_ID | CHAR(10) |  foreign key
log_course_ID | CHAR(10) |  foreign key
log_tutor_ID | CHAR(10) |  foreign key
log_updated | DATETIME | timestamp date and time of when the record was last updated.



---

## Privacy and Security Requirements
| Requirement | Notes          |
|-------------|----------------|
| FERPA       | No PII display |
| Anonymous?  | Name N/R       |

---

## Compliance
| Requirement | Notes                                 |
|-------------|---------------------------------------|
| ADA         | Ensure accessibility accommodations   |


