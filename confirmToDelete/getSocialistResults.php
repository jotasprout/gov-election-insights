<?php

require_once '../../secret_php/prezdb.php';

$connekt = new mysqli($GLOBALS['host'],$GLOBALS['un'],$GLOBALS['magicword'],$GLOBALS['db']);

if (!$connekt) {
    echo 'Shit! Did not connect.';
};

$getSocialistResultsWithZero = "SELECT y.*, z.candidateName, s.stateName
FROM (SELECT r.stateAbbr, r.popVotes, r.candidateID
    FROM results2016 r
    WHERE r.candidateID IN
        (SELECT a.candidateID
        FROM affiliations2016 a 
        JOIN (SELECT * FROM partiesspectrum WHERE rating = 1) p 
        ON a.partyAbbr = p.partyAbbr)
    AND r.candidateID != 3) y
JOIN candidates2016 z ON z.candidateID = y.candidateID
JOIN states s ON s.stateAbbr = y.stateAbbr
ORDER BY y.stateAbbr";

$result = mysqli_query($connekt, $getSocialistResultsWithZero);

if (!$result){
    echo "Nope. I got nothin.";
}
else {
    $rows = array();
    while ($row = mysqli_fetch_array($result)) {
        $row['popVotes'] = (int) $row['popVotes'];
        $row['candidateID'] = (int) $row['candidateID'];
        $rows[] = $row;
    }
    echo json_encode($rows);
}

mysqli_close($connekt);
?>