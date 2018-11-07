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

$getAllResults = "SELECT y.*, z.candidateName, s.stateName
                    FROM (SELECT r.stateAbbr, r.popVotes, r.candidateID
                        FROM results2016 r
                        WHERE r.popVotes > 0) y
                        JOIN candidates2016 z
                        ON z.candidateID = y.candidateID
                        JOIN states s ON s.stateAbbr = y.stateAbbr
                        ORDER BY y.stateAbbr";

mysqli_close($connekt);
?>