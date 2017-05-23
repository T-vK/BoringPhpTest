CREATE DATABASE toDoDB;
USE toDoDB;

CREATE TABLE toDoItems (
     ID int NOT NULL AUTO_INCREMENT,
     Title varchar(255) NOT NULL,
     ToDoStatus varchar(255),
     PRIMARY KEY (ID)
)AUTO_INCREMENT=0;