DROP DATABASE IF EXISTS `base_db`;
CREATE DATABASE `base_db`;
USE `base_db`;

-- Create table structure for "courses"

CREATE TABLE `courses` (
  `course_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `course_professor` varchar(50) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `course_number` char(10) NOT NULL,
  `course_updated` DATETIME NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`course_ID`)
);

-- Insert generic data into "courses"

INSERT INTO `courses` (`course_ID`, `course_professor`, `course_name`, `course_number`, `course_updated`) VALUES
(1, 'Debbie Wilson', 'Principles of Financial Accounting I', 'ACC2001', '2025-10-24 04:42:12'),
(2, 'Mary Simpson', 'Principles of Financial Accounting I', 'ACC2001', '2025-10-24 04:42:12'),
(3, 'Mary Simpson', 'Principles of Financial Accounting II', 'ACC2011', '2025-10-24 04:42:12'),
(4, 'Ken Smith', 'Microcomputer Applications', 'CGS1570', '2025-10-24 04:42:12'),
(5, 'Wayne Paulson', 'Microcomputer Applications', 'CGS1570', '2025-10-24 04:42:12'),
(6, 'Ben Carmen', 'Introduction to Programming Logic', 'COP1000', '2025-10-24 04:42:12'),
(7, 'Cate Jackson', 'Introduction to Java Programming', 'COP2250', '2025-10-24 04:42:12'),
(8, 'Wayne Paulson', 'Data Structure (SQL)', 'COP2700', '2025-10-24 04:42:12'),
(9, 'David Lawson', 'Network Fundamentals', 'CTS1650', '2025-10-24 04:42:12'),
(10, 'Ralph Ryan', 'Web Design I', 'DIG2100', '2025-10-24 04:42:12'),
(11, 'Ben Carmen', 'Principles of Economics, Macro', 'ECO2013', '2025-10-24 04:42:12'),
(12, 'Steve Musk', 'Principles of Economics, Macro', 'ECO2013', '2025-10-24 04:42:12'),
(13, 'Steve Musk', 'Principles of Economics, Micro', 'ECO2023', '2025-10-24 04:42:12'),
(14, 'Cathy Patterson', 'Financial Management', 'FIN3400', '2025-10-24 04:42:12'),
(15, 'Ben Carmen', 'SecDevOps', 'CIS4433', '2025-10-24 04:42:12'),
(16, 'Wayne Paulson', 'Agile Project Management', 'ISM4318', '2025-10-24 04:42:12'),
(17, 'Ralph Ryan', 'Emerging Technologies', 'ISM4302', '2025-10-24 04:42:12');

-- Create table structure for "students"

CREATE TABLE `students` (
  `student_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_fname` varchar(50) NOT NULL,
  `student_lname` varchar(50) NOT NULL,
  `student_email` varchar(100) NOT NULL UNIQUE,
  `student_major` varchar(100) NOT NULL,
  `student_updated` DATETIME NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`student_ID`)
);

-- Insert generic data into "students"

INSERT INTO `students` (`student_fname`, `student_lname`, `student_email`, `student_major`) VALUES
('Spike', 'Witwicky', 'switwicky@my.gulfcoast.edu', ''),
('Johnathan', 'Smith', 'jsmith8@my.gulfcoast.edu', ''),
('Kevin', 'Flynn', 'kflynn2@my.gulfcoast.edu', ''),
('Claire', 'Redfield', 'credfield@my.gulfcoast.edu', ''),
('David', 'Lightman', 'dlightman@my.gulfcoast.edu', ''),
('Ellen', 'Ripley', 'eripley@my.gulfcoast.edu', ''),
('Luz', 'Noceda', 'lnoceda@my.gulfcoast.edu', ''),
('Barney', 'Calhoun', 'bcalhoun@my.gulfcoast.edu', ''),
('Misa', 'Hayase', 'mhayase@my.gulfcoast.edu', ''),
('Cliff', 'Steele', 'csteele2@my.gulfcoast.edu', ''),
('Ken', 'DeLozier', 'kdelozier@my.gulfcoast.edu', ''),
('Tara', 'Ochs', 'tochs@my.gulfcoast.edu', ''),
('Justin', 'Scott', 'jscott5@my.gulfcoast.edu', ''),
('Morgan', 'Burch', 'mburch4@my.gulfcoast.edu', ''),
('Truman', 'Orr', 'torr2@my.gulfcoast.edu', ''),
('Barbara', 'Bruce', 'bbruce@my.gulfcoast.edu', ''),
('VC', 'Fuqua', 'vcfuqua@my.gulfcoast.edu', ''),
('Nilsa', 'Castro', 'ncastro@my.gulfcoast.edu', ''),
('Gregory', 'Rose', 'grose3@my.gulfcoast.edu', ''),
('Karen', 'Cassaday', 'kcassaday@my.gulfcoast.edu', ''),
('Marc', 'Farley', 'mfarley3@my.gulfcoast.edu', ''),
('Victoria', 'Sun', 'vsun@my.gulfcoast.edu', ''),
('Charles', 'Pittard', 'cpittard@my.gulfcoast.edu', ''),
('Linda', 'Miller', 'lmiller4@my.gulfcoast.edu', ''),
('Michael', 'Jenkins', 'mjenkins3@my.gulfcoast.edu', ''),
('Tina', 'Bandoo', 'tbandoo@my.gulfcoast.edu', ''),
('Clayton', 'Russell', 'crussell3@my.gulfcoast.edu', ''),
('Ali', 'Froid', 'afroid@my.gulfcoast.edu', ''),
('Ed', 'Kercado', 'ekercado@my.gulfcoast.edu', ''),
('Sheila', 'McCoy', 'smccoy2@my.gulfcoast.edu', '');

-- Create table structure for "logs"

CREATE TABLE `log` (
  `log_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `log_signin` datetime NOT NULL DEFAULT current_timestamp(),
  `log_signout` datetime,
  `log_student_ID` int(10) UNSIGNED NOT NULL,
  `log_course_ID` int(10) UNSIGNED NOT NULL,
  `log_updated` DATETIME NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`log_ID`),
  FOREIGN KEY (`log_student_ID`) REFERENCES students(`student_ID`),
  FOREIGN KEY (`log_course_ID`) REFERENCES courses(`course_ID`)
);

-- Insert generic data into "logs"

INSERT INTO `log` (`log_signout`, `log_student_ID`, `log_course_ID`) VALUES
(NULL, 30, 7),
(current_timestamp(), 4, 17),
(current_timestamp(), 8, 17),
(NULL, 21, 9),
(current_timestamp(), 3, 9),
(current_timestamp(), 18, 9),
(current_timestamp(), 26, 3),
(NULL, 4, 17),
(NULL, 14, 14),
(NULL, 21, 9),
(current_timestamp(), 7, 8),
(NULL, 2, 6),
(current_timestamp(), 19, 12),
(NULL, 8, 16),
(current_timestamp(), 17, 8),
(NULL, 9, 16),
(current_timestamp(), 18, 9),
(NULL, 13, 13),
(NULL, 15, 7),
(current_timestamp(), 6, 5);

-- Create "log_user"

GRANT SELECT, INSERT, UPDATE, DELETE ON * TO log_user@localhost IDENTIFIED BY 'pa55word';
