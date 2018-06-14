<?php

// build this out modeling after Pop-PHP file createD3b.php
require_once '../../secret_php/prezdb.php';

$connekt = new mysqli('host','un','magicword','db');

if (!connekt) {
    echo 'Shit! Did not connect.';
};

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

$result = mysqli_query($connekt, $getSocialistResults);

if (msqli_num_rows($result) > 0) {
    $rows = array();
    while ($row = mysqli_fetch_array($result)) {
        $rows[] = $row;
    }
    echo json_encode($rows);
}
else {
    echo "Nope. I got nothin.";
}

mysqli_close($connekt);
?>