<?php

$artistInfoRecentWithArt = "SELECT a.artistID AS artistID, a.artistArt AS artistArt, a.artistName AS artistName, p1.pop AS pop, p1.date AS date
    FROM artists a
    JOIN (SELECT p.*
			FROM popArtists p
			INNER JOIN (SELECT artistID, pop, max(date) AS MaxDate
						FROM popArtists  
						GROUP BY artistID) groupedp
			ON p.artistID = groupedp.artistID
			AND p.date = groupedp.MaxDate) p1
	ON a.artistID = p1.artistID
	ORDER BY p1.pop DESC";

$happyScabies2 = "SELECT a.albumName, a.year, a.albumArt, z.artistName, p1.pop, p1.date, a.albumID
	FROM (SELECT
				y.albumID AS albumID,
				y.albumName AS albumName,
				y.artistID AS artistID,
				y.albumArt AS albumArt,
				y.year AS year
			FROM albums y 
			WHERE y.artistID = '$artistID') a
	JOIN artists z ON z.artistID = '$artistID'
	JOIN (SELECT p.*
			FROM popAlbums p
			INNER JOIN (SELECT albumID, pop, max(date) AS MaxDate
						FROM popAlbums  
						GROUP BY albumID) groupedp
			ON p.albumID = groupedp.albumID
			AND p.date = groupedp.MaxDate) p1 
	ON a.albumID = p1.albumID
	ORDER BY year ASC;";

$getSocialistPartyAbbr = "SELECT * FROM spectrum WHERE rating = '1'";

$getSocialistParties = "SELECT parties.partyName, parties1.partyAbbr FROM parties 
						JOIN (SELECT * FROM spectrum WHERE rating = '1') parties1 
						ON parties1.partyAbbr = parties.partyAbbr";

$getSocCandidateID = "SELECT * FROM affiliations2016 a
					JOIN (SELECT parties.partyName, parties1.partyAbbr FROM parties 
						JOIN (SELECT * FROM spectrum WHERE rating = '1') parties1 
						ON parties1.partyAbbr = parties.partyAbbr) s
						ON a.partyAbbr = s.partyAbbr";

$getCandidateAndPartyAbbr = "SELECT c.candidateID, c.candidateName, a.partyAbbr
								FROM candidates2016 c
								JOIN affiliations2016 a
										ON a.candidateID = c.candidateID";

// SELECT c.candidateID, c.candidateName, a.partyAbbr FROM candidates2016 c JOIN affiliations2016 a ON a.candidateID = c.candidateID;

$sofar="INSERT INTO partiesspectrum SELECT parties.partyAbbr, parties.partyName, spectrum.rating, spectrum.spectrum FROM parties LEFT JOIN spectrum ON parties.partyAbbr = spectrum.partyAbbr";

$addy="update spectrum set spectrum = 'neither' where rating = 0";

// Below this line is experimental

$newTable = "CREATE TABLE partiesspectrum (partyAbbr varchar(3) NOT NULL, PRIMARY KEY (partyAbbr), partyName varchar(72) NOT NULL, rating int(1) NOT NULL, INDEX rating_index (rating), spectrum varchar(12) NOT NULL, INDEX spectrum_index (spectrum)) ENGINE=InnoDB";

$newPartiesSpectrumData="LOAD DATA LOCAL INFILE '~/Documents/github/prezPlayPro/myPrezData/partiesSpectrum.csv' INTO TABLE partiesspectrum";

$dropKick="ALTER TABLE affiliations2016 DROP FOREIGN KEY affiliations2016_ibfk_2";

$newKick="ALTER TABLE affiliations2016 ADD CONSTRAINT partyAbbr_ibfk FOREIGN KEY(partyAbbr) REFERENCES partiesspectrum (partyAbbr) ON UPDATE CASCADE ON DELETE CASCADE";
?>