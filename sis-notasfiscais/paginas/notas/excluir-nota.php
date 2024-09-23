
<header>
    <h3>Excluir Nota</h3> <!-- Cabeçalho da seção que indica que o usuário está na página de exclusão de notas -->
</header>

<?php 
// Escapagem de dados recebidos via GET para prevenir SQL Injection
$idNota = mysqli_real_escape_string($conexao, $_GET["idNota"]);

// Criação da consulta SQL para excluir uma nota da tabela 'tbcontatos' com base no ID
$sql = "DELETE FROM tbcontatos WHERE idNota = '{$idNota}'";

// Execução da consulta SQL. Em caso de erro, uma mensagem será exibida informando o ocorrido
mysqli_query($conexao, $sql) or die("Erro ao excluir o registro: " . mysqli_error($conexao));

// Mensagem de confirmação após a exclusão bem-sucedida do registro
echo "Registro excluído com sucesso.";
?>