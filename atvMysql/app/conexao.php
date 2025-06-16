<?php
header('Content-Type: application/json');

$host = 'banco';
$dbname = 'startup_db';
$username = 'startup_user';
$password = 'startup123';

$resultado = [];

try {
    // Teste de conexão com PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $resultado['conexao_pdo'] = '✅ Sucesso';

    // Teste de consulta
    $stmt = $pdo->query("SELECT COUNT(*) as total_clientes FROM clientes");
    $total = $stmt->fetch(PDO::FETCH_ASSOC);
    $resultado['total_clientes'] = $total['total_clientes'];

    $stmt = $pdo->query("SELECT COUNT(*) as total_produtos FROM produtos");
    $total = $stmt->fetch(PDO::FETCH_ASSOC);
    $resultado['total_produtos'] = $total['total_produtos'];

    // Informações do servidor MySQL
    $stmt = $pdo->query("SELECT VERSION() as versao");
    $version = $stmt->fetch(PDO::FETCH_ASSOC);
    $resultado['mysql_version'] = $version['versao'];

    $resultado['status'] = 'success';
    $resultado['mensagem'] = 'Todas as conexões estão funcionando perfeitamente!';

} catch (PDOException $e) {
    $resultado['conexao_pdo'] = '❌ Erro: ' . $e->getMessage();
    $resultado['status'] = 'error';
    $resultado['mensagem'] = 'Erro na conexão com o banco de dados';
}

// Teste de conexão mysqli
try {
    $mysqli = new mysqli($host, $username, $password, $dbname);

    if ($mysqli->connect_error) {
        $resultado['conexao_mysqli'] = '❌ Erro: ' . $mysqli->connect_error;
    } else {
        $resultado['conexao_mysqli'] = '✅ Sucesso';
        $mysqli->close();
    }
} catch (Exception $e) {
    $resultado['conexao_mysqli'] = '❌ Erro: ' . $e->getMessage();
}

// Informações do PHP
$resultado['php_version'] = phpversion();
$resultado['php_extensions'] = [
    'mysqli' => extension_loaded('mysqli') ? '✅ Carregada' : '❌ Não carregada',
    'pdo' => extension_loaded('pdo') ? '✅ Carregada' : '❌ Não carregada',
    'pdo_mysql' => extension_loaded('pdo_mysql') ? '✅ Carregada' : '❌ Não carregada'
];

echo json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);