<?php
					
$getSocialistResults = "SELECT y.*, z.candidateName
						FROM (SELECT r.stateAbbr, r.popVotes, r.candidateID
							FROM results2016 r
							WHERE r.candidateID IN
								(SELECT a.candidateID 
								FROM affiliations2016 a 
								JOIN (SELECT * FROM partiesspectrum WHERE rating = 1) p 
								ON a.partyAbbr = p.partyAbbr)
							AND r.candidateID != 3
							AND r.popVotes > 0) y
						JOIN candidates2016 z
						ON z.candidateID = y.candidateID
						ORDER BY y.stateAbbr";

$getSocialistPartyAbbr = "SELECT * FROM spectrum WHERE rating = '1'";

$getSocialistParties = "SELECT parties.partyName, parties1.partyAbbr FROM parties 
						JOIN (SELECT * FROM spectrum WHERE rating = '1') parties1 
						ON parties1.partyAbbr = parties.partyAbbr";

$getSocialists = "SELECT a.candidateID, a.partyAbbr, p.partyName, c.candidateName
						FROM affiliations2016 a
						JOIN candidates2016 c
						ON a.candidateID = c.candidateID
						JOIN (SELECT * FROM partiesspectrum WHERE rating = 1) p
						ON a.partyAbbr = p.partyAbbr";

$getCandidateAndPartyAbbr = "SELECT c.candidateID, c.candidateName, a.partyAbbr
								FROM candidates2016 c
								JOIN affiliations2016 a
										ON a.candidateID = c.candidateID";

// SELECT c.candidateID, c.candidateName, a.partyAbbr FROM candidates2016 c JOIN affiliations2016 a ON a.candidateID = c.candidateID;

$sofar="INSERT INTO partiesspectrum SELECT parties.partyAbbr, parties.partyName, spectrum.rating, spectrum.spectrum FROM parties LEFT JOIN spectrum ON parties.partyAbbr = spectrum.partyAbbr";

$addy="update spectrum set spectrum = 'neither' where rating = 0";

// Below this line is experimental

SELECT * FROM affiliations2016 a JOIN (SELECT * FROM partiesspectrum WHERE rating = 1) p ON a.partyAbbr = p.partyAbbr;

$newTable = "CREATE TABLE partiesspectrum (partyAbbr varchar(3) NOT NULL, PRIMARY KEY (partyAbbr), partyName varchar(72) NOT NULL, rating int(1) NOT NULL, INDEX rating_index (rating), spectrum varchar(12) NOT NULL, INDEX spectrum_index (spectrum)) ENGINE=InnoDB";

$dropKick="ALTER TABLE affiliations2016 DROP FOREIGN KEY affiliations2016_ibfk_2";

$newKick="ALTER TABLE affiliations2016 ADD CONSTRAINT partyAbbr_ibfk FOREIGN KEY(partyAbbr) REFERENCES partiesspectrum (partyAbbr) ON UPDATE CASCADE ON DELETE CASCADE";

?>