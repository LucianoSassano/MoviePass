<?php 

    namespace DAO;

    use \PDO;
    use \Exception;
    use DAO\Connection;
    use Models\User;

    class UserPDO
    {
        private $connection;

        public function getByEmail($email)
        {
            $query = "
            SELECT * FROM ´user´
            WHERE ´email´ = ' . $email . ' ;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            var_dump($resultSet);
        }
    }

?>