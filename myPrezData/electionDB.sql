CREATE DATABASE prezplaypro;

CREATE TABLE candidates (
  candidateID int(2) NOT NULL,
  candidateName varchar(72) NOT NULL,
  PRIMARY KEY (candidateID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE parties (
  partyAbbr varchar(3) NOT NULL,
  partyName varchar(72) NOT NULL,
  PRIMARY KEY (partyAbbr)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE states (
  stateAbbr varchar(2) NOT NULL,
  stateName varchar(72) NOT NULL,
  PRIMARY KEY (stateAbbr)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE electoralCollege (
  stateAbbr varchar(2) NOT NULL,
  year1992 int(2) NOT NULL,
  year2004 int(2) NOT NULL,
  year2012 int(2) NOT NULL,
  FOREIGN KEY (stateAbbr) REFERENCES states (stateAbbr)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE affiliations (
	candidateID int(2) NOT NULL,
	partyAbbr varchar(3) NOT NULL,
	year int(4) NOT NULL,
	FOREIGN KEY (candidateID) REFERENCES candidates (candidateID),
	FOREIGN KEY (partyAbbr) REFERENCES parties (partyAbbr),
  INDEX (candidateID),
	INDEX (partyAbbr),
  INDEX (year)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE results (
  stateAbbr varchar(2) NOT NULL,
  candidateID int(2) NOT NULL,
  popVotes int(7) NOT NULL,
  year int(4) NOT NULL,
  FOREIGN KEY (candidateID) REFERENCES candidates (candidateID),
  FOREIGN KEY (stateAbbr) REFERENCES states (stateAbbr),
  INDEX (stateAbbr),
  INDEX (candidateID),
  INDEX (year)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;