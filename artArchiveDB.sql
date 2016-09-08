-- --------------------------------------------------------------------------------------------------
-- Filename: artArchiveDB.sql
-- Authors: Sara Hashem, Niza Volair
-- Date: 3/8/2016
-- Description: Art Archive database table creation and insertion statements
-- --------------------------------------------------------------------------------------------------

-- Disable foreign key constraint checks
SET FOREIGN_KEY_CHECKS = 0;



-- Drop existing tables to reset database
DROP TABLE IF EXISTS artwork;
DROP TABLE IF EXISTS mediums;
DROP TABLE IF EXISTS series;
DROP TABLE IF EXISTS exhibitions;
DROP TABLE IF EXISTS composed_of;
DROP TABLE IF EXISTS featured_in;



-- Table creation queries
CREATE TABLE artwork (
	id int(11) AUTO_INCREMENT,
	title varchar(255) NOT NULL UNIQUE,
	image varchar(255),
	sid int(11),
	width int(11),
	height int(11),
	year year(4),
	PRIMARY KEY (id),
	FOREIGN KEY (sid) REFERENCES series(id)
) ENGINE=InnoDB;

CREATE TABLE mediums (
	id int(11) AUTO_INCREMENT,
	name varchar(255) NOT NULL UNIQUE,
	description text,
	PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE series (
	id int(11) AUTO_INCREMENT,
	title varchar(255) NOT NULL UNIQUE,
	description text,
	PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE exhibitions (
	id int(11) AUTO_INCREMENT,
	title varchar(255) NOT NULL UNIQUE,
	location text,
	sid int(11),
	year year(4),
	PRIMARY KEY (id),
	FOREIGN KEY (sid) REFERENCES series(id)
) ENGINE=InnoDB;

CREATE TABLE composed_of (
	aid int(11),
	mid int(11),
	PRIMARY KEY (aid, mid),
	FOREIGN KEY (aid) REFERENCES artwork(id),
	FOREIGN KEY (mid) REFERENCES mediums(id)
) ENGINE=InnoDB;



-- Insertion queries
-- mediums
INSERT INTO mediums (id, name, description) 
	VALUES (id, "glitter", "tiny pieces of shiny foil");

INSERT INTO mediums (id, name, description) 
	VALUES (id, "nail scales", "dried nail polish peelings");

INSERT INTO mediums (id, name, description) 
	VALUES (id, "acrylic", "water-based paint");

INSERT INTO mediums (id, name, description) 
	VALUES (id, "chalk", "the white on blackboards");

INSERT INTO mediums (id, name, description) 
	VALUES (id, "oil", "a little toxic goes good with red wine");

INSERT INTO mediums (id, name, description) 
	VALUES (id, "fur", "hair for animals");

INSERT INTO mediums (id, name, description) 
	VALUES (id, "dried paint", "used for heavy impasto");


-- Series
INSERT INTO series (id, title, description) 
	VALUES (id, "Sea Creatures", "Miniature works dedicated to sea creatures and their surroundings");

INSERT INTO series (id, title, description) 
	VALUES (id, "Children", "Emotions of childhood caught in quick expressions");

INSERT INTO series (id, title, description) 
	VALUES (id, "Mimes", "Black and white representations of representations");

INSERT INTO series (id, title, description) 
	VALUES (id, "Looks Just Like She's Sleeping", "Images of dreams and their dreamers");

INSERT INTO series (id, title, description) 
	VALUES (id, "Party at the End of the World", "Dinosaurs in their final days");

INSERT INTO series (id, title, description) 
	VALUES (id, "The Cutting Edge", "Ladies playing with scissors, glass, and other toys");


-- Artwork
INSERT INTO artwork (id, title, image, sid, width, height, year)
	VALUES (id, "Fox Face", "http://web.engr.oregonstate.edu/~volairn/images/FoxFace.jpg", 
		(SELECT id FROM series
			WHERE title = "Sea Creatures"),
		4, 3, 2016);

INSERT INTO artwork (id, title, image, sid, width, height, year)
	VALUES (id, "Plastic Pony", "http://web.engr.oregonstate.edu/~volairn/images/PlasticPony.jpg", 
		(SELECT id FROM series
			WHERE title = "Sea Creatures"),
		2, 3, 2015);

INSERT INTO artwork (id, title, image, sid, width, height, year)
	VALUES (id, "Mandarine Green Goby", "http://web.engr.oregonstate.edu/~volairn/images/MandarinGreenGoby.jpg", 
		(SELECT id FROM series
			WHERE title = "Sea Creatures"),
		4, 5, 2016);
		
INSERT INTO artwork (id, title, image, sid, width, height, year)
	VALUES (id, "Gloria", "http://web.engr.oregonstate.edu/~volairn/images/Gloria.jpg", 
		(SELECT id FROM series
			WHERE title = "Children"),
		12, 15, 2015);

INSERT INTO artwork (id, title, image, sid, width, height, year)
	VALUES (id, "Sophia", "http://web.engr.oregonstate.edu/~volairn/images/Sophia.jpg", 
		(SELECT id FROM series
			WHERE title = "Children"),
		12, 15, 2015);

INSERT INTO artwork (id, title, image, sid, width, height, year)
	VALUES (id, "Julia", "http://web.engr.oregonstate.edu/~volairn/images/Julia.jpg", 
		(SELECT id FROM series
			WHERE title = "Children"),
		12, 15, 2015);
		
INSERT INTO artwork (id, title, image, sid, width, height, year)
	VALUES (id, "Black", "http://web.engr.oregonstate.edu/~volairn/images/Black.jpg", 
		(SELECT id FROM series
			WHERE title = "Mimes"),
		25, 25, 2009);

INSERT INTO artwork (id, title, image, sid, width, height, year)
	VALUES (id, "White", "http://web.engr.oregonstate.edu/~volairn/images/White.jpg", 
		(SELECT id FROM series
			WHERE title = "Mimes"),
		25, 25, 2009);

INSERT INTO artwork (id, title, image, sid, width, height, year)
	VALUES (id, "Inspired", "http://web.engr.oregonstate.edu/~volairn/images/Inspired.jpg", NULL, 25, 30, 2006);
		
INSERT INTO artwork (id, title, image, sid, width, height, year)
	VALUES (id, "Embrace", "http://web.engr.oregonstate.edu/~volairn/images/Embrace.jpg", 
		(SELECT id FROM series
			WHERE title = "Looks Just Like She's Sleeping"),
		35, 50, 2010);

INSERT INTO artwork (id, title, image, sid, width, height, year)
	VALUES (id, "Dreaming Again", "http://web.engr.oregonstate.edu/~volairn/images/DreamingAgain.jpg", 
		(SELECT id FROM series
			WHERE title = "Looks Just Like She's Sleeping"),
		35, 50, 2010);

INSERT INTO artwork (id, title, image, sid, width, height, year)
	VALUES (id, "You Wouldn't Believe It, Marion!", NULL, 
		(SELECT id FROM series
			WHERE title = "Party at the End of the World"),
		20, 30, 2015);
		
INSERT INTO artwork (id, title, image, sid, width, height, year)
	VALUES (id, "It Was Just Wild!", NULL, 
		(SELECT id FROM series
			WHERE title = "Party at the End of the World"),
		12, 15, 2009);

INSERT INTO artwork (id, title, image, sid, width, height, year)
	VALUES (id, "Did Anyone Bring Popcorn?", NULL, 
		(SELECT id FROM series
			WHERE title = "Party at the End of the World"),
		35, 25, 2009);
		
INSERT INTO artwork (id, title, image, sid, width, height, year)
	VALUES (id, "Split", "http://web.engr.oregonstate.edu/~hashems/cs340/Art%20Archive%20-%20Final%20Project/artArchiveImages//Split.jpg", 
		(SELECT id FROM series
			WHERE title = "The Cutting Edge"),
		60, 60, 2009);

INSERT INTO artwork (id, title, image, sid, width, height, year)
	VALUES (id, "Thread", "http://web.engr.oregonstate.edu/~hashems/cs340/Art%20Archive%20-%20Final%20Project/artArchiveImages//Thread.jpg", 
		(SELECT id FROM series
			WHERE title = "The Cutting Edge"),
		60, 60, 2009);		

INSERT INTO artwork (id, title, image, sid, width, height, year)
	VALUES (id, "Reflections", "http://web.engr.oregonstate.edu/~hashems/cs340/Art%20Archive%20-%20Final%20Project/artArchiveImages//Reflections.jpg", 
		(SELECT id FROM series
			WHERE title = "The Cutting Edge"),
		50, 120, 2009);		
		
		
		
-- Exhibitions
INSERT INTO exhibitions (id, title, location, sid, year) 
	VALUES (id, "Extinction Event", "Korea", 
		(SELECT id FROM series WHERE title = "Children"), 2015);

INSERT INTO exhibitions (id, title, location, sid, year) 
	VALUES (id, "The End", "Korea", 
		(SELECT id FROM series WHERE title = "Party at the End of the World"),  2016);

INSERT INTO exhibitions (id, title, location, sid, year) 
	VALUES (id, "Looks Just Like She's Sleeping", "Alaska", 
	(SELECT id FROM series WHERE title = "Looks Just Like She's Sleeping"), 2010);

INSERT INTO exhibitions (id, title, location, sid, year) 
	VALUES (id, "It Will Look Like This But Bigger...", "Missouri", 
	(SELECT id FROM series WHERE title = "The Cutting Edge"), 2009);


-- Composed_of
INSERT INTO composed_of (aid, mid) 
	VALUES (
		(SELECT id FROM artwork
			WHERE title = "Fox Face"),
		(SELECT id FROM mediums
			WHERE name = "nail scales")
		);
		
INSERT INTO composed_of (aid, mid) 
	VALUES (
		(SELECT id FROM artwork
			WHERE title = "Plastic Pony"),
		(SELECT id FROM mediums
			WHERE name = "nail scales")
		);

INSERT INTO composed_of (aid, mid) 
	VALUES (
		(SELECT id FROM artwork
			WHERE title = "Mandarine Green Goby"),
		(SELECT id FROM mediums
			WHERE name = "nail scales")
		);
		
INSERT INTO composed_of (aid, mid) 
	VALUES (
		(SELECT id FROM artwork
			WHERE title = "Fox Face"),
		(SELECT id FROM mediums
			WHERE name = "acrylic")
		);
		
INSERT INTO composed_of (aid, mid) 
	VALUES (
		(SELECT id FROM artwork
			WHERE title = "Plastic Pony"),
		(SELECT id FROM mediums
			WHERE name = "acrylic")
		);

INSERT INTO composed_of (aid, mid) 
	VALUES (
		(SELECT id FROM artwork
			WHERE title = "Mandarine Green Goby"),
		(SELECT id FROM mediums
			WHERE name = "acrylic")
		);
		
INSERT INTO composed_of (aid, mid) 
	VALUES (
		(SELECT id FROM artwork
			WHERE title = "Fox Face"),
		(SELECT id FROM mediums
			WHERE name = "glitter")
		);
		
INSERT INTO composed_of (aid, mid) 
	VALUES (
		(SELECT id FROM artwork
			WHERE title = "Plastic Pony"),
		(SELECT id FROM mediums
			WHERE name = "glitter")
		);

INSERT INTO composed_of (aid, mid) 
	VALUES (
		(SELECT id FROM artwork
			WHERE title = "Mandarine Green Goby"),
		(SELECT id FROM mediums
			WHERE name = "glitter")
		);
		
INSERT INTO composed_of (aid, mid) 
	VALUES (
		(SELECT id FROM artwork
			WHERE title = "Julia"),
		(SELECT id FROM mediums
			WHERE name = "acrylic")
		);

INSERT INTO composed_of (aid, mid) 
	VALUES (
		(SELECT id FROM artwork
			WHERE title = "Gloria"),
		(SELECT id FROM mediums
			WHERE name = "acrylic")
		);
		
INSERT INTO composed_of (aid, mid) 
	VALUES (
		(SELECT id FROM artwork
			WHERE title = "Sophia"),
		(SELECT id FROM mediums
			WHERE name = "acrylic")
		);
INSERT INTO composed_of (aid, mid) 
	VALUES (
		(SELECT id FROM artwork
			WHERE title = "Julia"),
		(SELECT id FROM mediums
			WHERE name = "dried paint")
		);

INSERT INTO composed_of (aid, mid) 
	VALUES (
		(SELECT id FROM artwork
			WHERE title = "Gloria"),
		(SELECT id FROM mediums
			WHERE name = "dried paint")
		);
		
INSERT INTO composed_of (aid, mid) 
	VALUES (
		(SELECT id FROM artwork
			WHERE title = "Sophia"),
		(SELECT id FROM mediums
			WHERE name = "dried paint")
		);
		
INSERT INTO composed_of (aid, mid) 
	VALUES (
		(SELECT id FROM artwork
			WHERE title = "Black"),
		(SELECT id FROM mediums
			WHERE name = "chalk")
		);
		
INSERT INTO composed_of (aid, mid) 
	VALUES (
		(SELECT id FROM artwork
			WHERE title = "White"),
		(SELECT id FROM mediums
			WHERE name = "chalk")
		);
		
INSERT INTO composed_of (aid, mid) 
	VALUES (
		(SELECT id FROM artwork
			WHERE title = "Inspired"),
		(SELECT id FROM mediums
			WHERE name = "oil")
		);

INSERT INTO composed_of (aid, mid) 
	VALUES (
		(SELECT id FROM artwork
			WHERE title = "Dreaming Again"),
		(SELECT id FROM mediums
			WHERE name = "acrylic")
		);
		
INSERT INTO composed_of (aid, mid) 
	VALUES (
		(SELECT id FROM artwork
			WHERE title = "Embrace"),
		(SELECT id FROM mediums
			WHERE name = "acrylic")
		);
		
INSERT INTO composed_of (aid, mid) 
	VALUES (
		(SELECT id FROM artwork
			WHERE title = "Split"),
		(SELECT id FROM mediums
			WHERE name = "acrylic")
		);

INSERT INTO composed_of (aid, mid) 
	VALUES (
		(SELECT id FROM artwork
			WHERE title = "Thread"),
		(SELECT id FROM mediums
			WHERE name = "acrylic")
		);
		
INSERT INTO composed_of (aid, mid) 
	VALUES (
		(SELECT id FROM artwork
			WHERE title = "Reflections"),
		(SELECT id FROM mediums
			WHERE name = "acrylic")
		);
