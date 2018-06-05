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

// Below this line is experimental

?>