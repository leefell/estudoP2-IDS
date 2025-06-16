<?php
// Configuração de conexão com o banco
$host = 'banco';
$dbname = 'startup_db';
$username = 'startup_user';
$password = 'startup123';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao_status = "✅ Conectado com sucesso ao MySQL!";
} catch(PDOException $e) {
    $conexao_status = "❌ Erro na conexão: " . $e->getMessage();
}

// Buscar dados para exibir
$clientes = [];
$produtos = [];

if (isset($pdo)) {
    try {
        $stmt = $pdo->query("SELECT * FROM clientes LIMIT 5");
        $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $stmt = $pdo->query("SELECT * FROM produtos LIMIT 5");
        $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        $erro_consulta = "Erro ao buscar dados: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Startup Soluções - Sistema de Gestão</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .header {
            background: #2c3e50;
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }
        
        .status {
            background: #34495e;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 1.1em;
        }
        
        .content {
            padding: 30px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }
        
        .info-card {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 25px;
            border-left: 4px solid #3498db;
        }
        
        .info-card h3 {
            color: #2c3e50;
            margin-bottom: 15px;
            font-size: 1.3em;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        
        .table th, .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        .table th {
            background: #3498db;
            color: white;
            font-weight: bold;
        }
        
        .table tr:hover {
            background: #f5f5f5;
        }
        
        .system-info {
            background: #e8f5e8;
            border-left-color: #27ae60;
        }
        
        .links {
            background: #fff3cd;
            border-left-color: #ffc107;
        }
        
        .links a {
            display: inline-block;
            background: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin: 5px;
            transition: background 0.3s;
        }
        
        .links a:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🚀 Startup Soluções</h1>
            <p>Sistema de Gestão de Clientes e Produtos</p>
        </div>
        
        <div class="status">
            <?php echo $conexao_status; ?>
        </div>
        
        <div class="content">
            <div class="info-grid">
                <div class="info-card system-info">
                    <h3>ℹ️ Informações do Sistema</h3>
                    <p><strong>Servidor Web:</strong> Apache <?php echo apache_get_version(); ?></p>
                    <p><strong>PHP:</strong> <?php echo phpversion(); ?></p>
                    <p><strong>Banco de Dados:</strong> MySQL 8.0</p>
                    <p><strong>Data/Hora:</strong> <?php echo date('d/m/Y H:i:s'); ?></p>
                </div>
                
                <div class="info-card links">
                    <h3>🔗 Links Úteis</h3>
                    <a href="http://3.80.221.83:8080/" target="_blank">phpMyAdmin</a>
                    <a href="conexao.php">Teste de Conexão</a>
                    <a href="info.php">PHP Info</a>
                </div>
            </div>
            
            <?php if (!empty($clientes)): ?>
            <div class="info-card">
                <h3>👥 Clientes Cadastrados</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Data Cadastro</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?php echo $cliente['id']; ?></td>
                            <td><?php echo htmlspecialchars($cliente['nome']); ?></td>
                            <td><?php echo htmlspecialchars($cliente['email']); ?></td>
                            <td><?php echo htmlspecialchars($cliente['telefone']); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($cliente['data_cadastro'])); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
            
            <?php if (!empty($produtos)): ?>
            <div class="info-card">
                <h3>📦 Produtos Cadastrados</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Preço</th>
                            <th>Estoque</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produtos as $produto): ?>
                        <tr>
                            <td><?php echo $produto['id']; ?></td>
                            <td><?php echo htmlspecialchars($produto['nome']); ?></td>
                            <td><?php echo htmlspecialchars($produto['descricao']); ?></td>
                            <td>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></td>
                            <td><?php echo $produto['estoque']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>