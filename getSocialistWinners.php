<?php

require_once '../../secret_php/prezdb.php';

$connekt = new mysqli($GLOBALS['host'],$GLOBALS['un'],$GLOBALS['magicword'],$GLOBALS['db']);

if (!$connekt) {
    echo 'Shit! Did not connect.';
};

$prezScabies = "SELECT f.candidateID as candidateID, f.candidateName as candidateName, f.partyAbbr as partyAbbr, f.rating, f.partyName, f.stateAbbr as stateAbbr, r1.maxPopVotes
FROM (SELECT x.candidateID as candidateID, x.candidateName as candidateName, x.partyAbbr as partyAbbr, s.rating, s.partyName, x.stateAbbr as stateAbbr 
        FROM (SELECT a.candidateID as candidateID, c.candidateName as candidateName, a.partyAbbr as partyAbbr, a.stateAbbr as stateAbbr 
                FROM (SELECT candidateID, partyAbbr, stateAbbr FROM affiliations2016) a
        JOIN candidates2016 c ON a.candidateID = c.candidateID) x
        JOIN (SELECT rating, partyAbbr, partyName FROM partiesspectrum) s ON s.partyAbbr = x.partyAbbr
        WHERE (s.rating = 1) OR (s.rating = 0 AND x.candidateID = 14)) f
INNER JOIN (SELECT r.*
            FROM results2016 r
            INNER JOIN (SELECT candidateID, stateAbbr, max(popVotes) AS maxPopVotes 
                        FROM results2016 x
						WHERE x.candidateID IN
							(SELECT a.candidateID 
							FROM affiliations2016 a 
							JOIN (SELECT * FROM partiesspectrum WHERE rating = 1) p 
							ON a.partyAbbr = p.partyAbbr)
						AND x.candidateID != 3
						AND x.popVotes > 0
                        GROUP BY stateAbbr) groupedr 
            ON r.candidateID = groupedr.candidateID 
            AND r.stateAbbr = groupedr.stateAbbr) r1
ON r1.candidateID = f.candidateID AND r1.stateAbbr = f.stateAbbr";

$getSocialistWinners = "SELECT m.stateAbbr, m.stateName, m.candidateID, m.candidateName, max(m.popVotes) AS mostVotes 
FROM (SELECT y.*, z.candidateName, k.stateName
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
			JOIN states k
			ON k.stateAbbr = y.stateAbbr) m
			GROUP BY m.stateAbbr";

$getScabiesResults = "SELECT y.*
						FROM (SELECT r.stateAbbr, r.maxPopVotes, r.candidateID
							FROM (SELECT candidateID, stateAbbr, max(popVotes) AS maxPopVotes 
									FROM results2016 
									GROUP BY stateAbbr) r
							WHERE r.candidateID IN
								(SELECT a.candidateID 
								FROM affiliations2016 a 
								JOIN (SELECT * FROM partiesspectrum WHERE rating = 1) p 
								ON a.partyAbbr = p.partyAbbr)
						) y
						JOIN candidates2016 z
						ON z.candidateID = y.candidateID";

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

$result = mysqli_query($connekt, $getSocialistWinners);

if (!$result){
    echo "Nope. I got nothin.";
}
else {
    $rows = array();
    while ($row = mysqli_fetch_array($result)) {
        $rows[] = $row;
    }
    echo json_encode($rows);
}

mysqli_close($connekt);
?>