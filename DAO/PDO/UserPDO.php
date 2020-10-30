<?php 

    namespace DAO\PDO;

    use \PDO;
    use \Exception;
    use DAO\Connection;
    use Models\User;

    use DAO\PDO\RolePDO as RoleDAO;

    class UserPDO
    {
        private $connection;
        private $roleDAO;

        public function __construct()
        {
            $this->roleDAO = new RoleDAO();
        }

        /**
         * Get by id
         */
        public function get($id) {

            $query = "
            SELECT * FROM user as u
            INNER JOIN role as r
            ON r.role_id = u.role_id
            INNER JOIN profile as p
            ON p.user_id = u.user_id
            WHERE u.user_id = :id ;";

            $parameters['id'] = $id;

            try {

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);
                 //print_r($resultSet);
            }catch(Exception $ex) {
                throw $ex;
            }

            if(!empty($resultSet)){
                return $this->map($resultSet);
                //print_r($this->map($resultSet));
            }else {
                return false;
            }

        }

        /**
         * Get by email without profile
         */
        public function getByEmailNoProfile($email)
        {
            $query = "
            SELECT * FROM user as u
            INNER JOIN role as r
            ON r.role_id = u.role_id
            WHERE u.email = :email";

            $parameters['email'] = $email;

            try {
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);
                

            }catch(Exception $ex) {
                throw $ex;
            }

            if(!empty($resultSet)){
                return $this->map($resultSet);
            }else {
                return false;
            }

        }

        /**
         * Get by email
         */
        public function getByEmail($email)
        {
            $query = "
            SELECT * FROM user as u
            INNER JOIN role as r
            ON r.role_id = u.role_id
            INNER JOIN profile as p
            ON p.user_id = u.user_id
            WHERE u.email = :email";

            $parameters['email'] = $email;

            try {
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);
                

            }catch(Exception $ex) {
                throw $ex;
            }

            if(!empty($resultSet)){
                return $this->map($resultSet);
            }else {
                return false;
            }

        }

          /**
         * Add new user
         */
        public function add(User $user) {
            
            $query = "
            INSERT INTO user (role_id, email , password) VALUES (:role_id , :email, :password) ";

            $parameters['role_id'] = $user->getRole()->getId();
            $parameters['email'] = $user->getEmail();
            $parameters['password'] = $user->getPassword();
            

            try {

                $this->connection = Connection::GetInstance();
                
                return $this->connection->ExecuteNonQuery($query, $parameters);
            }catch(Exception $ex) {
                throw $ex;
            }
          
            
        }

        /**
         * Map model
         */
        public function map($data){
            
            $data = is_array($data) ? $data : [];

            $values = array_map(function($row){
                $user = new User($row['email'], $row['password']);
                $user->setId($row['user_id']);
                
                $user->setRole($this->roleDAO->mapOne($row));

                return $user;
            }, $data);

            return count($values) > 1 ? $values : $values['0'];
        }
    }

?>