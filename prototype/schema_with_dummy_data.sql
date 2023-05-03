CREATE TABLE login (
    username VARCHAR(255) NOT NULL,
    sPassword VARCHAR(255) NOT NULL,
    userRole VARCHAR(255) NOT NULL DEFAULT 'applicant',
    PRIMARY KEY (username)
);

CREATE TABLE staff (
    username VARCHAR(255) NOT NULL,
    staffID VARCHAR(10) NOT NULL,
    sGivenName VARCHAR(255) NOT NULL,
    sFamilyName VARCHAR(255) NOT NULL,
    contractType VARCHAR(255) NOT NULL,
    salary VARCHAR(255) NOT NULL,
    PRIMARY KEY (staffID),
	FOREIGN KEY (username) REFERENCES login(username)
);

CREATE TABLE courses (
    courseCode VARCHAR(8) NOT NULL,
    courseName VARCHAR(255) NOT NULL,
    prerequisites VARCHAR(255),
    coordinatorID VARCHAR(5) NOT NULL,
    PRIMARY KEY (courseCode),
    FOREIGN KEY (coordinatorID) REFERENCES staff(staffID)
);

CREATE TABLE unit (
    unitCode VARCHAR(20) NOT NULL, 
    unitName VARCHAR(255) NOT NULL,
    vacancyStatus VARCHAR(255) NOT NULL DEFAULT 'false',
    courseCode VARCHAR(8) NOT NULL,
    PRIMARY KEY (unitCode),
    FOREIGN KEY (courseCode) REFERENCES courses(courseCode)
);

CREATE TABLE class (
    classCode VARCHAR(20) NOT NULL,
    className VARCHAR(255) NOT NULL,
    classType VARCHAR(255),
    classTimeslot VARCHAR(255),
    unitCode VARCHAR(20) NOT NULL,
    staffID VARCHAR(10),
    PRIMARY KEY (classCode),
    FOREIGN KEY (unitCode) REFERENCES unit(unitCode),
    FOREIGN KEY (staffID) REFERENCES staff(staffID)
);

CREATE TABLE applicant(
	username VARCHAR(255) NOT NULL,
    applicantID VARCHAR(10) NOT NULL,
    title VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    givenName VARCHAR(255) NOT NULL,
    familyName VARCHAR(255) NOT NULL,
    employmentStatus VARCHAR(255) NOT NULL,
    contactNo INT NOT NULL,
    citizenship VARCHAR(255) NOT NULL,
    indigenousStatus VARCHAR(255) NOT NULL,
    hoursAvailable INT NOT NULL,
    PRIMARY KEY (applicantID),
    FOREIGN KEY (username) REFERENCES login(username)
);   

CREATE TABLE qualifications(
    applicantID VARCHAR(10) NOT NULL,
    qualification VARCHAR(255),
    PRIMARY KEY (applicantID),
    FOREIGN KEY (applicantID) REFERENCES applicant(applicantID)
);

CREATE TABLE preferences(
    applicantID VARCHAR(10) NOT NULL,
    unitCode VARCHAR(6) NOT NULL, 
    classCode VARCHAR(10) NOT NULL,
    prefCode VARCHAR(10) NOT NULL,
    prefLevel INT(1) NOT NULL,
    PRIMARY KEY (applicantID, classCode),
    FOREIGN KEY (applicantID) REFERENCES applicant(applicantID),
    FOREIGN KEY (classCode) REFERENCES class(classCode),
    FOREIGN KEY (unitCode) REFERENCES unit(unitCode)
);

CREATE TABLE availability(
    applicantID VARCHAR(10) NOT NULL,
    a_day VARCHAR(255) NOT NULL,
    a_time VARCHAR(255) NOT NULL,
    availabilityType VARCHAR(255), 
    PRIMARY KEY (applicantID, a_day, a_time),
    FOREIGN KEY (applicantID) REFERENCES applicant(applicantID)
);

INSERT INTO login(username, sPassword, userRole)
VALUES
('staff1', 'password', 'staff'),
('staff2', 'password', 'staff'),
('user', 'password', 'applicant'),
('user2', 'password', 'applicant');

INSERT INTO staff(username, staffID, sGivenName, sFamilyName, contractType, salary)
VALUES
('staff1', 23123, 'John', 'Snow', 'Permanent', 125000),
('staff2', 42343, 'Jack', 'Black', 'Part-time', 200000);

INSERT INTO courses(courseCode, courseName, coordinatorID)
VALUES
('BA-2023', 'Bachelor of Arts', 23123),
('BSc-2023', 'Bachelor of Science', 42343);

INSERT INTO unit(unitCode, unitName, courseCode, vacancyStatus)
VALUES
('ENG101','English 101', 'BA-2023', 'true'),
('BIO102','Biology 102', 'BSc-2023', 'true'),
('CHEM101','Chemistry 102', 'BSc-2023', 'false');

INSERT INTO class(unitCode, classCode, className, classTimeSlot)
VALUES
('ENG101','ENG101_01', 'ENG101_01', 'Monday_09:00-10:00'),
('ENG101','ENG101_02', 'ENG101_02', 'Tuesday_010:00-12:00'),
('ENG101','ENG101_03', 'ENG101_03', 'Wednesday_14:00-15:00'),
('BIO102','BIO102_01', 'BIO102_01', 'Wednesday_09:00-10:00'),
('BIO102','BIO102_02', 'BIO102_02', 'Thursday_09:00-10:00'),
('BIO102','BIO102_03', 'BIO102_03', 'Friday_16:00-17:00'),
('CHEM101','CHEM101_01', 'CHEM101_01', 'Monday_09:00-10:00'),
('CHEM101','CHEM101_02', 'CHEM101_02', 'Tuesday_09:00-10:00'),
('CHEM101','CHEM101_03', 'CHEM101_03', 'Wednesday_16:00-17:00');

INSERT INTO applicant (username, applicantID, title, email, givenName, familyName, employmentStatus, contactNo, citizenship, indigenousStatus, hoursAvailable)
VALUES 
('user', 'S123456789', 'Mrs', 'applicant3@email.com', 'Jack', 'Black', 'Full-time', 0118235, 'Australia', 'Non-Indigenous', 33),
('user2', 'S989798982', 'Mrs', 'applicant2@email.com', 'Jill', 'Whitw', 'Full-time', 0455555522, 'Australia', 'Non-Indigenous', 23),
('staff1', 23123, 'Mr', 'staff1@gmail.com', 'John', 'Snow', 'FT', 041234234, 'AU', 'Na', 34),
('staff2', 42343, 'Mr', 'staff2@gmail.com', 'Jack', 'Black', 'PT', 042313324, 'AU', 'Yes', 22);


-- To drop tables
DROP TABLE preferences;
DROP TABLE class;
DROP TABLE unit;
DROP TABLE courses;
DROP TABLE login;
DROP TABLE qualifications;
DROP TABLE availability;
DROP TABLE applicant;
DROP TABLE staff;