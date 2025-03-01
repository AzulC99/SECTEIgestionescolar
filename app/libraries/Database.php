
<?php
class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct() {
        // Configurar DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname . ';charset=utf8mb4';
        
        // Configurar opciones de PDO
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES => false
        ];

        // Crear instancia de PDO
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch(PDOException $e) {
            $this->error = $e->getMessage();
            error_log('Error de base de datos: ' . $this->error);
            die('Ha ocurrido un error en la conexión a la base de datos.');
        }
    }

    // Preparar sentencia con consulta
    public function query($sql) {
        $this->stmt = $this->dbh->prepare($sql);
    }

    // Vincular valores
    public function bind($param, $value, $type = null) {
        if(is_null($type)) {
            switch(true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        
        $this->stmt->bindValue($param, $value, $type);
    }

    // Ejecutar la sentencia preparada
    public function execute() {
        return $this->stmt->execute();
    }

    // Obtener resultados como array de objetos
    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll();
    }

    // Obtener registro único como objeto
    public function single() {
        $this->execute();
        return $this->stmt->fetch();
    }

    // Obtener cantidad de filas
    public function rowCount() {
        return $this->stmt->rowCount();
    }

    // Obtener último ID insertado
    public function lastInsertId() {
        return $this->dbh->lastInsertId();
    }

    // Iniciar transacción
    public function beginTransaction() {
        return $this->dbh->beginTransaction();
    }

    // Finalizar transacción
    public function commit() {
        return $this->dbh->commit();
    }

    // Revertir transacción
    public function rollBack() {
        return $this->dbh->rollBack();
    }
}