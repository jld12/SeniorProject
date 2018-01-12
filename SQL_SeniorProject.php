// This file contains the isolated SQL from my senior project.

//////////////////////////////////////////////////////////////////////////////////

// Gathers quest run information for a specific user's account.
$q = "SELECT 
	questRuns.runEX AS Experience, 
	questRuns.runMS AS Meseta, 
	questRuns.runDF AS Difficulty, 
	accounts.accountUN AS Username, 
	quests.questNM AS QuestName, 
	questRuns.runTM AS RunTime, 
	questRuns.questID AS QuestNum 
FROM questRuns 
	INNER JOIN quests ON questRuns.questID = quests.questID) 
	INNER JOIN accounts ON questRuns.accountID = accounts.accountID) 
WHERE accounts.accountUN = '" . $_SESSION['accountUN'] . "'";


// Selects a specific client order to show information about it.
$q = "SELECT 
	clientOrders.clientDS, 
	clientOrders.clientNM, 
	clientOrders.clientMS, 
	clientOrders.clientEX, 
	zones.zoneNM, zones.zoneID, 
	npcs.npcID, 
	npcs.npcNM 
FROM 
	(((clientOrders INNER JOIN zoneClientOrders ON zoneClientOrders.clientID = clientOrders.clientID) 
	INNER JOIN zones ON zones.zoneID = zoneClientOrders.zoneID) 
	INNER JOIN npcs ON clientOrders.npcID = npcs.npcID) 
WHERE clientOrders.clientID = '$clientNum'";


// Updates a user's password.
$q = "UPDATE accounts SET accountPW='$saltpw' WHERE accountID='$userID'";


// Selects a specific NPC to show information about them.

// Version 1 (No zone):
$q = "SELECT 
	clientOrders.clientID AS ClientNum, 
	clientOrders.clientNM AS ClientName, 
	clientOrders.clientMS AS Meseta, 
	clientOrders.clientEX AS EXP
FROM (clientOrders INNER JOIN npcs ON clientOrders.npcID = npcs.npcID)
WHERE npcs.npcID = '$npcNum'";

// Version 2 (Zones):
$q = "SELECT 
	clientOrders.clientID AS ClientNum, 
	clientOrders.clientNM AS ClientName, 
	clientOrders.clientMS AS Meseta, 
	clientOrders.clientEX AS EXP, 
	zones.zoneNM AS ZoneName
FROM 
	(((clientOrders INNER JOIN npcs ON clientOrders.npcID = npcs.npcID) 
	INNER JOIN zoneClientOrders ON zoneClientOrders.clientID = clientOrders.clientID)
	INNER JOIN zones ON zones.zoneID = zoneClientOrders.zoneID)
WHERE npcs.npcID = '$npcNum'";


// Selects a specific quest to show information about it.
$q = "SELECT 
	quests.questDS, quests.questNM, 
	zones.zoneID, zones.zoneNM 
FROM quests INNER JOIN zones ON zones.zoneID = quests.zoneID 
WHERE questID ='$questNum'";


// Show a list of runs of a quest, sorted by fastest run time.
$q = "SELECT 
	questRuns.runEX AS Experience, 
	questRuns.runMS AS Meseta, 
	questRuns.runDF AS Difficulty, 
	accounts.accountUN AS Username, 
	quests.questID AS QuestNum, 
	quests.questNM AS QuestName, 
	questRuns.runTM AS RunTime, 
	questRuns.questID AS QuestNum 
FROM 
	((questRuns INNER JOIN quests ON questRuns.questID = quests.questID) 
	INNER JOIN accounts ON questRuns.accountID = accounts.accountID) 
WHERE quests.questID = '$questNum' 
ORDER BY RunTime ASC";


// Show a list of client orders in the same zone as the quest.
$q = "SELECT DISTINCT 
	clientOrders.clientID AS ClientNum, 
	clientOrders.clientNM AS ClientName, 
	npcs.npcNM AS NPCName, 
	npcs.npcID,
	clientOrders.clientMS AS Meseta, 
	clientOrders.clientEX AS EXP, 
	zoneClientOrders.zoneID
FROM 
	(( clientOrders INNER JOIN npcs ON npcs.npcID = clientOrders.npcID) 
	INNER JOIN zoneClientOrders ON zoneClientOrders.clientID = clientOrders.clientID)
WHERE zoneClientOrders.zoneID = '$zoneNum'";


// Adds a new user to the DB.
$q = "INSERT INTO accounts 
(accountUN, accountEM, accountPW, accountSE, accountRD) 
VALUES 
('$un', '$em', '$saltpw', '$se', '" . date("Y-m-d") . "' )";


// Select a list of quests in a specified zone.
$q = "SELECT questID, questNM 
FROM quests INNER JOIN zones ON zones.zoneID = quests.zoneID 
WHERE quests.zoneID = '$zoneNum'";


