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

// Seleção de todos os usuários
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Teste CRUD</title>
</head>

<body>
    <div class="container mt-5">
        <h1>Lista de Cadastros</h1>
        <table class="table m-2">
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td scope='row'>ID: " . $row["id"] . "<td>";
                        echo "<td scope='row'>Login: " . $row["login"] . "<td>";
                        echo "<td scope='row'>Senha: " . $row["senha"] . "<td><tr>";
                    }
                } else {
                    echo "Nenhum usuário encontrado.";
                }

                $conn->close();
                ?>
            <tbody>
        </table>
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