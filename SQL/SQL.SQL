-- Database name / creation
CREATE DATABASE forum;

-- CDID   = Client Data Identification
-- LID    = Login Identification
-- fName  = First Name
-- lName  = Last Name
-- UIMG   = User Image
CREATE TABLE clientData (
	CDID                INT(11)      	NOT NULL AUTO_INCREMENT,
	fName               VARCHAR(50)   NULL,
	lName               VARCHAR(50)   NULL,
	email               VARCHAR(150)  NOT NULL UNIQUE,
	PRIMARY KEY (CDID)
);

CREATE TABLE clientProfile (
  CPIP                INT(11)       NOT NULL AUTO_INCREMENT,
  CDID                INT(11)      	NOT NULL,
  displayName					VARCHAR(50)		NULL UNIQUE,
  UIMG                VARCHAR(255)  NULL,
  web                 VARCHAR(150)  NULL,
  social              VARCHAR(150)  NULL,
  postNo              INT(11)       NULL,
  PRIMARY KEY (CPIP),
  FOREIGN KEY (CDID) 	REFERENCES clientData(CDID)
);

CREATE TABLE clientRep (
  CRIP                INT(11)       NOT NULL AUTO_INCREMENT,
  CDID                INT(11)      	NOT NULL,
  upRep               INT(11)       NULL,
  downRep             INT(11)       NULL,
  rep                 INT(11)       NULL,
  followers           INT(11)       NULL,
  PRIMARY KEY (CRIP),
  FOREIGN KEY (CDID) 	REFERENCES clientData(CDID)
);

-- LID    = Login Identification
-- PWD    = Password, going to be using SHA-512
-- CDID   = Client Data Identification
CREATE TABLE login (
	LID                 INT(11)      	NOT NULL AUTO_INCREMENT,
	CDID                INT(11)     	NOT NULL,
	UName               VARCHAR(100)  NOT NULL UNIQUE,
	PWD                 VARCHAR(200)  NOT NULL,
	PRIMARY KEY (LID),
	FOREIGN KEY (CDID) 	REFERENCES clientData(CDID)
);

-- TID    = Thread Identification
-- CDID   = Client Data Identification
CREATE TABLE thread (
  TID									INT(11)				NOT NULL  AUTO_INCREMENT,
  CDID								INT(11)				NOT NULL,
  title 							VARCHAR(500)	NOT NULL,
  info                TEXT(1000)    NOT NULL,
  created							TIMESTAMP			NOT NULL,
  PRIMARY KEY (TID),
  FOREIGN KEY (CDID) 	REFERENCES clientData(CDID)
);

-- TVID   = Thread View Identification
-- TID    = Thread Identification
-- CDID   = Client Data Identification
CREATE TABLE threadView (
  TVID                INT(11)       NOT NULL AUTO_INCREMENT,
  TID                 INT(11)       NOT NULL,
  CDID                INT(11)       NOT NULL,
  views               INT(11)       NOT NULL,
  upRep               INT(11)       NULL,
  downRep             INT(11)       NULL,
  PRIMARY KEY (TVID),
  FOREIGN KEY (TID) REFERENCES thread(TID),
  FOREIGN KEY (CDID) REFERENCES clientData(CDID)
);

-- PID    = Post Identification
-- CDID   = Client Data Identification
-- TID    = Thread Identification
CREATE TABLE post (
  PID                 INT(11)       NOT NULL AUTO_INCREMENT,
  CDID                INT(11)       NOT NULL,
  TID									INT(11)				NOT NULL,
  title               VARCHAR(500)  NOT NULL,
  info  							TEXT(3000)		NOT NULL,
  created							TIMESTAMP			NOT NULL,
  replies             INT(11)       NULL,
  views               INT(11)       NULL,
  PRIMARY KEY (PID),
  FOREIGN KEY (CDID) 	REFERENCES clientData(CDID),
  FOREIGN KEY (TID) 	REFERENCES thread(TID)
);

-- PVID   = Post View Identification
-- PID    = Post Identification
-- CDID   = Client Profile Identification
CREATE TABLE postView (
  PVID                INT(11)       NOT NULL AUTO_INCREMENT,
  PID                 INT(11)       NOT NULL,
  CDID                INT(11)       NOT NULL,
  views               INT(11)       NOT NULL,
  upRep               INT(11)       NULL,
  downRep             INT(11)       NULL,
  PRIMARY KEY (PVID),
  FOREIGN KEY (PID) REFERENCES post(PID),
  FOREIGN KEY (CDID) REFERENCES clientData(CDID)
);

-- RID    = Reply Identification
-- CDID   = Client Data Identification
-- TID    = Thread Identification
-- PID    = Post Identification
CREATE TABLE reply (
   RID                INT(11)       NOT NULL AUTO_INCREMENT,
   CDID               INT(11)       NOT NULL,
   TID                INT(11)       NOT NULL,
   PID								INT(11)				NOT NULL,
   content						TEXT(3000)		NOT NULL,
   created						TIMESTAMP			NOT NULL,
   PRIMARY KEY (RID),
   FOREIGN KEY (CDID) 	REFERENCES clientData(CDID),
   FOREIGN KEY (PID) 	REFERENCES post(PID)
);

