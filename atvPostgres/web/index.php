<?php
// web/index.php
// Configuração de conexão com PostgreSQL
$host = $_ENV['POSTGRES_HOST'] ?? 'postgres';
$dbname = $_ENV['POSTGRES_DB'] ?? 'startup_db';
$username = $_ENV['POSTGRES_USER'] ?? 'admin';
$password = $_ENV['POSTGRES_PASSWORD'] ?? 'admin123';

try {
    // Conectar ao PostgreSQL usando PDO
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h1>🚀 Startup Database - Sistema Web</h1>";
    echo "<p style='color: green;'>✅ Conexão com PostgreSQL estabelecida com sucesso!</p>";
    echo "<a href='http://54.226.131.96:8080' target='_blank'><h2>🛢️ Acessar pgAdmin </a></h2>";
    
    // Consultar clientes
    echo "<h2>👥 Clientes Cadastrados</h2>";
    $stmt = $pdo->query("SELECT * FROM clientes ORDER BY data_cadastro DESC");
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if ($clientes) {
        echo "<table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr style='background-color: #f0f0f0;'>";
        echo "<th>ID</th><th>Nome</th><th>Email</th><th>Telefone</th><th>Endereço</th><th>Data Cadastro</th>";
        echo "</tr>";
        
        foreach ($clientes as $cliente) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($cliente['id']) . "</td>";
            echo "<td>" . htmlspecialchars($cliente['nome']) . "</td>";
            echo "<td>" . htmlspecialchars($cliente['email']) . "</td>";
            echo "<td>" . htmlspecialchars($cliente['telefone']) . "</td>";
            echo "<td>" . htmlspecialchars($cliente['endereco']) . "</td>";
            echo "<td>" . htmlspecialchars($cliente['data_cadastro']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Nenhum cliente encontrado.</p>";
    }
    
    // Consultar produtos
    echo "<h2>📦 Produtos Disponíveis</h2>";
    $stmt = $pdo->query("SELECT * FROM produtos ORDER BY nome");
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if ($produtos) {
        echo "<table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr style='background-color: #f0f0f0;'>";
        echo "<th>ID</th><th>Nome</th><th>Descrição</th><th>Preço</th><th>Estoque</th><th>Data Cadastro</th>";
        echo "</tr>";
        
        foreach ($produtos as $produto) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($produto['id']) . "</td>";
            echo "<td>" . htmlspecialchars($produto['nome']) . "</td>";
            echo "<td>" . htmlspecialchars($produto['descricao']) . "</td>";
            echo "<td>R$ " . number_format($produto['preco'], 2, ',', '.') . "</td>";
            echo "<td>" . htmlspecialchars($produto['estoque']) . "</td>";
            echo "<td>" . htmlspecialchars($produto['data_cadastro']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Nenhum produto encontrado.</p>";
    }
    

    // Estatísticas
    echo "<h2>📊 Estatísticas</h2>";
    $stmt = $pdo->query("SELECT COUNT(*) as total_clientes FROM clientes");
    $total_clientes = $stmt->fetch(PDO::FETCH_ASSOC)['total_clientes'];
    
    $stmt = $pdo->query("SELECT COUNT(*) as total_produtos FROM produtos");
    $total_produtos = $stmt->fetch(PDO::FETCH_ASSOC)['total_produtos'];
    
    $stmt = $pdo->query("SELECT SUM(estoque) as total_estoque FROM produtos");
    $total_estoque = $stmt->fetch(PDO::FETCH_ASSOC)['total_estoque'];
    
    $stmt = $pdo->query("SELECT AVG(preco) as preco_medio FROM produtos");
    $preco_medio = $stmt->fetch(PDO::FETCH_ASSOC)['preco_medio'];
    
    echo "<ul>";
    echo "<li><strong>Total de Clientes:</strong> $total_clientes</li>";
    echo "<li><strong>Total de Produtos:</strong> $total_produtos</li>";
    echo "<li><strong>Total em Estoque:</strong> $total_estoque unidades</li>";
    echo "<li><strong>Preço Médio:</strong> R$ " . number_format($preco_medio, 2, ',', '.') . "</li>";
    echo "</ul>";
    
} catch (PDOException $e) {
    echo "<h1>❌ Erro de Conexão</h1>";
    echo "<p style='color: red;'>Erro: " . $e->getMessage() . "</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Startup Database</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 20px; 
            background-color: #f5f5f5; 
        }
        table { 
            background-color: white; 
            margin: 20px 0; 
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        h1, h2 { 
            color: #333; 
        }
        th { 
            background-color: #007bff; 
            color: white; 
        }
        tr:nth-child(even) { 
            background-color: #f8f9fa; 
        }
        a {
            color: #007bff; 
            text-decoration: none; 
        }
        a:hover { 
            text-decoration: wavy; 
        }
    </style>
</head>
<body>
    <hr>
    <p><strong>Informações de Conexão:</strong></p>
    <ul>
        <li>Host: <?php echo $host; ?></li>
        <li>Database: <?php echo $dbname; ?></li>
        <li>Usuário: <?php echo $username; ?></li>
    </ul>
</body>
</html>
