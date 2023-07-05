<?php
class Database {
    private string $host = DB_HOST;
    private string $user = DB_USER;
    private string $password = DB_PASSWORD;
    private string $dbname = DB_NAME;

    private PDO $dbh;
    private PDOStatement $stmt;
    private string $error;

    public function __construct() {
        $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;
        $options = [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
        }
        catch (PDOException $exception) {
            $this->error = $exception->getMessage();
            echo $this->error;
        }
    }
    public function Query($sql) : void {
        $this->stmt = $this->dbh->prepare($sql);
    }
    public function Bind($parameter, $value, $type = null) : void {
        if (is_null($type)) {
            $type = match (true) {
                is_int($value)  => PDO::PARAM_INT,
                is_bool($value) => PDO::PARAM_BOOL,
                is_null($value) => PDO::PARAM_NULL,
                default         => PDO::PARAM_STR
            };
        }
        $this->stmt->bindValue($parameter, $value, $type);
    }
    public function Execute() : bool {
        return $this->stmt->execute();
    }
    public function GetResultSet() : array|false {
        $this->Execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function GetSingleResult() : mixed {
        $this->Execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }
    public function NumResults() : int {
        return $this->stmt->rowCount();
    }
    public function LastInsertId() : int {
        return $this->dbh->lastInsertId();
    }
}