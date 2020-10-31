CREATE DATABASE IF NOT EXISTS moviepass;

#DROP DATABSE MOVIEPASS;

USE moviepass;


CREATE TABLE IF NOT EXISTS `role`(
    role_id SMALLINT(5) UNSIGNED AUTO_INCREMENT,
    name VARCHAR(20),

    CONSTRAINT pk_role_id PRIMARY key (role_id)
);


CREATE TABLE IF NOT EXISTS `user`(
    user_id SMALLINT (5) UNSIGNED AUTO_INCREMENT,
    role_id SMALLINT(5) UNSIGNED,
    email VARCHAR(40),
    password VARCHAR(20),

    CONSTRAINT pk_user_id PRIMARY KEY (user_id),
    CONSTRAINT fk_role_id FOREIGN KEY (role_id) REFERENCES `role`(role_id)
);


CREATE TABLE IF NOT EXISTS `profile`(
    profile_id SMALLINT(5) UNSIGNED AUTO_INCREMENT,
    first_name VARCHAR(40),
    last_name VARCHAR(40),
    dni INT(10) UNSIGNED,
    user_id SMALLINT (5) UNSIGNED,

    CONSTRAINT pk_profile_id PRIMARY KEY (profile_id),
    CONSTRAINT fk_user_id FOREIGN KEY (user_id) REFERENCES `user`(user_id)
);


CREATE TABLE IF NOT EXISTS `genre`(
    id SMALLINT(5) UNSIGNED AUTO_INCREMENT,
    genre_id SMALLINT(5) UNSIGNED,
    name VARCHAR(20),

    CONSTRAINT pk_genre_id PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS `movie`(
    id SMALLINT(5) UNSIGNED AUTO_INCREMENT,
    movie_id INTEGER(50) UNSIGNED,
    duration INTEGER UNSIGNED,
    title VARCHAR (250),
    language VARCHAR(30),
    poster_path VARCHAR(60),
    adult BOOLEAN,
    overview VARCHAR(300),
    vote_average INTEGER,

    CONSTRAINT pk_movie_id PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS `genre_x_movie`(
    genre_movie_id SMALLINT(5) UNSIGNED AUTO_INCREMENT,
    genre_id SMALLINT(5) UNSIGNED,
    movie_id SMALLINT(5) UNSIGNED,

    CONSTRAINT pk_genre_x_movie PRIMARY KEY (genre_movie_id),
    CONSTRAINT fk_genre_id FOREIGN KEY (genre_id) REFERENCES `genre`(id),
    CONSTRAINT fk_movie_id FOREIGN KEY (movie_id) REFERENCES `movie`(id)
);


CREATE TABLE IF NOT EXISTS `theater`(
    theater_id SMALLINT(5) UNSIGNED,
    name VARCHAR(40),
    address VARCHAR(70),

    CONSTRAINT pk_theater_id PRIMARY KEY (theater_id)
);


CREATE TABLE IF NOT EXISTS `room`(
    room_id SMALLINT(5) UNSIGNED AUTO_INCREMENT,
    theater_id SMALLINT(5) UNSIGNED,
    capacity INT UNSIGNED,
    name VARCHAR (60),

    CONSTRAINT pk_room_id PRIMARY KEY (room_id),
    CONSTRAINT fk_theater_id FOREIGN KEY (theater_id) REFERENCES `theater`(theater_id)
);


CREATE TABLE IF NOT EXISTS `show`(
    show_id SMALLINT(5) UNSIGNED AUTO_INCREMENT,
    room_id SMALLINT(5) UNSIGNED,
    movie_id SMALLINT(5) UNSIGNED,
    date datetime,
    price FLOAT UNSIGNED,

    CONSTRAINT pk_show_id PRIMARY KEY (show_id),
    CONSTRAINT fk_room_id FOREIGN KEY (room_id) REFERENCES `room`(room_id),
    CONSTRAINT movie_id FOREIGN KEY (movie_id) REFERENCES `movie`(movie_id)
);



CREATE TABLE IF NOT EXISTS `ticket`(
    ticket_id SMALLINT(5) UNSIGNED AUTO_INCREMENT,
    show_id SMALLINT(5) UNSIGNED,
    seat_number SMALLINT(5) UNSIGNED,
    user_id SMALLINT(5) UNSIGNED,
    cost FLOAT UNSIGNED, 
    date datetime,

    CONSTRAINT pk_ticket_if PRIMARY KEY (ticket_id),
    CONSTRAINT fk_show_id FOREIGN KEY (show_id) REFERENCES `show` (show_id),
    CONSTRAINT fk_user_id_ FOREIGN KEY (user_id) REFERENCES `user` (user_id)
);

insert into role (name) values ("Admin"), ("Client");
insert into user (role_id, email, password) values (1, "admin@admin", "admin");
insert into profile (first_name, last_name, dni, user_id) values ("Luciano", "Sassano", 41333010, 1);