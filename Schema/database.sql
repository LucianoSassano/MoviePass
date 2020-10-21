CREATE DATABASE IF NOT EXISTS moviepass;

#DROP DATABSE MOVIEPASS;

USE moviepass;

CREATE TABLE IF NOT EXISTS `user`(
user_id SMALLINT (5) UNSIGNED AUTO_INCREMENT,
password VARCHAR(20),
CONSTRAINT pk_user_id PRIMARY KEY (user_id)
);

CREATE TABLE IF NOT EXISTS `role`(
role_id SMALLINT(5) UNSIGNED AUTO_INCREMENT,
name VARCHAR(20),
CONSTRAINT pk_role_id PRIMARY key (role_id)
);

CREATE TABLE IF NOT EXISTS `profile`(
profile_id SMALLINT(5) UNSIGNED AUTO_INCREMENT,
first_name VARCHAR(40),
last_name VARCHAR(40),
email VARCHAR(40),
user_dni INT(10) UNSIGNED,
user_id SMALLINT (5) UNSIGNED,
CONSTRAINT pk_profile_id PRIMARY KEY (profile_id),
CONSTRAINT fk_user_id FOREIGN KEY (user_id) REFERENCES `user`(user_id)
);


CREATE TABLE IF NOT EXISTS `genre`(
genre_id SMALLINT(5) UNSIGNED AUTO_INCREMENT,
name VARCHAR(20),
CONSTRAINT pk_genre_id PRIMARY KEY (genre_id)
);

CREATE TABLE IF NOT EXISTS `movie`(
movie_id SMALLINT(5) UNSIGNED AUTO_INCREMENT,
genre_id SMALLINT(5) UNSIGNED,
duration FLOAT UNSIGNED,
title VARCHAR (250),
language VARCHAR(30),
CONSTRAINT pk_movie_id PRIMARY KEY (movie_id)
);

CREATE TABLE IF NOT EXISTS `genre_x_movie`(
genre_x_movie SMALLINT(5) UNSIGNED AUTO_INCREMENT,
genre_id SMALLINT(5) UNSIGNED,
movie_id SMALLINT(5) UNSIGNED,
CONSTRAINT pk_genre_x_movie PRIMARY KEY (genre_x_movie),
CONSTRAINT fk_genre_id FOREIGN KEY (genre_id) REFERENCES `genre`(genre_id),
CONSTRAINT fk_movie_id FOREIGN KEY (movie_id) REFERENCES `movie`(movie_id)
);


CREATE TABLE IF NOT EXISTS `room`(
room_id SMALLINT(5) UNSIGNED AUTO_INCREMENT,
capacity INT UNSIGNED,
CONSTRAINT pk_room_id PRIMARY KEY (room_id)
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


CREATE TABLE IF NOT EXISTS `theater`(
theater_id SMALLINT(5) UNSIGNED,
name VARCHAR(40),
room_id SMALLINT(5) UNSIGNED,
CONSTRAINT pk_theater_id PRIMARY KEY (theater_id)
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