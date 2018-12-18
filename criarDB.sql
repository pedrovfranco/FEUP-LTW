DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Post;
DROP TABLE IF EXISTS Comment;
DROP TABLE IF EXISTS VotesPost;
DROP TABLE IF EXISTS VotesComment;

CREATE TABLE User (
    idUser      INTEGER  NOT NULL PRIMARY KEY,

    username	VARCHAR (50) NOT NULL UNIQUE,
	password	VARCHAR NOT NULL,
	age 		INTEGER NOT NULL,
	email		VARCHAR (100) NOT NULL UNIQUE,
	pic			VARCHAR NOT NULL
);

CREATE TABLE Post (
	idPost		INTEGER NOT NULL PRIMARY KEY,
	idUser		INTEGER REFERENCES User (idUser),

	Title 		VARCHAR (100) NOT NULL,
	Text		VARCHAR (1000) NOT NULL,

	Link		VARCHAR NOT NULL,

	Date		INTEGER NOT NULL,

	Upvotes		INTEGER,
	Downvotes	INTEGER
);

CREATE TABLE Comment (
	idComment	INTEGER NOT NULL PRIMARY KEY,
	idUser		INTEGER REFERENCES User (idUser),
	idPost 		INTEGER REFERENCES Post (idPost),

	Text		VARCHAR (500) NOT NULL,

	Upvotes		INTEGER,
	Downvotes	INTEGER
);

CREATE TABLE VotesPost (
	idUser		INTEGER REFERENCES User (idUser),
	idPost 		INTEGER REFERENCES Post (idPost),

	value		INTEGER NOT NULL,

	PRIMARY KEY (idUser, idPost)
);

CREATE TABLE VotesComment (
	idUser		INTEGER REFERENCES User (idUser),
	idComment 	INTEGER REFERENCES Comment (idComment),

	value		INTEGER NOT NULL,

	PRIMARY KEY (idUser, idComment)
);