<?php
// src/config/database.php
class Database {
    private $host;
    private $db;
    private $user;
    private $pass;
    private $port = '5432';
    public $pdo;

    public function __construct() {
        // Configurações de variáveis de ambiente
        $this->host = $_ENV['DB_HOST'] ?? 'db';
        $this->db = $_ENV['DB_NAME'] ?? 'avaliacao';
        $this->user = $_ENV['DB_USER'] ?? 'postgres';
        $this->pass = $_ENV['DB_PASS'] ?? 'postgres123';
        
        try {
            $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->db}";
            $this->pdo = new PDO($dsn, $this->user, $this->pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]);
        } catch(PDOException $e) {
            die('Erro de conexão: ' . $e->getMessage());
        }
    }
}

// Classe modelo base
class Model {
    protected $db;
    protected $table;

    public function __construct($table) {
        $this->db = (new Database())->pdo;
        $this->table = $table;
    }

    public function all() {
        $stmt = $this->db->query("SELECT * FROM {$this->table} ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $columns = implode(',', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $stmt = $this->db->prepare("INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})");
        $stmt->execute($data);
        return $this->db->lastInsertId();
    }

    public function update($id, $data) {
        $set = implode(' = ?, ', array_keys($data)) . ' = ?';
        $stmt = $this->db->prepare("UPDATE {$this->table} SET {$set} WHERE id = ?");
        $stmt->execute([...array_values($data), $id]);
        return $stmt->rowCount();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }
}

// Modelo específico para clientes
class Cliente extends Model {
    public function __construct() {
        parent::__construct('clientes');
    }

    public function validate($data) {
        $errors = [];
        if (empty($data['nome'])) $errors[] = 'Nome é obrigatório';
        if (empty($data['email'])) $errors[] = 'Email é obrigatório';
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) $errors[] = 'Email inválido';
        return $errors;
    }
}
?>
