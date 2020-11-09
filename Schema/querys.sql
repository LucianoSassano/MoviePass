/**
*   Traigo las peliculas que pertenecen a un show, que pertenece a un room, que pertenece a un teatro, sin repeticion
*/
SELECT DISTINCT m.movie_id, m.title, m.overview, m.poster_path, m.language, m.adult, m.vote_average, m.duration
FROM theaters as t 
INNER JOIN rooms as r 
ON t.theater_id = r.room_id 
INNER JOIN shows as s 
ON r.room_id = s.room_id 
INNER JOIN movies as m 
ON s.movie_id = m.movie_id;

/**
*   Traigo los cines, con sus rooms, con sus shows, todos pertenecientes a la pelicula pasada x param
*/
select distinct * from theaters as t 
inner join rooms as r 
on t.theater_id = r.theater_id 
inner join shows as s 
on r.room_id = s.room_id 
inner join movies as m 
on s.movie_id = m.movie_id 
where s.movie_id = 724989;


