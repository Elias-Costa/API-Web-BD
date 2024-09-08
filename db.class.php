<?php

class Database{
    public static function conectar(){
        $host = 'database-elias.cqhpjiiwgxn5.us-east-1.rds.amazonaws.com';
        $dbname = 'postgres';
        $port = '5432';
        $username = 'elias';
        $password = 'fsdUqVBvkBhWSkfLedcd';
        
        $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
        $pdo = new PDO($dsn, $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        
        return $pdo;
    }
}

/*$host = 'database-elias.cqhpjiiwgxn5.us-east-1.rds.amazonaws.com';
$dbname = 'postgres';
$port = '5432';
$username = 'elias';
$password = 'fsdUqVBvkBhWSkfLedcd';

try{
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}catch(PDOException $e){
    echo "Não foi possível se conectar ao Banco de Dados!" . $e->getMessage();
}*/

?>