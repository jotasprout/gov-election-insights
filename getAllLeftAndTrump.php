<?php

require_once '../../secret_php/prezdb.php';

$connekt = new mysqli($GLOBALS['host'],$GLOBALS['un'],$GLOBALS['magicword'],$GLOBALS['db']);

if (!$connekt) {
    echo 'Shit! Did not connect.';
};

$allLeftAndTrump = "SELECT * FROM results2016 r
WHERE (r.candidateID IN  (3,1,12,13,14,17,18,20,22,27,28,30,31)
OR r.candidateID = 29)
AND r.popVotes > 0";

$result = mysqli_query($connekt, $allLeftAndTrump);

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