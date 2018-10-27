CREATE TABLE person(
    id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name varchar(60) NOT NULL,
    image blob NOT NULL,
    password varchar(255) NOT NULL
);

CREATE TABLE online_person(
    id_person int PRIMARY KEY NOT NULL,
    last_update datetime NOT NULL,
    FOREIGN KEY (id_person) REFERENCES person(id)
);

CREATE TABLE message(
    id_message int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    sender int NOT NULL,
    receiver int NOT NULL,
    sent_at datetime NOT NULL,
    read_at datetime NOT NULL,
    FOREIGN KEY (sender) REFERENCES person(id),
    FOREIGN KEY (receiver) REFERENCES person(id)
);