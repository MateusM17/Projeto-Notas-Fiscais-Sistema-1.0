<?php
// Inclusão do arquivo de conexão com o banco de dados
include("./db/conexao.php");
session_start(); // Inicia uma sessão ou retoma a sessão atual

// Verifica se o usuário está autenticado
if (!isset($_SESSION["loginUser"])) {
    // Se as sessões não estiverem definidas, redireciona para login
    header('Location: login.php');
    exit(); // Termina o script
}

// Obtém os dados da sessão
$loginUser = $_SESSION["loginUser"];
$nomeUser = $_SESSION["nomeUser"];

// Função para chamar uma API
function callAPI($method, $url, $data = false) {
    $curl = curl_init();

    switch ($method) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            if ($data) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
            break;
        case "DELETE":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
            if ($data) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
            break;
        default:
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    }


    // Define a URL
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); // Tipo de cabeçalho, se necessário

    $result = curl_exec($curl);
    curl_close($curl);

    return json_decode($result, true);
}

// Exemplo de uso da API (modifique a URL para a API desejada)
if (isset($_GET['api']) && $_GET['api'] == 'true') {
    $url = 'http://localhost/sis-notasfiscais/api.php?endpoint=notas';
    $response = callAPI('GET', $url);

    echo '<pre>';
    print_r($response);
    echo '</pre>';
    exit(); 
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/estilo-padrao.css">
    <title>Sistema NotasFiscais 1.0</title>
</head>
<body>
    <header class="bg-dark">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="#">
                    <img src="img/sistema nf 1.0.png" alt="sis-notasfiscais" width="180">
                </a>

                <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active"><a class="nav-link" href="index.php?menuop=home">Home</a></li>
                        <li class="nav-item active"><a class="nav-link" href="index.php?menuop=notas">Notas</a></li>
                        <li class="nav-item active"><a class="nav-link" href="index.php?menuop=tarefas">Tarefas</a></li>
                        <li class="nav-item active"><a class="nav-link" href="index.php?menuop=eventos">Eventos</a></li>
                    </ul>
                    <div class="navbar-nav w-100 justify-content-end">
                        <a href="logout.php" class="nav-link">
                            <i class="bi bi-person"></i>
                            <?=$nomeUser?> Sair <i class="bi bi-box-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <main>
        <div class="container">
            <hr>
            <?php
            // Obtém a opção de menu a partir dos parâmetros da URL (GET)
            $menuop = isset($_GET["menuop"]) ? $_GET["menuop"] : "home";

            // Estrutura de controle switch para incluir a página correta
            switch ($menuop) {
                case 'home':
                    include("paginas/home/home.php");
                    break;
                case 'notas':
                    include("paginas/notas/notas.php");
                    break;
                case 'cad-notas':
                    include("paginas/notas/cad-notas.php");
                    break;
                case 'inserir-notas':
                    include("paginas/notas/inserir-notas.php");
                    break;
                case 'editar-nota':
                    include("paginas/notas/editar-nota.php");
                    break;
                case 'atualizar-nota':
                    include("paginas/notas/atualizar-nota.php");
                    break;
                case 'excluir-nota':
                    include("paginas/notas/excluir-nota.php");
                    break;
                case 'tarefas':
                    include("paginas/tarefas/tarefas.php");
                    break;
                case 'cad-tarefas':
                    include("paginas/tarefas/cad-tarefas.php");
                    break;
                case 'inserir-tarefas':
                    include("paginas/tarefas/inserir-tarefas.php");
                    break;
                case 'editar-tarefas':
                    include("paginas/tarefas/editar-tarefas.php");
                    break;
                case 'atualizar-tarefas':
                    include("paginas/tarefas/atualizar-tarefas.php");
                    break;
                case 'excluir-tarefas':
                    include("paginas/tarefas/excluir-tarefas.php");
                    break;
                case 'eventos':
                    include("paginas/eventos/eventos.php");
                    break;
                case 'cad-eventos':
                    include("paginas/eventos/cad-eventos.php");
                    break;
                case 'inserir-eventos':
                    include("paginas/eventos/inserir-eventos.php");
                    break;
                case 'editar-eventos':
                    include("paginas/eventos/editar-eventos.php");
                    break;
                case 'atualizar-eventos':
                    include("paginas/eventos/atualizar-eventos.php");
                    break;
                case 'excluir-eventos':
                    include("paginas/eventos/excluir-eventos.php");
                    break;
                default:
                    include("paginas/home/home.php");
                    break;
            }
            ?>
        </div>
    </main>

    <footer class="container-fluid bg-dark">
        <div class="text-center">SIS Notas Fiscais V 1.0</div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="./js/validation.js"></script>
    </footer>
</body>
</html>