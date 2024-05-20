CREATE TABLE `users` (
  `userid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `isActive` int(2) NOT NULL DEFAULT 0,
  PRIMARY KEY(`userid`)
);

INSERT INTO users
VALUES (1, "johnDoe@yahoo.com", "password", 1),
       (2, "bobMarley@gmail.com", "pass", 0),
       (3, "jackSmith@yahoo.com", "word", 0);

CREATE TABLE `preferences` (
  `userid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `day` int(2) unsigned NOT NULL DEFAULT 0,
  `night` int(2) unsigned NOT NULL DEFAULT 0,
  `online` int(2) unsigned NOT NULL DEFAULT 0,
  `inperson` int(2) unsigned NOT NULL DEFAULT 0,
  `math` int(2) unsigned NOT NULL DEFAULT 0,
  `english` int(2) unsigned NOT NULL DEFAULT 0,
  `computerScience` int(2) unsigned NOT NULL DEFAULT 0,
  `history` int(2) unsigned NOT NULL DEFAULT 0,
  `science` int(2) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY(`userid`)
);

INSERT INTO preferences
VALUES (1, 1, 0, 1, 0, 0, 0, 0, 0, 0),
       (2, 0, 0, 1, 0, 1, 0, 0, 0, 0),
       (3, 1, 0, 0, 0, 0, 0, 0, 0, 0);

CREATE TABLE `allMatchesValues` (
  `userid` int(10) NOT NULL,
  `mentorImgUrl` varchar(100) NOT NULL,
  PRIMARY KEY (`userid`, `mentorImgUrl`) 
);  

INSERT INTO allMatchesValues (userid, mentorImgUrl) VALUES (1, "swipeResources/cards/1.png");
INSERT INTO allMatchesValues (userid, mentorImgUrl) VALUES (1, "swipeResources/cards/2.png");
INSERT INTO allMatchesValues (userid, mentorImgUrl) VALUES (1, "swipeResources/cards/3.png");


