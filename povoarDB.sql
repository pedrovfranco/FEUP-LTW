INSERT INTO User VALUES (NULL, "pedrofixe", "79f41176ac875324044a1042b2bdca45eb522cc0812b970d13db568c816d03c1", 20, "yurbypedro@hotmail.com", "images/camisolas/benfica.png");
INSERT INTO User VALUES (NULL, "batosta", "35389f6ea37669ddb95dff9ed53f491aad2479e5fdf5ca4fa11dbc1c2f9416e8", 20, "jnrf83@hotmail.com", "images/camisolas/porto.png");
INSERT INTO User VALUES (NULL, "admin", "8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918", 20, "", "images/camisolas/guimaraes.png");

INSERT INTO Post VALUES (NULL, 1, "Eder forever", "Eder is the best player ever", "", 1545099177, 1, 1);
INSERT INTO Post VALUES (NULL, 1, "Ronaldo is the best player of all time (GOAT)", "After Eder", "", 1545099200, 2, 0);
INSERT INTO Post VALUES (NULL, 2, "Messi is the REAL GOAT", "Ronaldo is just a cocky player", "", 1545099211, 0, 1);

INSERT INTO Comment VALUES (NULL, 2, 1, "True", 1, 1);
INSERT INTO Comment VALUES (NULL, 1, 1, "Thank you my friend", 0, 2);
INSERT INTO Comment VALUES (NULL, 1, 2, "I don't think so...", 0, 0);
INSERT INTO Comment VALUES (NULL, 2, 2, "Eder <3", 0, 0);

INSERT INTO VotesPost VALUES (1, 1, -1);
INSERT INTO VotesPost VALUES (2, 1, 1);
INSERT INTO VotesPost VALUES (1, 2, 1);
INSERT INTO VotesPost VALUES (2, 2, 1);
INSERT INTO VotesPost VALUES (1, 3, -1);

INSERT INTO VotesComment VALUES (1, 1, -1);
INSERT INTO VotesComment VALUES (2, 1, 1);
INSERT INTO VotesComment VALUES (1, 2, -1);
INSERT INTO VotesComment VALUES (2, 2, -1);

-- batosta420
-- gatotribos0599