-- RRID   = Reply Reputation  Identification
-- RID    = Reply Identification
-- CDID   = Client Data Identification
CREATE TABLE replyRep (
  RRID                INT(11)       NOT NULL AUTO_INCREMENT,
  CDID                INT(11)       NOT NULL,
  RID                 INT(11)       NOT NULL,
  upRep               INT(11)       NULL,
  downRep             INT(11)       NULL,
  PRIMARY KEY (RRID),
  FOREIGN KEY (CDID) REFERENCES clientData(CDID),
  FOREIGN KEY (RID) REFERENCES reply(RID)
);



INSERT INTO `clientData` (`CDID`, `fName`, `lName`, `email`) VALUES
(1, 'Arabella', 'NumNut', 'admin1@proxwebdev.com'),
(2, 'Mariah', 'MarMight', 'admin@proxwebdev.com'),
(3, 'megga', 'Phaggot', 'spambi@420blaze.it');

INSERT INTO `clientProfile` (`CPIP`, `CDID`, `displayName`, `UIMG`, web, social, postNo) VALUES
(1, 1, 'ara', 'stars.jpeg', 'proxwebdev.com', 'www.facebook.com', NULL),
(2, 2, 'marmight', '11e79c5bd7cf103d.png', 'proxwebdev.com', 'www.facebook.com', NULL),
(3, 3, 'morgs', '44fdc40.jpg', 'proxwebdev.com', 'www.facebook.com', NULL);

INSERT INTO `clientRep` (`CRIP`, `CDID`, `uprep`, `downrep`, rep, followers) VALUES
(1, 1, NULL, NULL, NULL, NULL),
(2, 2, NULL, NULL, NULL, NULL),
(3, 3, NULL, NULL, NULL, NULL);

INSERT INTO `login` (`LID`, `CDID`, `UName`, `PWD`) VALUES
(1, 1, 'atcav', 'e6c83b282aeb2e022844595721cc00bbda47cb24537c1779f9bb84f04039e1676e6ba8573e588da1052510e3aa0a32a9e55879ae22b0c2d62136fc0a3e85f8bb'),
(2, 2, 'admin', 'e6c83b282aeb2e022844595721cc00bbda47cb24537c1779f9bb84f04039e1676e6ba8573e588da1052510e3aa0a32a9e55879ae22b0c2d62136fc0a3e85f8bb'),
(3, 3, 'spambi', '5e84464887949a798486c8ade17b49fc67a451eaee75f5e91aad42ea47060ceb5f9a4fd49eb487c9d851aac45fa788b7cfcb5408ad258bb017ea0b60bb17bfb1');

INSERT INTO `thread` (`TID`, `CDID`, `title`, `info`, `created`) VALUES
(1, 1, 'Youtube', 'Videos for all', '2019-04-25 16:49:37'),
(2, 1, 'Microsoft', 'OS for approximately 75% of all PCs', '0000-00-00 00:00:00'),
(3, 1, 'Tesla', 'Best Car manufacturer', '2019-04-25 16:51:24'),
(4, 1, 'MEMES', 'For the guys', '2019-04-25 16:51:34'),
(5, 1, 'America', 'The Big BOI', '2019-04-28 17:39:25');

INSERT INTO `post` (`PID`, `CDID`, `TID`, `title`, `info`, `created`, `replies`, `views`) VALUES
(1, 1, 1, 'What Happened to BF1', 'info', '2019-04-28 19:35:11', NULL, NULL),
(2, 1, 2, 'Windows Updates :(', 'info', '2019-04-28 19:54:09', NULL, NULL),
(3, 1, 3, '2020 Roadster', 'info', '2019-05-13 19:41:48', NULL, NULL),
(4, 1, 4, 'WEEEEEE', 'info', '2019-05-13 19:43:36', NULL, NULL),
(5, 1, 5, 'The land down under', 'info', '2019-05-13 19:43:49', NULL, NULL);

INSERT INTO `reply` (`RID`, `CDID`, `TID`, `PID`, `content`, `created`) VALUES
(1, 1, 1, 1, 'you\'re great', '2019-05-28 17:23:28'),
(2, 2, 1, 1, 'ahahahahahhahah your so funny', '2019-05-28 17:23:48'),
(3, 2, 1, 1, 'you\'re*', '2019-05-28 17:24:09'),
(4, 1, 1, 1, 'hi there', '2019-05-30 16:54:46'),
(5, 1, 1, 1, 'good job', '2019-05-30 20:43:58'),
(6, 1, 1, 1, 'asdljsldkjfak;jsdfkasdhf;has;dgfd', '2019-06-03 15:52:28'),
(7, 3, 1, 1, 'i love motivational speakers', '2019-06-03 17:24:22');