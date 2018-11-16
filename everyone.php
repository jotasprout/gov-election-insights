<?php

require_once '../../secret_php/prezdb.php';

$connekt = new mysqli($GLOBALS['host'],$GLOBALS['un'],$GLOBALS['magicword'],$GLOBALS['db']);

if (!$connekt) {
    echo 'Shit! Did not connect.';
};

$everyone = "SELECT y.*, c.candidateName, s.stateName, a.partyAbbr, a.partyName
                    FROM (SELECT r.* FROM results2016 r WHERE r.popVotes > 0) y
                    JOIN affiliations2 a ON y.candidateID = a.candidateID AND y.stateAbbr = a.stateAbbr
                    JOIN candidates2016 c ON c.candidateID = y.candidateID
                    JOIN states s ON s.stateAbbr = y.stateAbbr
                ORDER BY y.stateAbbr";

$result = mysqli_query($connekt, $everyone);

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
    header('Content-Type: application/json');
    echo json_encode($rows);
}

mysqli_close($connekt);
?>