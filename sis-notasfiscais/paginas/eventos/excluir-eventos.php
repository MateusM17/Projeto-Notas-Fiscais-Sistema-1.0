<header>
    <h3>Excluir Eventos</h3> <!-- Cabeçalho da página indicando a funcionalidade de exclusão de Eventos -->
</header>

<?php 
// Obtém o ID do Evento a ser excluído a partir da URL (gestão de parâmetros GET)
$idEvento = $_GET["idEvento"];

// Monta a consulta SQL para excluir o Evento com o ID fornecido
$sql = "DELETE FROM tbeventos WHERE idEvento = '{$idEvento}'";

// Executa a consulta de exclusão no banco de dados
$rs = mysqli_query($conexao, $sql);

// Verifica se a execução da consulta foi bem-sucedida
if ($rs) {
    // Caso o Evento tenha sido excluído com sucesso, exibe uma mensagem de sucesso
    ?>
    <div class="alert alert-success" role="alert"> 
        <h4 class="alert-heading">Excluir Evento</h4>
        <p>Evento excluído com sucesso!</p> <!-- Mensagem confirmando a exclusão do Evento -->
        <hr>
        <p class="mb-0">
            <a href="?menuop=eventos">Voltar para a lista de Eventos.</a> <!-- Link para retornar à lista de Eventos -->
        </p>
    </div>
    <?php 
} else {
    // Em caso de erro durante a exclusão, exibe uma mensagem de erro
    ?>
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Erro</h4>
        <p>O Evento não pode ser excluído: <?php echo mysqli_error($conexao); ?></p> <!-- Exibe o erro retornado pelo MySQL -->
        <hr>
        <p class="mb-0">
            <a href="?menuop=eventos">Voltar para a lista de Eventos.</a> <!-- Link para retornar à lista de Eventos -->
        </p>
    </div>
    <?php 
}
?>