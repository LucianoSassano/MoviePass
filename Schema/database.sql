CREATE DATABASE IF NOT EXISTS moviepass;

#DROP DATABSE MOVIEPASS;

USE moviepass;


CREATE TABLE IF NOT EXISTS `roles`(
    role_id INTEGER(50) UNSIGNED AUTO_INCREMENT,
    name VARCHAR(20),

    CONSTRAINT pk_role_id PRIMARY key (role_id)
);


CREATE TABLE IF NOT EXISTS `users`(
    user_id INTEGER(50) UNSIGNED AUTO_INCREMENT,
    role_id INTEGER(50) UNSIGNED,
    email VARCHAR(40),
    password VARCHAR(20),

    CONSTRAINT pk_user_id PRIMARY KEY (user_id),
    CONSTRAINT fk_role_id FOREIGN KEY (role_id) REFERENCES `roles`(role_id)
);


CREATE TABLE IF NOT EXISTS `profiles`(
    profile_id INTEGER(50) UNSIGNED AUTO_INCREMENT,
    first_name VARCHAR(40),
    last_name VARCHAR(40),
    dni INT(10) UNSIGNED,
    user_id INTEGER (50) UNSIGNED,

    CONSTRAINT pk_profile_id PRIMARY KEY (profile_id),
    CONSTRAINT fk_user_id FOREIGN KEY (user_id) REFERENCES `users`(user_id)
);


CREATE TABLE IF NOT EXISTS `genres`(
    id INTEGER(50) UNSIGNED AUTO_INCREMENT,
    genre_id INTEGER(50) UNSIGNED,
    name VARCHAR(20),

    CONSTRAINT pk_genre_id PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS `movies`(
    id INTEGER(50) UNSIGNED AUTO_INCREMENT,
    movie_id INTEGER(50) UNSIGNED,
    duration INTEGER(50) UNSIGNED,
    title VARCHAR (250),
    language VARCHAR(30),
    poster_path VARCHAR(60),
    adult BOOLEAN,
    overview VARCHAR(300),
    vote_average INTEGER,

    CONSTRAINT pk_movie_id PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS `genre_x_movies`(
    genre_movie_id INTEGER(50) UNSIGNED AUTO_INCREMENT,
    genre_id INTEGER(50) UNSIGNED,
    movie_id INTEGER(50) UNSIGNED,

    CONSTRAINT pk_genre_x_movie PRIMARY KEY (genre_movie_id),
    CONSTRAINT fk_genre_id FOREIGN KEY (genre_id) REFERENCES `genres`(id),
    CONSTRAINT fk_movie_id FOREIGN KEY (movie_id) REFERENCES `movies`(id)
);


CREATE TABLE IF NOT EXISTS `theaters`(
    theater_id INTEGER(50) UNSIGNED AUTO_INCREMENT,
    name VARCHAR(40),
    address VARCHAR(70),

    CONSTRAINT pk_theater_id PRIMARY KEY (theater_id)
);


CREATE TABLE IF NOT EXISTS `rooms`(
    room_id INTEGER(50) UNSIGNED AUTO_INCREMENT,
    theater_id INTEGER(50) UNSIGNED,
    capacity INT UNSIGNED,
    name VARCHAR (60),

    CONSTRAINT pk_room_id PRIMARY KEY (room_id),
    CONSTRAINT fk_theater_id FOREIGN KEY (theater_id) REFERENCES `theaters`(theater_id)
);


CREATE TABLE IF NOT EXISTS `shows`(
    show_id INTEGER(50) UNSIGNED AUTO_INCREMENT,
    room_id INTEGER(50) UNSIGNED,
    theater_id INTEGER(50) UNSIGNED,
    movie_id INTEGER(50) UNSIGNED,
    date date,
    startTime time,
    endTime time,
    price FLOAT UNSIGNED,

    CONSTRAINT pk_show_id PRIMARY KEY (show_id),
    CONSTRAINT fk_room_id FOREIGN KEY (room_id) REFERENCES `rooms`(room_id),
    CONSTRAINT fk_theater_id_ FOREIGN KEY (theater_id) REFERENCES `theaters`(theater_id),
    CONSTRAINT fk_movie_id_ FOREIGN KEY (movie_id) REFERENCES `movies`(id)
);



CREATE TABLE IF NOT EXISTS `tickets`(
    ticket_id INTEGER(50) UNSIGNED AUTO_INCREMENT,
    show_id INTEGER(50) UNSIGNED,
    seat_number INTEGER(50) UNSIGNED,
    user_id INTEGER(50) UNSIGNED,
    cost FLOAT UNSIGNED, 
    date datetime,

    CONSTRAINT pk_ticket_id PRIMARY KEY (ticket_id),
    CONSTRAINT fk_show_id FOREIGN KEY (show_id) REFERENCES `shows` (show_id),
    CONSTRAINT fk_user_id_ FOREIGN KEY (user_id) REFERENCES `users` (user_id)
);

insert into roles (name) values ("Admin"), ("Client");
insert into users (role_id, email, password) values (1, "admin@admin", "admin");
insert into profiles (first_name, last_name, dni, user_id) values ("Luciano", "Sassano", 41333010, 1);