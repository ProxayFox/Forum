-- Database name / creation
CREATE DATABASE forum;

-- CPID   = Client Profile Identification
-- LID    = Login Identification
-- fName  = First Name
-- lName  = Last Name
-- UIMG   = User Image
CREATE TABLE clientProfile (
	CPID                INT(11)      	NOT NULL AUTO_INCREMENT,
	fName               VARCHAR(50)   NULL,
	lName               VARCHAR(50)   NULL,
	displayName					VARCHAR(50)		NULL,
	email               VARCHAR(150)  NOT NULL UNIQUE,
	UIMG                VARCHAR(255)  NULL,
	web                 VARCHAR(150)  NULL,
	social              VARCHAR(150)  NULL,
	upRep               INT(11)       NULL,
	downRep             INT(11)       NULL,
	rep                 INT(11)       NULL,
	postNo              INT(11)       NULL,
	followers           INT(11)       NULL,
	PRIMARY KEY (CPID)
);

-- LID    = Login Identification
-- PWD    = Password, going to be using SHA-512
-- CPID   = Client Profile Identification
CREATE TABLE login (
	LID                 INT(11)      	NOT NULL AUTO_INCREMENT,
	CPID                INT(11)     	NOT NULL,
	UName               VARCHAR(100)  NOT NULL UNIQUE,
	PWD                 VARCHAR(200)  NOT NULL,
	PRIMARY KEY (LID),
	FOREIGN KEY (CPID) 	REFERENCES clientProfile(CPID)
);

-- TID    = Thread Identification
-- CPID   = Client Profile Identification
CREATE TABLE thread (
  TID									INT(11)				NOT NULL  AUTO_INCREMENT,
  CPID								INT(11)				NOT NULL,
  title 							VARCHAR(500)	NOT NULL,
  info                TEXT(1000)    NOT NULL,
  created							TIMESTAMP			NOT NULL,
  PRIMARY KEY (TID),
  FOREIGN KEY (CPID) 	REFERENCES clientProfile(CPID)
);

-- TVID   = Thread View Identification
-- TID    = Thread Identification
-- CPID   = Client Profile Identification
CREATE TABLE threadView (
  TVID                INT(11)       NOT NULL AUTO_INCREMENT,
  TID                 INT(11)       NOT NULL,
  CPID                INT(11)       NOT NULL,
  views               INT(11)       NOT NULL,
  upRep               INT(11)       NULL,
  downRep             INT(11)       NULL,
  PRIMARY KEY (TVID),
  FOREIGN KEY (TID) REFERENCES thread(TID),
  FOREIGN KEY (CPID) REFERENCES clientProfile(CPID)
);

-- PID    = Post Identification
-- CPID   = Client Profile Identification
-- TID    = Thread Identification
CREATE TABLE post (
  PID                 INT(11)       NOT NULL AUTO_INCREMENT,
  CPID                INT(11)       NOT NULL,
  TID									INT(11)				NOT NULL,
  title               VARCHAR(500)  NOT NULL,
  info  							TEXT(3000)		NOT NULL,
  created							TIMESTAMP			NOT NULL,
  replies             INT(11)       NULL,
  views               INT(11)       NULL,
  PRIMARY KEY (PID),
  FOREIGN KEY (CPID) 	REFERENCES clientProfile(CPID),
  FOREIGN KEY (TID) 	REFERENCES thread(TID)
);

-- PVID   = Post View Identification
-- PID    = Post Identification
-- CPID   = Client Profile Identification
CREATE TABLE postView (
  PVID                INT(11)       NOT NULL AUTO_INCREMENT,
  PID                 INT(11)       NOT NULL,
  CPID                INT(11)       NOT NULL,
  views               INT(11)       NOT NULL,
  upRep               INT(11)       NULL,
  downRep             INT(11)       NULL,
  PRIMARY KEY (PVID),
  FOREIGN KEY (PID) REFERENCES post(PID),
  FOREIGN KEY (CPID) REFERENCES clientProfile(CPID)
);

-- RID    = Reply Identification
-- CPID   = Client Profile Identification
-- TID    = Thread Identification
-- PID    = Post Identification
CREATE TABLE reply (
   RID                INT(11)       NOT NULL AUTO_INCREMENT,
   CPID               INT(11)       NOT NULL,
   TID                INT(11)       NOT NULL,
   PID								INT(11)				NOT NULL,
   content						TEXT(3000)		NOT NULL,
   created						TIMESTAMP			NOT NULL,
   PRIMARY KEY (RID),
   FOREIGN KEY (CPID) 	REFERENCES clientProfile(CPID),
   FOREIGN KEY (PID) 	REFERENCES post(PID)
);

-- RRID   = Reply Reputation  Identification
-- RID    = Reply Identification
-- CPID   = Client Profile Identification
CREATE TABLE replyRep (
  RRID                INT(11)       NOT NULL AUTO_INCREMENT,
  CPID                INT(11)       NOT NULL,
  RID                 INT(11)       NOT NULL,
  upRep               INT(11)       NULL,
  downRep             INT(11)       NULL,
  PRIMARY KEY (RRID),
  FOREIGN KEY (CPID) REFERENCES clientProfile(CPID),
  FOREIGN KEY (RID) REFERENCES reply(RID)
);



INSERT INTO `clientProfile` (`CPID`, `fName`, `lName`, `displayName`, `email`, `UIMG`, `uprep`, `downrep`) VALUES
(1, 'Arabella', 'NumNut', NULL, 'admin1@proxwebdev.com', 'stars.jpeg', NULL, NULL),
(2, 'Mariah', 'MarMight', NULL, 'admin@proxwebdev.com', '11e79c5bd7cf103d.png', NULL, NULL);


INSERT INTO `login` (`LID`, `CPID`, `UName`, `PWD`) VALUES
(1, 1, 'atcav', 'e6c83b282aeb2e022844595721cc00bbda47cb24537c1779f9bb84f04039e1676e6ba8573e588da1052510e3aa0a32a9e55879ae22b0c2d62136fc0a3e85f8bb'),
(2, 2, 'admin', 'e6c83b282aeb2e022844595721cc00bbda47cb24537c1779f9bb84f04039e1676e6ba8573e588da1052510e3aa0a32a9e55879ae22b0c2d62136fc0a3e85f8bb');

INSERT INTO `thread` (`TID`, `CPID`, `title`, `info`, `created`) VALUES
(1, 1, 'Youtube', 'Videos for all', '2019-04-25 16:49:37'),
(2, 1, 'Microsoft', 'OS for approximately 75% of all PCs', '0000-00-00 00:00:00'),
(3, 1, 'Tesla', 'Best Car manufacturer', '2019-04-25 16:51:24'),
(4, 1, 'MEMES', 'josh is gay', '2019-04-25 16:51:34'),
(5, 1, 'America', 'he just sucks cock', '2019-04-28 17:39:25');

INSERT INTO `post` (`PID`, `CPID`, `TID`, `title`, `info`, `created`, `replies`, `views`) VALUES
(1, 1, 1, 'Youtube', 'info', '2019-04-28 19:35:11', NULL, NULL),
(2, 1, 2, 'Microsoft', 'info', '2019-04-28 19:54:09', NULL, NULL),
(3, 1, 3, 'Tesla', 'info', '2019-05-13 19:41:48', NULL, NULL),
(4, 1, 4, 'MEMES', 'info', '2019-05-13 19:43:36', NULL, NULL),
(5, 1, 5, 'America', 'info', '2019-05-13 19:43:49', NULL, NULL);