// Selects a client order by name.
$q = "SELECT clientID FROM clientOrders WHERE clientNM = '$clientName'";


// Selects an NPC by name.
$q = "SELECT npcID FROM npcs WHERE npcNM = '$npcName'";


// Select a list of client orders in a specific zone.
$q = "SELECT 
	clientOrders.clientID, 
	clientOrders.clientNM, 
	clientOrders.clientMS, 
	clientOrders.clientEX 
FROM 
	((clientOrders INNER JOIN zoneClientOrders ON clientOrders.clientID = zoneClientOrders.clientID)
	INNER JOIN zones ON zoneClientOrders.zoneID = zones.zoneID) 
WHERE zones.zoneID = '$zoneNum'";


// Insert a new quest run into the DB.
$q = "INSERT INTO questRuns 
(runEX, runMS, runDF, runTM, accountID, questID) 
VALUES 
('$expTotal', '$mesTotal', '$questDiff', '$questTime', '$questAcct', '$questNum')";


// View a list of quest runs (all runs).
$q = "SELECT 
	questRuns.runID AS RunNum, 
	questRuns.runEX AS Experience, 
	questRuns.runMS AS Meseta, 
	questRuns.runDF AS Difficulty, 
	accounts.accountUN AS Username, 
	quests.questNM AS QuestName, 
	questRuns.runTM AS RunTime, 
	questRuns.questID AS QuestNum 
FROM 
	((questRuns INNER JOIN quests ON questRuns.questID = quests.questID) 
	INNER JOIN accounts ON questRuns.accountID = accounts.accountID)";


// View a list of quest runs (grouped by quest). Note: Quests are a limited set of repeatable missions.
$q = "SELECT 
	ROUND( AVG(questRuns.runTM),0 ) AS RunTime, 
	ROUND( AVG(questRuns.runEX),0 ) AS Experience, 
	ROUND( AVG(questRuns.runMS),0 ) AS Meseta, 
	quests.questNM AS QuestName, quests.questID AS QuestNum, 
	questRuns.accountID 
FROM 
	((questRuns INNER JOIN quests ON questRuns.questID = quests.questID) 
	INNER JOIN accounts ON questRuns.accountID = accounts.accountID) 
GROUP BY questNM";


// Select a limited set of data about users.
$q = "SELECT 
	accountID AS UserID, 
	accountUN AS Username, 
	accountRD AS RegisterDate 
FROM accounts ORDER BY accountID ASC";


// Delete quest run.
$dq = "DELETE FROM questRuns WHERE runID = '$runNum'";

// Delete user.
$dq = "DELETE FROM accounts WHERE accountID = '$accountNum'";


//////////////////////////////////////////////////////////////////////////////////

// Various basic queries.
$q = "SELECT accountPW FROM accounts WHERE accountEM='$em'";
$q = "SELECT accountID, accountUN FROM accounts WHERE accountID='$userID'";
$q = "SELECt questNM AS QuestName, questID AS QuestNum FROM quests WHERE zoneID = '$zoneNum'";
$q = "SELECT accountPW FROM accounts WHERE accountEM='$em'";
$q = "SELECT accountID, accountUN, accountEM, accountTY FROM accounts WHERE accountEM='$em'";
$q = "SELECT npcNM FROM npcs WHERE npcID = '$npcNum'";
$q = "SELECT zones.zoneID 
FROM zones INNER JOIN quests on zones.zoneID = quests.zoneID 
WHERE questID='$questNum'";
$q = "SELECT accountEM FROM accounts WHERE accountEM='$em'";
$q = "SELECT accountUN FROM accounts WHERE accountUN='$un'";
$q = "SELECT zoneID FROM zones WHERE zoneNM = '$zoneName'";
$q = "SELECT questNM, questID FROM quests";
$q = "SELECT zoneNM, zoneID FROM zones";
$q = "SELECT clientNM, clientID FROM clientOrders";
$q = "SELECT npcNM, npcID FROM npcs";
$q = "SELECT zoneNM, zoneID FROM zones";
$q = "SELECT questID FROM quests WHERE questNM ='$questName'";

//////////////////////////////////////////////////////////////////////////////////

// CODE FOR DB; TRIGGERS //

// These triggers exists to prevent rows from being removed tables where rows should not be deleted.
// The triggers function by calling a nonexistent 'do_not_delete'.


DROP TRIGGER IF EXISTS `delete_prevent_clientorders`;
DELIMITER //
CREATE TRIGGER `delete_prevent_clientorders` BEFORE DELETE ON `clientOrders`
 FOR EACH ROW call do_not_delete()
//
DELIMITER ;

DROP TRIGGER IF EXISTS `delete_prevent_npcs`;
DELIMITER //
CREATE TRIGGER `delete_prevent_npcs` BEFORE DELETE ON `npcs`
 FOR EACH ROW call do_not_delete()
//
DELIMITER ;

