-- I know this looks retarded but it's looks nicer to me this way
-- Creat the DataBase
CREATE DATABASE forum;

-- creat SQL Table register
-- CPID   = Client Profile Identification
-- LID    = Login Identification
CREATE TABLE clientProfile (
	CPID                INT(11)      NOT NULL AUTO_INCREMENT,
	fName               VARCHAR(50)   NULL,
	lName               VARCHAR(50)   NULL,
	email               VARCHAR(150)  NOT NULL UNIQUE,
	PRIMARY KEY (CPID)
);

-- Creat SQL table users
-- LID    = Login Identification
-- PWD    = Password, going to be using SHA-512
-- CPID   = Client Profile Identification
CREATE TABLE login (
	LID                 INT(11)      NOT NULL AUTO_INCREMENT,
	CPID                INT(11)      NOT NULL,
	UName               VARCHAR(100)  NOT NULL UNIQUE,
	PWD                 VARCHAR(150)  NOT NULL,
	PRIMARY KEY (LID),
	FOREIGN KEY (CPID) REFERENCES clientProfile(CPID)
);

CREATE TABLE message (
  MID                 INT(11)       NOT NULL AUTO_INCREMENT,
  CPID                INT(11)       NOT NULL,
  message             TEXT(500)		 NOT NULL,
  PRIMARY KEY (MID),
  FOREIGN KEY (CPID) REFERENCES clientProfile(CPID)
);



INSERT INTO `clientProfile` (`CPID`, `fName`, `lName`, `email`) VALUES
(1, 'Arabella', 'meal', 'atcav1@outlook.com'),
(2, 'Mariah', 'MarMight', 'admin@proxwebdev.com');


INSERT INTO `login` (`LID`, `CPID`, `UName`, `PWD`) VALUES
(1, 1, 'atcav', 'e6c83b282aeb2e022844595721cc00bbda47cb24537c1779f9bb84f04039e1676e6ba8573e588da1052510e3aa0a32a9e55879ae22b0c2d62136fc0a3e85f8bb'),
(2, 2, 'admin', 'e6c83b282aeb2e022844595721cc00bbda47cb24537c1779f9bb84f04039e1676e6ba8573e588da1052510e3aa0a32a9e55879ae22b0c2d62136fc0a3e85f8bb');