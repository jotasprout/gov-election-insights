<?php

require_once '../../secret_php/prezdb.php';

$connekt = new mysqli($GLOBALS['host'],$GLOBALS['un'],$GLOBALS['magicword'],$GLOBALS['db']);

if (!$connekt) {
    echo 'Shit! Did not connect.';
};

$everyone = "SELECT r.*, c.candidateName, s.stateName, a.partyAbbr
                    FROM (SELECT * FROM results2016 WHERE popVotes > 0) r
                    LEFT JOIN affiliations2016 a ON r.candidateID = a.candidateID AND r.stateAbbr = a.stateAbbr
                    JOIN candidates2016 c ON c.candidateID = r.candidateID
                    JOIN states s ON s.stateAbbr = r.stateAbbr
                ORDER BY r.stateAbbr";

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