DROP TRIGGER IF EXISTS `delete_prevent_quests`;
DELIMITER //
CREATE TRIGGER `delete_prevent_quests` BEFORE DELETE ON `quests`
 FOR EACH ROW call do_not_delete()
//
DELIMITER ;

DROP TRIGGER IF EXISTS `delete_prevent_zoneclientorders`;
DELIMITER //
CREATE TRIGGER `delete_prevent_zoneclientorders` BEFORE DELETE ON `zoneClientOrders`
 FOR EACH ROW call do_not_delete()
//
DELIMITER ;

DROP TRIGGER IF EXISTS `delete_prevent_zones`;
DELIMITER //
CREATE TRIGGER `delete_prevent_zones` BEFORE DELETE ON `zones`
 FOR EACH ROW call do_not_delete()
//
DELIMITER ;



// CODE FOR DB; CREATION //

// Accounts table.
CREATE TABLE IF NOT EXISTS `accounts` (
  `accountID` int(11) NOT NULL AUTO_INCREMENT,
  `accountUN` varchar(15) NOT NULL,
  `accountPW` varchar(100) NOT NULL,
  `accountEM` varchar(30) NOT NULL,
  `accountTY` int(11) NOT NULL DEFAULT '1',
  `accountSE` varchar(30) NOT NULL,
  `accountRD` date NOT NULL,
  PRIMARY KEY (`accountID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21;


// Client order table.
CREATE TABLE IF NOT EXISTS `clientOrders` (
  `clientID` int(11) NOT NULL AUTO_INCREMENT,
  `clientNM` varchar(35) NOT NULL,
  `clientEX` int(11) NOT NULL,
  `clientMS` int(11) NOT NULL,
  `npcID` int(11) NOT NULL,
  `clientDS` varchar(60) NOT NULL,
  PRIMARY KEY (`clientID`),
  KEY `npcID` (`npcID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23;


// NPC table.
CREATE TABLE IF NOT EXISTS `npcs` (
  `npcID` int(11) NOT NULL AUTO_INCREMENT,
  `npcNM` varchar(15) NOT NULL,
  PRIMARY KEY (`npcID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18;


// Quest run table.
CREATE TABLE IF NOT EXISTS `questRuns` (
  `runID` int(11) NOT NULL AUTO_INCREMENT,
  `runEX` int(11) NOT NULL,
  `runMS` int(11) NOT NULL,
  `runDF` varchar(15) NOT NULL,
  `runTM` int(11) NOT NULL,
  `accountID` int(11) NOT NULL,
  `questID` int(11) NOT NULL,
  PRIMARY KEY (`runID`),
  KEY `accountID` (`accountID`,`questID`),
  KEY `questID` (`questID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31;


// Quest table.
CREATE TABLE IF NOT EXISTS `quests` (
  `questID` int(11) NOT NULL AUTO_INCREMENT,
  `questNM` varchar(40) NOT NULL,
  `zoneID` int(11) NOT NULL,
  `questDS` varchar(60) NOT NULL,
  PRIMARY KEY (`questID`),
  KEY `zoneID` (`zoneID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57;


// Client order table.
CREATE TABLE IF NOT EXISTS `zoneClientOrders` (
  `zcoID` int(11) NOT NULL AUTO_INCREMENT,
  `zoneID` int(11) NOT NULL,
  `clientID` int(11) NOT NULL,
  PRIMARY KEY (`zcoID`),
  KEY `zoneID` (`zoneID`,`clientID`),
  KEY `clientID` (`clientID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=68;


// Zone table.
CREATE TABLE IF NOT EXISTS `zones` (
  `zoneID` int(11) NOT NULL AUTO_INCREMENT,
  `zoneNM` varchar(15) NOT NULL,
  PRIMARY KEY (`zoneID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17;



// CODE FOR DB; CONSTRAINTS //

ALTER TABLE `clientOrders`
  ADD CONSTRAINT `clientOrders_ibfk_1` FOREIGN KEY (`npcID`) REFERENCES `npcs` (`npcID`);
  
ALTER TABLE `questRuns`
  ADD CONSTRAINT `questRuns_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `accounts` (`accountID`),
  ADD CONSTRAINT `questRuns_ibfk_2` FOREIGN KEY (`questID`) REFERENCES `quests` (`questID`);
  
ALTER TABLE `quests`
  ADD CONSTRAINT `quests_ibfk_1` FOREIGN KEY (`zoneID`) REFERENCES `zones` (`zoneID`);
  
ALTER TABLE `zoneClientOrders`
  ADD CONSTRAINT `zoneClientOrders_ibfk_1` FOREIGN KEY (`zoneID`) REFERENCES `zones` (`zoneID`),
  ADD CONSTRAINT `zoneClientOrders_ibfk_2` FOREIGN KEY (`clientID`) REFERENCES `clientOrders` (`clientID`);


