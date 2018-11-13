<?php

require_once '../../secret_php/prezdb.php';

$connekt = new mysqli($GLOBALS['host'],$GLOBALS['un'],$GLOBALS['magicword'],$GLOBALS['db']);

if (!$connekt) {
    echo 'Shit! Did not connect.';
};

$everyone2 = "SELECT y.*, c.candidateName, s.stateName, a.partyAbbr, x.partyName
                    FROM (SELECT r.* FROM results2016 r WHERE r.popVotes > 0) y
                    JOIN affiliations2016 a ON y.candidateID = a.candidateID AND y.stateAbbr = a.stateAbbr
                    JOIN candidates2016 c ON c.candidateID = y.candidateID
                    JOIN states s ON s.stateAbbr = y.stateAbbr
                    JOIN parties x ON x.partiesAbbr = a.partyAbbr
                ORDER BY y.stateAbbr";

$getAllResultsWithParties = "SELECT y.stateAbbr, s.stateName, y.candidateID, z.candidateName, z.partyAbbr, z.partyName, y.popVotes
                                FROM (SELECT r.stateAbbr AS stateAbbr, r.popVotes AS popVotes, r.candidateID AS candidateID
                                    FROM results2016 r
                                    WHERE r.popVotes > 0) y
                                JOIN (SELECT a.stateAbbr, a.candidateID, c.candidateName, a.partyAbbr, p.partyName
                                        FROM affiliations2016 a
                                        JOIN partiesspectrum p ON a.partyAbbr = p.partyAbbr
                                        JOIN candidates2016 c ON c.candidateID = a.candidateID) z 
                                ON z.stateAbbr = y.stateAbbr AND z.candidateID = y.candidateID
                                JOIN states s ON s.stateAbbr = y.stateAbbr
                                ORDER BY y.stateAbbr";

$simpleWorks1 = "SELECT r.stateAbbr, r.popVotes, r.candidateID, a.partyAbbr
            FROM (SELECT stateAbbr, popVotes, candidateID
                    FROM results2016
                    WHERE popVotes > 0) r
            JOIN affiliations2016 a ON r.candidateID = a.candidateID AND r.stateAbbr = a.stateAbbr";

$simple = "SELECT partyName FROM affiliations2";           

$result = mysqli_query($connekt, $simple);

if (!$result){
    echo "Nope. I got nothin.";
}
else {
    $rows = array();
    while ($row = mysqli_fetch_array($result)) {
        $rows[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($rows);
}

mysqli_close($connekt);
?>