<header>
    <h3>Atualizar Nota</h3> <!-- Cabeçalho da seção que informa ao usuário que está na página de atualização de notas -->
</header>

<?php 
// Obtendo os dados do POST e escapando para evitar injeções SQL
$idNota = mysqli_real_escape_string($conexao, $_POST["idNota"]); // ID da nota que será atualizada
$nomeNota = mysqli_real_escape_string($conexao, $_POST["nomeNota"]); // Nome associado à nota
$emailNota = mysqli_real_escape_string($conexao, $_POST["emailNota"]); // E-mail relacionado à nota
$telefoneNota = mysqli_real_escape_string($conexao, $_POST["telefoneNota"]); // Telefone associado à nota
$situaçãoNota = mysqli_real_escape_string($conexao, $_POST["situaçãoNota"]); // Situação da nota (paga ou aberta)
$endereçoNota = mysqli_real_escape_string($conexao, $_POST["endereçoNota"]); // Endereço mencionado na nota
$emissãoNota = mysqli_real_escape_string($conexao, $_POST["emissãoNota"]); // Data de emissão da nota
$vencimentoNota = mysqli_real_escape_string($conexao, $_POST["vencimentoNota"]); // Data de vencimento da nota

// Criação da consulta SQL para atualizar os dados na tabela 'tbcontatos'
$sql = "UPDATE tbcontatos SET
    nomeNota = '{$nomeNota}', 
    emailNota = '{$emailNota}', 
    telefoneNota = '{$telefoneNota}', 
    situaçãoNota = '{$situaçãoNota}', 
    endereçoNota = '{$endereçoNota}', 
    emissãoNota = '{$emissãoNota}', 
    vencimentoNota = '{$vencimentoNota}' 
WHERE idNota = '{$idNota}'"; // Especifica qual registro deve ser atualizado através do ID

// Executando a consulta e manipulando erros de forma adequada
mysqli_query($conexao, $sql) or die("Erro ao executar a consulta: " . mysqli_error($conexao));

// Mensagem confirmando que a atualização foi bem-sucedida
echo "O registro foi atualizado com sucesso!";
?>