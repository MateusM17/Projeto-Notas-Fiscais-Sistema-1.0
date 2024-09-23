<?php
// Define o tipo de conteúdo para JSON, necessário para APIs RESTful.
header('Content-Type: application/json');

// Inclui o arquivo de conexão ao banco de dados.
include("./db/conexao.php");

/**
 * Função para responder com um erro em formato JSON.
 *
 * @param string $message Mensagem de erro a ser enviada.
 * @param int $statusCode Código de status HTTP (default é 400).
 */
function respondWithError($message, $statusCode = 400) {
    http_response_code($statusCode); // Define o código de status HTTP da resposta.
    echo json_encode(array("error" => $message)); // Retorna uma resposta JSON com a mensagem de erro.
    exit(); // Encerra a execução do script após a resposta.
}

/**
 * Função para responder com dados em formato JSON.
 *
 * @param mixed $data Dados a serem enviados na resposta.
 * @param int $statusCode Código de status HTTP (default é 200).
 */
function respondWithData($data, $statusCode = 200) {
    http_response_code($statusCode); // Define o código de status HTTP da resposta.
    echo json_encode($data); // Retorna uma resposta JSON com os dados.
    exit(); // Encerra a execução do script após a resposta.
}

// Armazena o método da requisição (GET, POST, PUT, DELETE).
$method = $_SERVER['REQUEST_METHOD'];
// Obtém o endpoint especificado na URL, se existente.
$endpoint = isset($_GET['endpoint']) ? $_GET['endpoint'] : '';

// Verifica se o endpoint foi especificado na requisição.
if (empty($endpoint)) {
    respondWithError("Endpoint não especificado."); // Responde com erro se não houver endpoint.
}

// Switch para gerenciar diferentes endpoints da API.
switch ($endpoint) {
    case 'notas':
        // Switch para gerenciar métodos HTTP relacionados ao endpoint "notas".
        switch ($method) {
            case 'GET':
                // Consulta todas as notas no banco de dados.
                $query = "SELECT * FROM tbcontatos"; 
                $result = mysqli_query($conexao, $query);
                if (!$result) {
                    respondWithError("Erro ao consultar notas: " . mysqli_error($conexao));
                }
                // Armazena as notas em um array.
                $notas = array();
                while ($row = mysqli_fetch_assoc($result)) {
                    $notas[] = $row;
                }
                respondWithData($notas); // Responde com as notas em formato JSON.
                break;

            case 'POST':
                // Recebe os dados da nova nota.
                $data = json_decode(file_get_contents("php://input"), true);
                // Verifica se os campos obrigatórios estão presentes.
                if (!isset($data['titulo']) || !isset($data['conteudo'])) {
                    respondWithError("Título e conteúdo são obrigatórios.");
                }
                $titulo = $data['titulo'];
                $conteudo = $data['conteudo'];
                // Insere a nova nota no banco de dados.
                $query = "INSERT INTO notas (titulo, conteudo) VALUES ('$titulo', '$conteudo')";
                if (mysqli_query($conexao, $query)) {
                    respondWithData(array("id" => mysqli_insert_id($conexao)), 201); // Retorna o ID da nota criada.
                } else {
                    respondWithError("Erro ao inserir nota: " . mysqli_error($conexao));
                }
                break;

            case 'PUT':
                // Recebe os dados para atualizar uma nota existente.
                $data = json_decode(file_get_contents("php://input"), true);
                // Verifica se os campos obrigatórios estão presentes.
                if (!isset($data['id']) || !isset($data['titulo']) || !isset($data['conteudo'])) {
                    respondWithError("ID, título e conteúdo são obrigatórios.");
                }
                $id = $data['id'];
                $titulo = $data['titulo'];
                $conteudo = $data['conteudo'];
                // Atualiza a nota com os novos dados.
                $query = "UPDATE notas SET titulo='$titulo', conteudo='$conteudo' WHERE id='$id'";
                if (mysqli_query($conexao, $query)) {
                    respondWithData(array("message" => "Nota atualizada com sucesso")); // Sucesso na atualização.
                } else {
                    respondWithError("Erro ao atualizar nota: " . mysqli_error($conexao));
                }
                break;

            case 'DELETE':
                // Verifica se o ID da nota a ser excluída é fornecido.
                if (!isset($_GET['id'])) {
                    respondWithError("ID é obrigatório para exclusão.");
                }
                $id = $_GET['id'];
                // Exclui a nota do banco de dados.
                $query = "DELETE FROM notas WHERE id='$id'";
                if (mysqli_query($conexao, $query)) {
                    respondWithData(array("message" => "Nota excluída com sucesso")); // Sucesso na exclusão.
                } else {
                    respondWithError("Erro ao excluir nota: " . mysqli_error($conexao));
                }
                break;

            default:
                respondWithError("Método não suportado."); // Resposta para métodos não suportados.
                break;
        }
        break;

    default:
        respondWithError("Endpoint não encontrado."); // Resposta para endpoint não encontrado.
        break;
}

// Fecha a conexão com o banco de dados.
mysqli_close($conexao);
?>