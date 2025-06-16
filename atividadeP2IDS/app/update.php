<?php
$servername = "banco";
$username = "user_lamp";
$password = "lamp_pass";
$dbname = "lamp";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtenção dos dados do formulário
    $id = $_POST["id"];
    $login = $_POST["login"];
    $senha = $_POST["senha"];

    // Atualização dos dados na tabela
    $sql = "UPDATE usuarios SET login='$login', senha='$senha' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Usuário atualizado com sucesso.";
    } else {
        echo "Erro ao atualizar usuário: " . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Atualizar Usuário</title>
</head>

<body>
    <div class="container mt-5">

        <h1>Atualizar Usuário</h1>
        <hr>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class="form-group col-xs-3 form-inline m-2">
                <label for="id">ID do Usuário:</label>
                <input type="text" class="form-control m-2" name="id" required><br><br>
                <label for="login">Novo Login:</label>
                <input type="text" class="form-control m-2" name="login" required><br><br>
                <label for="senha">Nova Senha:</label>
                <input type="password" class="form-control m-2" name="senha" required><br><br>
                <input type="submit" class="btn btn-primary m-2" value="Atualizar">
            </div>
        </form>
        <hr>
        <h1 class="m-2">Teste CRUD</h1>
        <div id="list-example" class="ml-2 nav">
            <h2><a href="index.php" class="m-2"><i class="fa fa-home" aria-hidden="true"></i></a></h2>
            <h2><a href="create.php" role="button" class="m-2 btn btn-outline-primary"> Cadastrar </a></h2>
            <h2><a href="read.php" role="button" class="m-2 btn btn-outline-secondary"> Listar </a></h2>
            <h2><a href="update.php" role="button" class="m-2 btn btn-outline-warning"> Atualizar </a></h2>
            <h2><a href="delete.php" role="button" class="m-2 btn btn-outline-danger"> Apagar </a></h2>
        </div>
    </div>
</body>

</html>