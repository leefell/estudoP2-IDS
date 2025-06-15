<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Aval & Ação Consultoria TI</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --success-color: #27ae60;
            --danger-color: #e74c3c;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .main-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            margin: 20px auto;
            padding: 0;
            overflow: hidden;
        }
        
        .header {
            background: var(--primary-color);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .header h1 {
            margin: 0;
            font-weight: 300;
            font-size: 2.5rem;
        }
        
        .header .subtitle {
            opacity: 0.8;
            margin-top: 0.5rem;
        }
        
        .content {
            padding: 2rem;
        }
        
        .btn-primary {
            background: var(--secondary-color);
            border: none;
            border-radius: 50px;
            padding: 0.7rem 2rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
        }
        
        .btn-success {
            background: var(--success-color);
            border: none;
            border-radius: 50px;
        }
        
        .btn-danger {
            background: var(--danger-color);
            border: none;
            border-radius: 50px;
        }
        
        .table {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        
        .table thead {
            background: var(--primary-color);
            color: white;
        }
        
        .table tbody tr:hover {
            background: rgba(52, 152, 219, 0.1);
            transform: scale(1.01);
            transition: all 0.2s ease;
        }
        
        .modal-content {
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }
        
        .modal-header {
            background: var(--primary-color);
            color: white;
            border-radius: 20px 20px 0 0;
        }
        
        .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 0.8rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }
        
        .alert {
            border-radius: 15px;
            border: none;
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="main-container">
            <div class="header">
                <h1><i class="fas fa-users"></i> CRUD System</h1>
                <div class="subtitle">Aval & Ação Consultoria de TI</div>
            </div>
            
            <div class="content">
                <div id="alerts"></div>
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3><i class="fas fa-address-book"></i> Gerenciar Clientes</h3>
                    <button class="btn btn-primary" onclick="openModal()">
                        <i class="fas fa-plus"></i> Novo Cliente
                    </button>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Empresa</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody id="clientsTable">
                            <!-- Dados serão carregados via JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="clientModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Novo Cliente</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="clientForm">
                        <input type="hidden" id="clientId">
                        <div class="mb-3">
                            <label class="form-label">Nome *</label>
                            <input type="text" class="form-control" id="nome" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email *</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Telefone</label>
                            <input type="text" class="form-control" id="telefone">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Empresa</label>
                            <input type="text" class="form-control" id="empresa">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" onclick="saveClient()">
                        <i class="fas fa-save"></i> Salvar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        const API_URL = 'api.php';
        let modal;

        document.addEventListener('DOMContentLoaded', function() {
            modal = new bootstrap.Modal(document.getElementById('clientModal'));
            loadClients();
        });

        async function loadClients() {
            try {
                const response = await fetch(API_URL);
                const clients = await response.json();
                
                const tbody = document.getElementById('clientsTable');
                tbody.innerHTML = clients.map(client => `
                    <tr class="fade-in">
                        <td>${client.id}</td>
                        <td>${client.nome}</td>
                        <td>${client.email}</td>
                        <td>${client.telefone || '-'}</td>
                        <td>${client.empresa || '-'}</td>
                        <td>
                            <button class="btn btn-sm btn-primary me-1" onclick="editClient(${client.id})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteClient(${client.id})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `).join('');
            } catch (error) {
                showAlert('Erro ao carregar clientes', 'danger');
            }
        }

        function openModal(client = null) {
            const form = document.getElementById('clientForm');
            form.reset();
            
            if (client) {
                document.getElementById('modalTitle').textContent = 'Editar Cliente';
                document.getElementById('clientId').value = client.id;
                document.getElementById('nome').value = client.nome;
                document.getElementById('email').value = client.email;
                document.getElementById('telefone').value = client.telefone || '';
                document.getElementById('empresa').value = client.empresa || '';
            } else {
                document.getElementById('modalTitle').textContent = 'Novo Cliente';
                document.getElementById('clientId').value = '';
            }
            
            modal.show();
        }

        async function editClient(id) {
            try {
                const response = await fetch(`${API_URL}?id=${id}`);
                const client = await response.json();
                openModal(client);
            } catch (error) {
                showAlert('Erro ao carregar cliente', 'danger');
            }
        }

        async function saveClient() {
            const form = document.getElementById('clientForm');
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            const id = document.getElementById('clientId').value;
            const data = {
                nome: document.getElementById('nome').value,
                email: document.getElementById('email').value,
                telefone: document.getElementById('telefone').value,
                empresa: document.getElementById('empresa').value
            };

            try {
                const response = await fetch(API_URL, {
                    method: id ? 'PUT' : 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(id ? { id, ...data } : data)
                });

                const result = await response.json();
                
                if (result.success) {
                    modal.hide();
                    loadClients();
                    showAlert(id ? 'Cliente atualizado!' : 'Cliente criado!', 'success');
                } else {
                    showAlert(result.errors?.join(', ') || 'Erro ao salvar', 'danger');
                }
            } catch (error) {
                showAlert('Erro ao salvar cliente', 'danger');
            }
        }

        async function deleteClient(id) {
            if (!confirm('Tem certeza que deseja excluir este cliente?')) return;

            try {
                const response = await fetch(API_URL, {
                    method: 'DELETE',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id })
                });

                const result = await response.json();
                
                if (result.success) {
                    loadClients();
                    showAlert('Cliente excluído!', 'success');
                } else {
                    showAlert('Erro ao excluir cliente', 'danger');
                }
            } catch (error) {
                showAlert('Erro ao excluir cliente', 'danger');
            }
        }

        function showAlert(message, type) {
            const alerts = document.getElementById('alerts');
            const alert = document.createElement('div');
            alert.className = `alert alert-${type} alert-dismissible fade show`;
            alert.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            alerts.appendChild(alert);
            
            setTimeout(() => {
                if (alert.parentNode) alert.remove();
            }, 5000);
        }
    </script>
</body>
</html>
