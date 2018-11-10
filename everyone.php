<?php

require_once '../../secret_php/prezdb.php';

$connekt = new mysqli($GLOBALS['host'],$GLOBALS['un'],$GLOBALS['magicword'],$GLOBALS['db']);

if (!$connekt) {
    echo 'Shit! Did not connect.';
};

$everyone = "SELECT y.stateAbbr, z.stateName, y.candidateID, z.candidateName, z.partyAbbr, z.partyName, y.popVotes
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

$result = mysqli_query($connekt, $everyone);

if (!$result){
    echo "Nope. I got nothin.";
}
else {
    $rows = array();
    while ($row = mysqli_fetch_array($result)) {
		$row['popVotes'] = (int) $row['popVotes'];
        $rows[] = $row;
    }
    echo json_encode($rows);
}

mysqli_close($connekt);
?>