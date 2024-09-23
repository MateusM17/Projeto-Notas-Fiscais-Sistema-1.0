<?php
// conexão com o banco de dados
include "./db/conexao.php";

// Inicializa a variável para mensagens de erro
$msg_error = "";

// Verifica se o formulário foi enviado
if (isset($_POST["loginUser"]) && isset($_POST["senhaUser"])) {
    // Escapa as entradas do usuário para evitar SQL Injection
    $loginUser = mysqli_real_escape_string($conexao, $_POST["loginUser"]);
    // Hash da senha usando SHA-256
    $senhaUser = hash('sha256', $_POST["senhaUser"]);

    // Consulta SQL utilizando Prepared Statements
    $stmt = $conexao->prepare("SELECT * FROM tbusuarios WHERE loginUser = ? AND senhaUser = ?");
    
    if ($stmt) {
        $stmt->bind_param("ss", $loginUser, $senhaUser); // Tipo 'ss' indica que são duas strings
        $stmt->execute();
        $resultado = $stmt->get_result();

        // Verifica se encontrou algum usuário
        if ($resultado->num_rows > 0) {
            // Inicia a sessão e armazena os dados do usuário
            session_start();
            $dados = $resultado->fetch_assoc(); // Pega os dados do primeiro resultado
            $_SESSION["loginUser"] = $loginUser; // Armazena o nome de usuário na sessão
            $_SESSION["nomeUser"] = $dados["nomeUser"]; // Armazena o nome do usuário na sessão
            
            // Redireciona para a página inicial
            header('Location: index.php');
            exit(); // Importante para parar o script após o redirecionamento
        } else {
            // Mensagem de erro se o usuário não for encontrado
            $msg_error = "<div class='alert alert-danger mt-3'>
                <p>Usuário não encontrado ou a senha não confere.</p>
            </div>";
        }
    } else {
        // Mensagem de erro se a preparação da statement falhar
        $msg_error = "<div class='alert alert-danger mt-3'>
            <p>Erro na consulta ao banco de dados. Tente novamente.</p>
        </div>";
    }

    // Fecha a declaração
    $stmt->close();
}

// Fecha a conexão com o banco de dados
mysqli_close($conexao);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Login - NotasFiscais</title>
</head>
<body class="bg-secondary">
    <div class="container">
        <div class="row vh-100 align-items-center justify-content-center">
            <div class="col-10 col-sm-8 col-md-6 col-lg-4 p-4 bg-white shadow rounded">
                <div class="row justify-content-center mb-4">
                    <img src="./img/sistema nf 1.0.png" alt="Notas">
                </div>
                <form class="needs-validation" action="login.php" method="post" novalidate>
                    <div class="form-group mb-4">
                        <label class="form-label" for="loginUser">Login</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person-fill"></i>
                            </span>
                            <input class="form-control" type="text" name="loginUser" id="loginUser" required>
                            <div class="invalid-feedback">Informe o username.</div>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-label" for="senhaUser">Senha</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-key-fill"></i>
                            </span>
                            <input class="form-control" type="password" name="senhaUser" id="senhaUser" required>
                            <div class="invalid-feedback">Informe a senha.</div>
                        </div>
                    </div>
                    <?php 
                    // Exibe a mensagem de erro se houver
                    echo $msg_error; 
                    ?>
                    <button class="btn btn-success w-100"><i class="bi bi-box-arrow-in-right"></i> Entrar</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./js/validation.js"></script>
</body>
</html> 