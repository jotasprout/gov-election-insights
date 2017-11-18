CREATE DATABASE prezplaypro;

CREATE TABLE 2016results (
  stateAbbr varchar(2) NOT NULL,
  candidateID int(2) NOT NULL,
  popVotes int(7) NOT NULL,
  INDEX (stateAbbr),
  INDEX (candidateID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE 2012results (
  stateAbbr varchar(2) NOT NULL,
  candidateID int(2) NOT NULL,
  popVotes int(7) NOT NULL,
  INDEX (stateAbbr),
  INDEX (candidateID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE 2012candidates (
  candidateID int(2) NOT NULL,
  candidateName varchar(72) NOT NULL,
  PRIMARY KEY (candidateID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE 2016candidates (
  candidateID int(2) NOT NULL,
  candidateName varchar(72) NOT NULL,
  PRIMARY KEY (candidateID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE parties (
  partyAbbr varchar(3) NOT NULL,
  partyName varchar(72) NOT NULL,
  PRIMARY KEY (partyAbbr),
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE 2016affiliations (
	albumID varchar(48) NOT NULL UNIQUE,
	albumName varchar(255) NOT NULL,
	artistID varchar(48) NOT NULL,
	year varchar(4) NOT NULL,
	PRIMARY KEY (albumID),
	FOREIGN KEY (artistID) REFERENCES artists (artistID),
	INDEX (year),
	INDEX (artistID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE states (
  stateAbbr varchar(2) NOT NULL,
  stateName varchar(72) NOT NULL,
  stateEC int(2) NOT NULL,
  PRIMARY KEY (stateAbbr),
) ENGINE=InnoDB DEFAULT CHARSET=latin1;