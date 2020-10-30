<?php 

    namespace DAO\PDO;

    use \PDO;
    use \Exception;
    use DAO\Connection;
    use Models\Profile;


class ProfilePDO{
        
        private $connection;


        public function add(Profile $profile, $user_id) {
            
            $query = "
            INSERT INTO profile (first_name, last_name , dni, user_id) VALUES (:first_name , :last_name, :dni, :user_id) ";

            $parameters['first_name'] = $profile->getFirst_name();
            $parameters['last_name'] = $profile->getLast_name();
            $parameters['dni'] = $profile->getDni();
            $parameters['user_id'] = $user_id;

            try {

                $this->connection = Connection::GetInstance();
                
                return $this->connection->ExecuteNonQuery($query, $parameters);

            }catch(Exception $ex) {
                throw $ex;
            }
          
            
        }

        
        /**
         * Map model from resultSet
         */
        public function map($data){
            
            $data = is_array($data) ? $data : [];

            $values = array_map(function($row){
                return new Profile($row['first_name'], $row['last_name'], $row['dni']);
            }, $data);

            return count($values) > 1 ? $values : $values['0'];
        }

        /**
         * Map 1 model from a row of a resultSet
         */
        public function mapOne($row){
            //validacion super chancha y
            if(isset($row['first_name']) && isset($row['last_name']) && ($row['dni'])){
                return new Profile($row['first_name'], $row['last_name'], $row['dni']);
            }else {
                return null;
            }
        }

    }


?>