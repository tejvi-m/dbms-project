drop database register;
create database register;

\c register

drop table part_of;
drop table WORKS_ON;
drop table PANEL;
drop table Team;
drop table PROJECT;
drop table internship;
drop table Student;
drop table TEACHER;



CREATE TABLE PANEL
(	ID VARCHAR(15)  NOT NULL,
	Size INT NOT NULL,
	PRIMARY KEY (ID));

CREATE TABLE Team
(	ID VARCHAR(15)  NOT NULL,
	Size INT NOT NULL,
	PanelID VARCHAR(15) NOT NULL,
	PRIMARY KEY (ID),
	UNIQUE (ID),
    FOREIGN KEY (PanelID) REFERENCES Panel(ID));

CREATE TABLE Student
(	Fname VARCHAR(15) NOT NULL ,
	Minit VARCHAR,
	Lname VARCHAR(15) NOT NULL,
	Ssn VARCHAR(15) NOT NULL,
	CGPA DECIMAL(3,2),
	TeamID VARCHAR(15) NOT NULL,

	PRIMARY KEY (Ssn),
	FOREIGN KEY (TeamID) REFERENCES Team(ID));

CREATE TABLE PROJECT
(	Pname VARCHAR(15)  NOT NULL,
	Domain VARCHAR(15) NOT NULL,
	Ptype VARCHAR(15) NOT NULL,
	PRIMARY KEY (Pname),
	UNIQUE(Pname));

CREATE TABLE TEACHER
(	Tname VARCHAR(20) NOT NULL,
	TID VARCHAR(15)  NOT NULL,
	PRIMARY KEY (TID),
	UNIQUE(TID));

CREATE TABLE INTERNSHIP(
	SSN VARCHAR(15) NOT NULL,
	Company VARCHAR(20) NOT NULL,
	PRIMARY KEY (SSN),
	FOREIGN KEY (SSN) REFERENCES Student(Ssn)
);

CREATE TABLE WORKS_ON
(	TeamID VARCHAR(15) NOT NULL,
	TeacherID VARCHAR(15) NOT NULL,
    Ptitle VARCHAR(15) NOT NULL,
	PRIMARY KEY (TeacherID, TeamID),
	FOREIGN KEY (TeamID) REFERENCES Team(ID),
   	FOREIGN KEY(Ptitle) REFERENCES PROJECT(Pname),
	FOREIGN KEY(TeacherID) REFERENCES TEACHER(TID));

CREATE TABLE PART_OF
(	PanelID VARCHAR(15) NOT NULL,
	TeacherID VARCHAR(15) NOT NULL,
	MEM_TYPE VARCHAR(15) ,
	PRIMARY KEY (PanelID, TeacherID),
    FOREIGN KEY (PanelID) REFERENCES Panel(ID),
    FOREIGN KEY (TeacherID) REFERENCES TEACHER(TID));

create user student with encrypted password "student";
create user teacher with encrypted password "teacher";
create user coordinator with encrypted password "coordinator";

grant update on all tables in schema public to coordinator;
grant update on panel to teacher;
grant select on all tables in schema public to teacher;
grant select on all tables in schema public to coordinator;
grant select on all tables in schema public to student;
grant insert on panel, works_on, project, team, student, internship to student;
grant insert on panel, part_of to teacher;
grant insert on all tables in schema public to coordinator;
