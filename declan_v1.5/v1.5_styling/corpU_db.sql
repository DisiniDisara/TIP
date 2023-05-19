CREATE TABLE staff (
    staffID VARCHAR(10) NOT NULL,
    sGivenName VARCHAR(255) NOT NULL,
    sFamilyName VARCHAR(255) NOT NULL,
    contractType VARCHAR(255) NOT NULL,
    salary VARCHAR(255) NOT NULL,
    PRIMARY KEY (staffID)
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
    unitCode VARCHAR(6) NOT NULL, 
    unitName VARCHAR(255) NOT NULL,
    vacancyStatus VARCHAR(255),
    courseCode VARCHAR(8) NOT NULL,
    PRIMARY KEY (unitCode),
    FOREIGN KEY (courseCode) REFERENCES courses(courseCode)
);

CREATE TABLE class (
    classCode VARCHAR(10) NOT NULL,
    className VARCHAR(255) NOT NULL,
    classType VARCHAR(255),
    classTimeslot VARCHAR(255),
    unitCode VARCHAR(6) NOT NULL,
    staffID VARCHAR(10),
    PRIMARY KEY (classCode),
    FOREIGN KEY (unitCode) REFERENCES unit(unitCode),
    FOREIGN KEY (staffID) REFERENCES staff(staffID)
);

CREATE TABLE login (
    staffID VARCHAR(10) NOT NULL,
    username VARCHAR(255) NOT NULL,
    sPassword VARCHAR(255) NOT NULL,
    PRIMARY KEY (staffID),
    FOREIGN KEY (staffID) REFERENCES staff(staffID)
);

CREATE TABLE user (
    username VARCHAR(255) NOT NULL,
    sPassword VARCHAR(255) NOT NULL,
    PRIMARY KEY (username)
);

CREATE TABLE applicant(
	username VARCHAR(255) NOT NULL,
    applicantID VARCHAR(10) NOT NULL,
    title VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    givenName VARCHAR(255) NOT NULL,
    familyName VARCHAR(255) NOT NULL,
    employmentStatus VARCHAR(255) NOT NULL,
    -- studentNo VARCHAR(10) NOT NULL,
    contactNo INT NOT NULL,
    emailAddress VARCHAR(255) NOT NULL,
    citizenship VARCHAR(255) NOT NULL,
    indigenousStatus VARCHAR(255) NOT NULL,
    hoursAvailable INT NOT NULL,
--     staffID VARCHAR(10),
--     unitCode VARCHAR(6) NOT NULL,
    PRIMARY KEY (applicantID),
    FOREIGN KEY (username) REFERENCES user(username),

--     FOREIGN KEY (staffID) REFERENCES staff(staffID),
--     FOREIGN KEY (unitCode) REFERENCES unit(unitCode)
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
    PRIMARY KEY (applicantID, prefCode),
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

CREATE TABLE staff (
    staffID VARCHAR(10) NOT NULL,
    sGivenName VARCHAR(255) NOT NULL,
    sFamilyName VARCHAR(255) NOT NULL,
    contractType VARCHAR(255) NOT NULL,
    salary VARCHAR(255) NOT NULL,
    PRIMARY KEY (staffID)
);

INSERT INTO staff(staffID, sGivenName, sFamilyName, contractType, salary)
VALUES
(23123, 'John', 'Snow', 'Permanent', 125000),
(42343, 'Jack', 'Black', 'Part-time', 200000);


INSERT INTO courses(courseCode, courseName, coordinatorID)
VALUES
('BA-2023', 'Bachelor of Arts', 23123),
('BSc-2023', 'Bachelor of Science', 42343);

INSERT INTO unit(unitCode, unitName, courseCode)
VALUES
('ENG101','English 101', 'BA-2023'),
('BIO102','Biology 102', 'BSc-2023');

INSERT INTO class(unitCode, classCode, className, classTimeSlot)
VALUES
('ENG101','ENG101_01', 'ENG101_01', 'Monday_09:00-10:00'),
('ENG101','ENG101_02', 'ENG101_02', 'Tuesday_010:00-12:00'),
('ENG101','ENG101_03', 'ENG101_03', 'Wednesday_14:00-15:00'),
('BIO102','BIO102_01', 'BIO102_01', 'Wednesday_09:00-10:00'),
('BIO102','BIO102_02', 'BIO102_02', 'Thursday_09:00-10:00'),
('BIO102','BIO102_03', 'BIO102_03', 'Friday_16:00-17:00');

INSERT INTO unit(unitCode, unitName, courseCode)
VALUES
('ENG101','English 101', 'BA-2023'),
('BIO102','Biology 102', 'BSc-2023');

INSERT INTO applicant (applicantID, title, email, givenName, familyName, employmentStatus, studentNo, contactNo, emailAddress, citizenship, indigenousStatus, hoursAvailable, staffID, unitCode)
VALUES 
('003', 'Mrs', 'applicant3@email.com', 'Jack', 'Black', 'Full-time', 'S24681', 0118235, 'applicant2@email.com', 'Australia', 'Non-Indigenous', 33, '42343', 'BIO102');

DROP TABLE preferences;

SELECT *
FROM preferences;

SELECT *
FROM user;

SELECT *
FROM class;

SELECT *
FROM applicant;