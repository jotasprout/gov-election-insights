<?php

$getSocialists = "SELECT a.candidateID, a.partyAbbr, p.partyName, c.candidateName FROM affiliations2016 a JOIN candidates2016 c ON a.candidateID = c.candidateID JOIN (SELECT * FROM partiesspectrum WHERE rating = 1) p ON a.partyAbbr = p.partyAbbr";

$getResultsFL = "SELECT * from results2016 WHERE stateAbbr = 'FL'"; 

$getResults = "SELECT * from results2016 WHERE popVotes > 0 ORDER BY stateAbbr"; 

$getSocialistResultsFL = "SELECT f.candidateID, f.stateAbbr, f.popVotes, s.partyAbbr, s.partyName, s.candidateName
FROM (SELECT * from results2016 WHERE stateAbbr = 'FL') f
JOIN (SELECT a.candidateID, a.partyAbbr, p.partyName, c.candidateName 
        FROM affiliations2016 a 
        JOIN candidates2016 c 
            ON a.candidateID = c.candidateID 
        JOIN (SELECT * FROM partiesspectrum WHERE rating = 1) p 
            ON a.partyAbbr = p.partyAbbr) s 
    ON s.candidateID = f.candidateID
ORDER BY f.popVotes";

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

?>