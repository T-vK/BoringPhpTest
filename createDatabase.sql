CREATE DATABASE toDoDB;
USE toDoDB;


CREATE TABLE toDoStatus (
	ID int NOT NULL AUTO_INCREMENT,
	Title varchar(255) NOT NULL,
	PRIMARY KEY (ID)
) ENGINE=INNODB;

INSERT INTO toDoStatus (Title)
VALUES ('open'), ('closed');

CREATE TABLE toDoItems (
     ID int NOT NULL AUTO_INCREMENT,
     Title varchar(255),
     ToDoStatus int NOT NULL,
     PRIMARY KEY (ID),
	 FOREIGN KEY (ToDoStatus) REFERENCES toDoStatus(ID)
)ENGINE=INNODB;