<?php

require_once '../../secret_php/prezdb.php';

$connekt = new mysqli($GLOBALS['host'],$GLOBALS['un'],$GLOBALS['magicword'],$GLOBALS['db']);

if (!$connekt) {
    echo 'Shit! Did not connect.';
};

$getSocialists = "SELECT DISTINCT a.candidateID, a.partyAbbr, p.partyName, c.candidateName
						FROM affiliations2016 a
						JOIN candidates2016 c
						ON a.candidateID = c.candidateID
						JOIN (SELECT * FROM partiesspectrum WHERE rating = 1) p
                        ON a.partyAbbr = p.partyAbbr";
                        
$allLeft = array (3,1,12,13,14,17,18,20,22,27,28,30,31);

$allRight = array (2,4,7,8,9,11,15,25,29);

$allRightNoTrump = array (2,4,7,8,9,11,15,25);

$steingreen = 28;
$johnsonlibertarian = 11;

$getAffiliationsWithParties = "SELECT a.stateAbbr, a.candidateID, c.candidateName, a.partyAbbr, p.partyName, s.stateName
                                FROM affiliations2016 a
                                JOIN partiesspectrum p ON a.partyAbbr = p.partyAbbr
                                JOIN candidates2016 c ON c.candidateID = a.candidateID
                                JOIN states s ON s.stateAbbr = a.stateAbbr";

$getAllResultsWithParties = "SELECT y.stateAbbr, z.stateName, y.candidateID, z.candidateName, z.partyAbbr, z.partyName, y.popVotes
                                FROM (SELECT r.stateAbbr AS stateAbbr, r.popVotes AS popVotes, r.candidateID AS candidateID
                                    FROM results2016 r
                                    WHERE r.popVotes > 0) y
                                JOIN (SELECT a.stateAbbr, a.candidateID, c.candidateName, a.partyAbbr, p.partyName, s.stateName
                                        FROM affiliations2016 a
                                        JOIN partiesspectrum p ON a.partyAbbr = p.partyAbbr
                                        JOIN candidates2016 c ON c.candidateID = a.candidateID
                                        JOIN states s ON s.stateAbbr = a.stateAbbr) z 
                                ON z.stateAbbr = y.stateAbbr AND z.candidateID = y.candidateID
                                ORDER BY y.stateAbbr";

$getAllResults = "SELECT y.*, z.candidateName, s.stateName
                    FROM (SELECT r.stateAbbr, r.popVotes, r.candidateID
                        FROM results2016 r
                        WHERE r.popVotes > 0) y
                        JOIN candidates2016 z
                        ON z.candidateID = y.candidateID
                        JOIN states s ON s.stateAbbr = y.stateAbbr
                        ORDER BY y.stateAbbr";

$getSocialistResults = "SELECT y.*, z.candidateName, s.stateName
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
JOIN states s ON s.stateAbbr = y.stateAbbr
ORDER BY y.stateAbbr";

mysqli_close($connekt);
?>