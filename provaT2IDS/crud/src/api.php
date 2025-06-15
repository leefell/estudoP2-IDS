<?php
// api.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

require_once 'config/database.php';

$method = $_SERVER['REQUEST_METHOD'];
$cliente = new Cliente();

try {
    switch ($method) {
        case 'GET':
            if (isset($_GET['id'])) {
                // Buscar cliente específico
                $result = $cliente->find($_GET['id']);
                echo json_encode($result ?: ['error' => 'Cliente não encontrado']);
            } else {
                // Listar todos os clientes
                echo json_encode($cliente->all());
            }
            break;

        case 'POST':
            // Criar novo cliente
            $data = json_decode(file_get_contents('php://input'), true);
            $errors = $cliente->validate($data);
            
            if (empty($errors)) {
                $id = $cliente->create($data);
                echo json_encode(['success' => true, 'id' => $id]);
            } else {
                echo json_encode(['success' => false, 'errors' => $errors]);
            }
            break;

        case 'PUT':
            // Atualizar cliente
            $data = json_decode(file_get_contents('php://input'), true);
            $id = $data['id'];
            unset($data['id']);
            
            $errors = $cliente->validate($data);
            
            if (empty($errors)) {
                $affected = $cliente->update($id, $data);
                echo json_encode(['success' => $affected > 0]);
            } else {
                echo json_encode(['success' => false, 'errors' => $errors]);
            }
            break;

        case 'DELETE':
            // Excluir cliente
            $data = json_decode(file_get_contents('php://input'), true);
            $affected = $cliente->delete($data['id']);
            echo json_encode(['success' => $affected > 0]);
            break;

        default:
            http_response_code(405);
            echo json_encode(['error' => 'Método não permitido']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro interno: ' . $e->getMessage()]);
}
?>
