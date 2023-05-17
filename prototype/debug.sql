
CREATE TABLE IF NOT EXISTS systemUser(
    userID VARCHAR(10) NOT NULL,
    username VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    userRole VARCHAR(20) NOT NULL,
    givenName VARCHAR(255) NOT NULL,
    familyName VARCHAR(255) NOT NULL,
    employmentStatus VARCHAR(255) NOT NULL,
    contractType VARCHAR(20),
    studentNo VARCHAR(10),
    contactNo INT NOT NULL,
    citizenship VARCHAR(255) NOT NULL,
    indigenousStatus VARCHAR(255) NOT NULL,
    hoursAvailable INT NOT NULL,
    dob VARCHAR(45) NOT NULL,
    salary VARCHAR(255),
    PRIMARY KEY (userID),
    INDEX (username)
    );   

CREATE TABLE IF NOT EXISTS courses (
    courseCode VARCHAR(20) NOT NULL,
    courseName VARCHAR(255) NOT NULL,
    prerequisites VARCHAR(255),
    coordinatorID VARCHAR(10) NOT NULL,
    course_description VARCHAR (10000),
    PRIMARY KEY (courseCode),
    FOREIGN KEY (coordinatorID) REFERENCES systemUser(userID)
);

CREATE TABLE IF NOT EXISTS unit (
    unitCode VARCHAR(20) NOT NULL, 
    unitName VARCHAR(255) NOT NULL,
    vacancyStatus VARCHAR(255),
    courseCode VARCHAR(8) NOT NULL,
    unit_description VARCHAR (10000),
    PRIMARY KEY (unitCode),
    FOREIGN KEY (courseCode) REFERENCES courses(courseCode)
);

CREATE TABLE IF NOT EXISTS class (
    classCode VARCHAR(20) NOT NULL,
    className VARCHAR(255) NOT NULL,
    classType VARCHAR(255),
    classStartTime VARCHAR(255),
    classEndTime VARCHAR(255),
    classDay VARCHAR(255),
    class_description VARCHAR (10000),
    unitCode VARCHAR(6) NOT NULL,
    userID VARCHAR(10),
    PRIMARY KEY (classCode),
    FOREIGN KEY (unitCode) REFERENCES unit(unitCode),
    FOREIGN KEY (userID) REFERENCES systemUser(userID)
);

CREATE TABLE IF NOT EXISTS qualifications(
    userID VARCHAR(10) NOT NULL,
    qualification VARCHAR(255),
    PRIMARY KEY (userID),
    FOREIGN KEY (userID) REFERENCES systemUser(userID)
);

CREATE TABLE IF NOT EXISTS preferences(
    userID VARCHAR(10) NOT NULL,
    unitCode VARCHAR(6) NOT NULL, 
    classCode VARCHAR(10) NOT NULL,
    prefCode VARCHAR(10) NOT NULL,
    prefLevel INT(1) NOT NULL,
    PRIMARY KEY (userID, prefCode),
    FOREIGN KEY (userID) REFERENCES systemUser(userID),
    FOREIGN KEY (classCode) REFERENCES class(classCode),
    FOREIGN KEY (unitCode) REFERENCES unit(unitCode)
);

CREATE TABLE IF NOT EXISTS availability(
    userID VARCHAR(10) NOT NULL,
    a_day VARCHAR(255) NOT NULL,
    a_time VARCHAR(255) NOT NULL,
    availabilityType VARCHAR(255), 
    PRIMARY KEY (userID, a_day, a_time),
    FOREIGN KEY (userID) REFERENCES systemUser(userID)
);

CREATE TABLE IF NOT EXISTS appliesFor(
    userID VARCHAR(10) NOT NULL,
    unitCode VARCHAR(6) NOT NULL, 
    PRIMARY KEY(userID, unitCode),
    FOREIGN KEY (userID) REFERENCES systemUser(userID),
    FOREIGN KEY (unitCode) REFERENCES unit(unitCode)

);

CREATE TABLE IF NOT EXISTS resume(
    userID VARCHAR (10) NOT NULL,
    resumeDir VARCHAR(10) NOT NULL,
    resumeName VARCHAR(6) NOT NULL, 
    PRIMARY KEY(userID),
    FOREIGN KEY (userID) REFERENCES systemUser(userID)
);

CREATE TABLE IF NOT EXISTS login(
    userID VARCHAR(10) NOT NULL,
    username VARCHAR(255) NOT NULL,
    sPassword VARCHAR(255) NOT NULL,
    PRIMARY KEY (userID),
    FOREIGN KEY (userID) REFERENCES systemUser(userID),
	FOREIGN KEY (username) REFERENCES systemUser(username)

);


