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


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Criar Usuário</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5">
        <h1>Criar Usuário</h1>
        <hr>
        <?
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtenção dos dados do formulário
            $nome = $_POST["nome"];
            $login = $_POST["login"];
            $senha = $_POST["senha"];

            // Inserção dos dados na tabela
            $sql = "INSERT INTO usuarios (nome, login, senha) VALUES ('$nome','$login', '$senha')";
            if ($conn->query($sql) === TRUE) {
                echo "<span class='text-success'>Usuário criado com sucesso.</span>";
            } else {
                echo "Erro ao criar usuário: " . $conn->error;
            }
        }

        $conn->close();
        ?>
        <form method="post" action='<?php echo $_SERVER["PHP_SELF"]; ?>'>
            <div class="form-group col-xs-3 form-inline m-2">
                <label for="nome" class="m-2">Nome: </label>
                <input type="text" class="form-control" name="nome" placeholder="Digite seu Nome" required><br><br>
            </div>
            <div class="form-group col-xs-3 form-inline m-2">
                <label for="login" class="m-2">Login: </label>
                <input type="text" class="form-control" name="login" placeholder="Digite seu Login" required><br><br>
            </div>
            <div class="form-group col-xs-3 form-inline">
                <label for="senha" class="m-2">Senha: </label>
                <input type="password" class="form-control" name="senha" placeholder="Digite sua Senha" required><br><br>
            </div>
            <div class="form-group col-xs-3 form-inline m-2">
                <input type="submit" class="btn btn-primary" value="Criar">
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



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>
