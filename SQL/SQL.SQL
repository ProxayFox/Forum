-- I know this looks retarded but it's looks nicer to me this way
-- Creat the DataBase
CREATE DATABASE forum;

-- creat SQL Table register
-- CPID   = Client Profile Identification
-- LID    = Login Identiforcation
CREATE TABLE clientProfile (
	CPID                CHAR(11)      NOT NULL AUTO_INCREMENT,
	fName               VARCHAR(50)   NULL,
	lName               VARCHAR(50)   NULL,
	email               VARCHAR(150)  NOT NULL UNIQUE,
	mPhone              VARCHAR(12)   NOT NULL UNIQUE,
	address             VARCHAR(255)  NULL,
	city                VARCHAR(100)  NULL,
	state               VARCHAR(50)   NULL,
	postcode            INT(4)    	  NULL,
	country             VARCHAR (75)  NULL,
	PRIMARY KEY (CPID)
);

-- Creat SQL table users
-- LID    = Login Identification
-- PWD    = Password, going to be using SHA-512
-- CPID   = Client Profile Identification
CREATE TABLE login (
	LID                 CHAR(11)      NOT NULL AUTO_INCREMENT,
	CPID                CHAR(11)      NOT NULL,
	UName               VARCHAR(100)  NOT NULL UNIQUE,
	PWD                 VARCHAR(150)  NOT NULL,
	PRIMARY KEY (LID),
	FOREIGN KEY (CPID) REFERENCES clientProfile(CPID)
);

CREATE TABLE message (
  MID                 CHAR(11)       NOT NULL AUTO_INCREMENT,
  CPID                CHAR(11)       NOT NULL,
  message             TEXT(500)		 NOT NULL,
  PRIMARY KEY (MID),
  FOREIGN KEY (CPID) REFERENCES clientProfile(CPID)
);



INSERT INTO `clientprofile` (`CPID`, `fName`, `lName`, `email`, `mPhone`, `address`, `city`, `state`, `postcode`, `country`) VALUES
(1, 'Ayden', 'Melhop', 'atcav1@outlook.com', '0490844729', '9/7 Boundary st', 'Brisbane', 'Queensland', '4000', 'Australia'),
(2, 'Ayden', 'Melhop', 'admin@proxwebdev.com', '66666666666', '183 Beddoes st', 'Brisbane', 'Queensland', '4121', 'Australia');


INSERT INTO `login` (`LID`, `CPID`, `UName`, `PWD`) VALUES
(1, 1, 'atcav', 'e6c83b282aeb2e022844595721cc00bbda47cb24537c1779f9bb84f04039e1676e6ba8573e588da1052510e3aa0a32a9e55879ae22b0c2d62136fc0a3e85f8bb'),
(2, 2, 'admin', 'e6c83b282aeb2e022844595721cc00bbda47cb24537c1779f9bb84f04039e1676e6ba8573e588da1052510e3aa0a32a9e55879ae22b0c2d62136fc0a3e85f8bb');