<?php

$getSocialists = "SELECT a.candidateID, a.partyAbbr, p.partyName, c.candidateName FROM affiliations2016 a JOIN candidates2016 c ON a.candidateID = c.candidateID JOIN (SELECT * FROM partiesspectrum WHERE rating = 1) p ON a.partyAbbr = p.partyAbbr";

$getResultsFL = "SELECT * from results2016 WHERE stateAbbr = 'FL'"; 

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

$getSocialistResultsFL = "SELECT f.candidateID, f.stateAbbr, f.popVotes, s.partyAbbr, s.partyName, s.candidateName
FROM results2016 f
JOIN (SELECT a.candidateID, a.partyAbbr, p.partyName, c.candidateName 
        FROM affiliations2016 a 
        JOIN candidates2016 c 
            ON a.candidateID = c.candidateID 
        JOIN (SELECT * FROM partiesspectrum WHERE rating = 1) p 
            ON a.partyAbbr = p.partyAbbr) s 
    ON s.candidateID = f.candidateID
ORDER BY f.stateAbbr";

?>