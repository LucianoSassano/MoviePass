<?php 

    namespace DAO\PDO;

    use \PDO;
    use \Exception;
    use DAO\Connection;
    use Models\Role;

    class RolePDO
    {
        private $connection;



        /**
         * Map model from resultSet
         */
        public function map($data){
            
            $data = is_array($data) ? $data : [];

            $values = array_map(function($row){
                return new Role($row['role_id'], $row['name']);
            }, $data);

            return count($values) > 1 ? $values : $values['0'];
        }

        /**
         * Map 1 model from a row of a resultSet
         */
        public function mapOne($row){
            if(isset($row['role_id']) && isset($row['name'])){
                return new Role($row['role_id'], $row['name']);
            }else {
                return null;
            }
        }

    }

?>