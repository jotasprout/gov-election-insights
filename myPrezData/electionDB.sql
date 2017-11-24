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

LOAD DATA local INFILE "/var/www/html/prezplaypro/myPrezData/candidates.csv"
INTO TABLE candidates
FIELDS TERMINATED BY ","
LINES TERMINATED BY "\n"
(candidateID,candidateName);

INSERT INTO candidates2016 (candidateName) VALUES 
('Boogers McGee'), 
('Frank Atwood'), 
('Darrell L. Castle'), 
('Hillary Clinton'), 
('Scott Copeland'), 
('Roque "Rocky" De La Fuente'), 
('Richard Duncan'), 
('Rocky Giordani'), 
('James "Jim" Hedges'), 
('Tom Hoefling'), 
('Princess Jacob'), 
('Gary Johnson'), 
('Lynn S. Kahn'), 
('Chris Keniston'), 
('Alyson Kennedy'), 
('Kyle Kenley Kopitke'), 
('Laurence Kotlikoff'), 
('Gloria Estela La Riva'), 
('Bradford Lyttle'), 
('Joseph Allen Maldonado'), 
('Michael A. Maturen'), 
('Evan McMullin'), 
('Monica Moorehead'), 
('Ryan Alan Scott'), 
('Rod Silva'), 
('Peter Skewes'), 
('Mike Smith'), 
('Emidio Soltysik'), 
('Jill Stein'), 
('Donald J. Trump'), 
('Dan R. Vacek'), 
('Jerry White');

INSERT INTO parties (stateAbbr,stateName) VALUES
('AL','Alabama'),
('AK','Alaska'),
('AZ','Arizona'),
('AR','Arkansas'),
('CA','California'),
('CO','Colorado'),
('CT','Connecticut'),
('DE','Delaware'),
('DC','District of Columbia'),
('FL','Florida'),
('GA','Georgia'),
('HI','Hawaii'),
('ID','Idaho'),
('IL','Illinois'),
('IN','Indiana'),
('IA','Iowa'),
('KS','Kansas'),
('KY','Kentucky'),
('LA','Louisiana'),
('ME','Maine'),
('MD','Maryland'),
('MA','Massachusetts'),
('MI','Michigan'),
('MN','Minnesota'),
('MS','Mississippi'),
('MO','Missouri'),
('MT','Montana'),
('NE','ebraska'),
('NV','Nevada'),
('NH','New Hampshire'),
('NJ','New Jersey'),
('NM','New Mexico'),
('NY','New York'),
('NC','North Carolina'),
('ND','North Dakota'),
('OH','Ohio'),
('OK','Oklahoma'),
('OR','Oregon'),
('PA','Pennsylvania'),
('RI','Rhode Island'),
('SC','South Carolina'),
('SD','South Dakota'),
('TN','Tennessee'),
('TX','Texas'),
('UT','Utah'),
('VT','Vermont'),
('VA','Virginia'),
('WA','Washington'),
('WV','West Virginia'),
('WI','Wisconsin'),
('WY','Wyoming');