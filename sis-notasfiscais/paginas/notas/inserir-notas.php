<header>
    <h3>Inserir Notas</h3> <!-- Cabeçalho da seção que indica que o usuário está inserindo notas -->
</header>

<?php 
// Escapagem de dados recebidos via POST para evitar SQL Injection
$nomeNota = mysqli_real_escape_string($conexao, $_POST["nomeNota"]);
$emailNota = mysqli_real_escape_string($conexao, $_POST["emailNota"]);
$telefoneNota = mysqli_real_escape_string($conexao, $_POST["telefoneNota"]);
$situaçãoNota = mysqli_real_escape_string($conexao, $_POST["situaçãoNota"]);
$endereçoNota = mysqli_real_escape_string($conexao, $_POST["endereçoNota"]);
$emissãoNota = mysqli_real_escape_string($conexao, $_POST["emissãoNota"]);
$vencimentoNota = mysqli_real_escape_string($conexao, $_POST["vencimentoNota"]);

// Criação da consulta SQL para inserir uma nova nota na tabela 'tbcontatos'
$sql = "INSERT INTO tbcontatos (
    nomeNota,
    emailNota,
    telefoneNota,
    endereçoNota,
    situaçãoNota,
    emissãoNota,
    vencimentoNota
) VALUES (
    '{$nomeNota}',
    '{$emailNota}',
    '{$telefoneNota}',
    '{$endereçoNota}',
    '{$situaçãoNota}',
    '{$emissãoNota}',
    '{$vencimentoNota}'
)";

// Execução da consulta SQL e tratamento de erros
mysqli_query($conexao, $sql) or die("Erro ao executar a consulta: " . mysqli_error($conexao));

// Mensagem de confirmação após a inserção bem-sucedida do registro
echo "O registro foi inserido com sucesso!";
?>