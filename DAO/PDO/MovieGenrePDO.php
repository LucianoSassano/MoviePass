<?php 

    namespace DAO\PDO;

    use \PDO;
    use \Exception;
    use DAO\Connection;

    class MovieGenrePDO {

        private $connection;
        
        public function add($movie_id, $genre_id) {

            $query = "
            SET FOREIGN_KEY_CHECKS=0;
                INSERT INTO genre_x_movies (genre_id, movie_id)
                SELECT :genre_id, :movie_id
                WHERE NOT EXISTS (SELECT * FROM genre_x_movies WHERE genre_id = :genre_id AND movie_id = :movie_id);
            SET FOREIGN_KEY_CHECKS=1;";

            $parameters['genre_id'] = $genre_id;
            $parameters['movie_id'] = $movie_id;

            try {
                $this->connection = Connection::GetInstance();
                return $this->connection->ExecuteNonQuery($query, $parameters);
            }catch (Exception $ex) {
                throw $ex;
            }
        }

    }
?>